# PROYECTO LENGUAJE DE MARCAS

## ¿Cómo iniciar el proyecto?

Teniendo PHP 8.2 instalado en el ordenador, lanzar el siguiente comando en la consola (Por defecto escucha por el puerto 8000):

```bash
php -S 127.0.0.1:8000
```

## Estructura del Proyecto
```bash
.
├── api => "Contiene los archivos relacionados con la lógica de la API"
│   └── database => "Almacena la base de datos SQLite"
├── assets => "Archivos estáticos proporcionados por Metronic"
├── components => "Contiene los componentes que se mostrarán en la página de incio"
├── css => "Contiene los estilos personalizados de la aplicación"
├── images => "Contiene todas las imágenes usadas en la aplicación"
└── scripts => "Contiene la lógica general de la web"
```

## API
Para poder utilizar la API todas las peticiones se harán al endpoint:
```bash
{WEB_URL}/api/endpoint.php?controller={ACTION}
```
\
Los controladores disponibles son los siguientes:

| Controller | Method | Parameters                                       | Return                                                                                   |
|------------|--------|--------------------------------------------------|------------------------------------------------------------------------------------------|
| client     | **GET**    |                                                  | Un objeto JSON con las propiedades del usuario que esté iniciado sesión en la plataforma |
| logout     | **GET**    |                                                  | `Nota:` Redirige al usuario a la página principal                                          |
| client     | **POST**   | `name`, `surname`, `email`, `dni`, `password`, `energy_plan` | Un objeto JSON que contiene el nombre de usuario si la operación se realizó con éxito    |
| login      | **POST**   | `username`, `password`                               | Un objeto JSON que indica si el usuario pudo o no iniciar sesión en la aplicación        |


>**Nota**: Cuando se requiere enviar la contraseña al backend es necesario enviar la contraseña ya encriptada desde la aplicación, de esta manera no se expone la información al hacer el intercambio de datos entre el backend y el frontend.

.

### Ejemplo de uso
Ejemplo de uso de la API utilizando la librería `JQuery`:
```js
$.ajax({
    url: '/api/endpoint.php?controller=client',
    type: 'GET',
    dataType: 'json',
    success: function(response) {
        // Manejar la respuesta JSON aquí
    },
    error: function(xhr, status, error) {
        // Manejar errores aquí
    }
});
```

## Inicio de Sesión

Para poder acceder al área de clientes puedes usar las siguientes credenciales:

```bash
Usuario: "9e9ec5e6"
Contraseña: "Pepe2024!"
```

```bash
Usuario: "b3c9f843"
Contraseña: "Pruebas2024!"
```

## Registro

También se puede registrar en la aplicación para crear su propio usuario, para ello completar el formulario de la
pantalla de registro. Una vez se registre, se le mostrará una alerta mostrándole su usuario.
>**Importante**: Guarde el usuario, ya que no podrá volver a obtenerlo.