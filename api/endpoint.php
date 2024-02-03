<?php
include_once 'database.php';

session_start();

const DATABASE = new Database('database/ecosun_power.db');

/**
 * @throws Exception
 */
function generateUniqID($length = 13): string {
    if (function_exists("random_bytes")) {
        $bytes = random_bytes(ceil($length / 2));
    } elseif (function_exists("openssl_random_pseudo_bytes")) {
        $bytes = openssl_random_pseudo_bytes(ceil($length / 2));
    }

    return substr(bin2hex($bytes), 0, $length);
}

function createClient() :void {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $dni = $_POST['dni'];
    $password = $_POST['password'];
    $energy_plan = $_POST['energy_plan'];
    $username = generateUniqID(8);

    $findClient = DATABASE->query("SELECT id FROM client WHERE dni = '$dni'");

    if($findClient->fetchArray(SQLITE3_ASSOC)) {
        echo json_encode(['warning' => 'Ya existe un cliente con ese DNI']);
        return;
    }

    $user_id = DATABASE->insert('user', [
        'email' => $email,
        'username' => $username,
        'password' => $password
    ]);

    if($user_id === false) {
        echo json_encode(['error' => 'Hubo un error al crear el usuario']);
        return;
    }

    $client_id = DATABASE->insert('client', [
        'name' => $name,
        'surname' => $surname,
        'dni' => $dni,
        'user_id' => $user_id,
        'plan_id' => $energy_plan
    ]);

    if($client_id === false) {
        echo json_encode(['error' => 'Hubo un error al crear el cliente']);
        return;
    }

    echo json_encode(['success' => $username]);
}

function login(): void {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = DATABASE->queryWithParameters('SELECT * FROM user WHERE username = :username AND password = :password', [
        ':username' => $username,
        ':password' => $password
    ]);

    if($result->fetchArray(SQLITE3_ASSOC)) {
        $_SESSION['connected'] = true;
        $_SESSION['username'] = $username;
        echo json_encode(['success' => 'Se ha iniciado sesión correctamente con el usuario.']);
    }else {
        http_response_code(401);
        echo json_encode(['error' => 'El usuario/contraseña no es correcto.']);
    }
}

function logout(): void {
    $_SESSION['connected'] = false;
    unset($_SESSION['username']);
    header('Location: /');
}

function getClient(): void {
    $result = DATABASE->queryWithParameters('SELECT c.name, c.surname, email, c.dni, p.name AS plan FROM user 
                                                    JOIN client c on user.id = c.user_id 
                                                    JOIN plan p on p.id = c.plan_id
                                                    WHERE username = :username', [
        ':username' => $_SESSION['username']
    ]);

    echo json_encode(['success' => $result->fetchArray(SQLITE3_ASSOC)]);
}

$controller = $_GET['controller'];

if(empty($controller)) {
   echo json_encode(['error' => 'No se ha adjuntado el controlador a la petición']);
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        switch($controller) {
            case 'client':
                getClient();
                break;
            case 'logout':
                logout();
                break;
        }
        break;
    case 'POST':
        switch($controller) {
            case 'client':
                createClient();
                break;
            case 'login':
                login();
                break;
        }
        break;
    default:
        echo json_encode(['error' => 'El método de la petición es erróneo']);
}