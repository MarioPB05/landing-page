<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$meses = [
    1 => "Enero",
    2 => "Febrero",
    3 => "Marzo",
    4 => "Abril",
    5 => "Mayo",
    6 => "Junio",
    7 => "Julio",
    8 => "Agosto",
    9 => "Septiembre",
    10 => "Octubre",
    11 => "Noviembre",
    12 => "Diciembre"
];

define("MES_ANTERIOR", isset($meses[date('n') - 1]) ? $meses[date('n') - 1] : $meses[0]);

if(empty($_SESSION['connected'])) {
    header("Location: /");
}

$show_header = false;
$CUSTOM_BODY_STYLES = "background: url('images/background_image.jpg');background-repeat: no-repeat;background-size: cover;";

include_once 'header.php';

$consumptionData = [];
$productionData = [];
$today = new DateTime(); // Obtenemos la fecha actual

for ($year = 2020; $year <= $today->format('Y'); $year++) { // Iteramos desde 2020 hasta el año actual
    $maxMonth = ($year < $today->format('Y')) ? 11 : intval($today->format('n')); // Si es el año actual, iteramos hasta el mes actual

    for ($i = 0; $i <= $maxMonth; $i++) {
        $maxDay = ($year == $today->format('Y') && $i == intval($today->format('n'))) ? intval($today->format('j')) : 30; // Si es el mes y año actual, iteramos hasta el día actual

        for ($dia = 1; $dia <= $maxDay; $dia++) {
            // Generamos los datos de consumo
            $consumptionBase = mt_rand(5, 10);

            for ($j = 1; $j <= $dia; $j++) {
                $consumptionBase += (mt_rand(0, 1) < 0.5 ? 1 : -1) * mt_rand(0, 200) / 100; // Ajuste aleatorio
                $consumptionBase = min(40, $consumptionBase); // Asegurarse de que el consumo no sea mayor que 40
                $consumptionBase = max(1, $consumptionBase); // Asegurarse de que el consumo no sea menor que 1
            }

            $consumptionData[] = ['date' => strtotime("$year-$i-$dia") * 1000, 'consumption' => number_format($consumptionBase, 2)];
        }
    }
}

for ($year = 2020; $year <= $today->format('Y'); $year++) { // Iteramos desde 2020 hasta el año actual
    $maxMonth = ($year < $today->format('Y')) ? 11 : intval($today->format('n')); // Si es el año actual, iteramos hasta el mes actual

    for ($i = 0; $i <= $maxMonth; $i++) {
        $maxDay = ($year == $today->format('Y') && $i == intval($today->format('n'))) ? intval($today->format('j')) : 30; // Si es el mes y año actual, iteramos hasta el día actual

        for ($dia = 1; $dia <= $maxDay; $dia++) {
            $daylightHours = mt_rand(1, 4); // Horas de luz solar al azar
            $dailyProduction = ($daylightHours * (2 + mt_rand(0, 200) / 100 * 2)); // Producción diaria de energía solar
            $dailyProduction = min(30, $dailyProduction); // Limitar la producción a 30 kWh
            $dailyProduction = max(0, $dailyProduction); // Asegurarse de que no sea negativa

            $productionData[] = ['date' => strtotime("$year-$i-$dia") * 1000, 'production' => number_format($dailyProduction, 2)];
        }
    }
}

function filterDataByMonthAndYear($data, $month, $year): array {
    $filteredData = [];
    foreach ($data as $entry) {
        $entryMonth = (int)date('n', $entry['date'] / 1000); // Extraemos el mes de la fecha Unix en milisegundos
        $entryYear = (int)date('Y', $entry['date'] / 1000); // Extraemos el año de la fecha Unix en milisegundos
        if ($entryMonth === $month && $entryYear === $year) {
            $filteredData[] = $entry;
        }
    }
    return $filteredData;
}

?>

<script>
    const consumptionData = <?= json_encode($consumptionData) ?>;
    const productionData = <?= json_encode($productionData) ?>;
</script>

<svg class="position-absolute d-inline d-xl-none" style="bottom: -5px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="white" fill-opacity="1" d="M0,192L48,192C96,192,192,192,288,197.3C384,203,480,213,576,186.7C672,160,768,96,864,90.7C960,85,1056,139,1152,154.7C1248,171,1344,149,1392,138.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
</svg>

<div class="d-flex h-xl-100 justify-content-center align-items-center flex-column flex-xl-row gap-4 p-4">

    <div class="card shadow-sm w-100 mw-850px h-auto mh-xl-850px">
        <div class="card-header">
            <h3 class="card-title fw-boldest">Resumen</h3>
            <div class="card-toolbar">
                <!--begin::Menu wrapper-->
                <div class="d-flex align-items-center gap-4 p-2 rounded bg-light-success bg-hover-success text-success text-hover-white cursor-pointer" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                    <p class="mb-0 fw-bolder clientName">Mario Perdiguero Barrera</p>

                    <div class="symbol symbol-30px symbol-md-40px symbol-circle">
                        <img src="images/profile.jpg" alt="user" />
                    </div>
                </div>

                <!--begin::User account menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <div class="menu-content d-flex align-items-center px-3">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-50px me-5">
                                <img alt="Logo" src="images/profile.jpg" />
                            </div>
                            <!--end::Avatar-->
                            <!--begin::Username-->
                            <div class="d-flex flex-column">
                                <div class="fw-bolder d-flex align-items-center fs-5 text-nowrap">
                                    <span class="clientName"></span>
                                </div>

                                <div class="d-inline badge badge-light-success fw-bolder fs-8 px-2 py-1 mt-2 clientPlan"></div>
                            </div>
                            <!--end::Username-->
                        </div>
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>
                    <!--end::Menu separator-->

                    <!--begin::Menu item-->
                    <div class="menu-item px-5">
                        <a href="/" class="menu-link px-5">Inicio</a>
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu item-->
                    <div class="menu-item text-hover-danger px-5">
                        <a href="/api/endpoint.php?controller=logout" class="menu-link px-5" style="color:inherit;">Cerrar Sesión</a>
                    </div>
                    <!--end::Menu item-->
                </div>
                <!--end::User account menu-->
                <!--end::Menu wrapper-->
            </div>
        </div>

        <div class="card-body">
            <div class="d-flex flex-column flex-md-row w-100 h-xl-100 h-xl-375px gap-8">
                <div class="w-100 mw-md-475px h-375px bg-warning shadow rounded p-4 position-relative" style="background-image: url(images/background_animated.svg); background-repeat: no-repeat; background-position: center bottom">
                    <p class="mb-0 fw-bolder">Control del Panel Solar</p>

                    <div class="h-125px w-125px rounded-circle bg-success text-white d-flex flex-column align-items-center justify-content-center position-absolute top-25" style="left: 27px;" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="bottom" title="Capacidad de tus baterías">
                        <span>Capacidad</span>
                        <span class="fw-bolder fs-2qx mb-n2">320</span>
                        <span>kWh</span>
                    </div>

                    <div class="h-125px w-125px rounded-circle bg-success text-white d-flex flex-column align-items-center justify-content-center position-absolute" style="top: 24px;right: 24px;" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="bottom" title="Producción de tus placas solares">
                        <span>Producción</span>
                        <span id="energyProduced" class="fw-bolder fs-2qx mb-n2"><?= random_int(15, 250) ?></span>
                        <span>kWh</span>
                    </div>
                </div>

                <!-- scroll-x -->
                <div class="w-md-325px min-w-md-325px mw-auto h-xl-100 d-flex gap-8 flex-column flex-sm-row flex-md-column align-items-center justify-content-between p-2 p-sm-0">
                    <div class="d-flex gap-4 justify-content-between h-xl-50 min-w-sm-325px w-100 w-sm-auto">
                        <div class="d-flex flex-column w-50 mw-sm-150px mh-150px mh-sm-100 bg-success text-white shadow rounded p-4 position-relative" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top" title="Datos de <?= MES_ANTERIOR ?>">
                            <svg class="position-absolute" style="top: 14px;right: 14px;" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="11" cy="11" r="10.5" stroke="white"/>
                                <path d="M6.5 12.5C6.0875 12.5 5.73438 12.3531 5.44063 12.0594C5.14687 11.7656 5 11.4125 5 11C5 10.5875 5.14687 10.2344 5.44063 9.94063C5.73438 9.64687 6.0875 9.5 6.5 9.5C6.9125 9.5 7.26562 9.64687 7.55938 9.94063C7.85313 10.2344 8 10.5875 8 11C8 11.4125 7.85313 11.7656 7.55938 12.0594C7.26562 12.3531 6.9125 12.5 6.5 12.5ZM11 12.5C10.5875 12.5 10.2344 12.3531 9.94063 12.0594C9.64688 11.7656 9.5 11.4125 9.5 11C9.5 10.5875 9.64688 10.2344 9.94063 9.94063C10.2344 9.64687 10.5875 9.5 11 9.5C11.4125 9.5 11.7656 9.64687 12.0594 9.94063C12.3531 10.2344 12.5 10.5875 12.5 11C12.5 11.4125 12.3531 11.7656 12.0594 12.0594C11.7656 12.3531 11.4125 12.5 11 12.5ZM15.5 12.5C15.0875 12.5 14.7344 12.3531 14.4406 12.0594C14.1469 11.7656 14 11.4125 14 11C14 10.5875 14.1469 10.2344 14.4406 9.94063C14.7344 9.64687 15.0875 9.5 15.5 9.5C15.9125 9.5 16.2656 9.64687 16.5594 9.94063C16.8531 10.2344 17 10.5875 17 11C17 11.4125 16.8531 11.7656 16.5594 12.0594C16.2656 12.3531 15.9125 12.5 15.5 12.5Z" fill="white"/>
                            </svg>

                            <div class="d-flex justify-content-center align-items-center w-50px h-50px bg-white rounded-4 mb-4">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.625 18.175L1 17L6 9L9 12.5L13 6L15.725 10.075C15.3417 10.0917 14.9792 10.1375 14.6375 10.2125C14.2958 10.2875 13.9583 10.3917 13.625 10.525L13.075 9.7L9.275 15.875L6.25 12.35L2.625 18.175ZM21.575 23L18.45 19.875C18.1167 20.1083 17.7458 20.2833 17.3375 20.4C16.9292 20.5167 16.5083 20.575 16.075 20.575C14.825 20.575 13.7625 20.1375 12.8875 19.2625C12.0125 18.3875 11.575 17.325 11.575 16.075C11.575 14.825 12.0125 13.7625 12.8875 12.8875C13.7625 12.0125 14.825 11.575 16.075 11.575C17.325 11.575 18.3875 12.0125 19.2625 12.8875C20.1375 13.7625 20.575 14.825 20.575 16.075C20.575 16.5083 20.5167 16.9292 20.4 17.3375C20.2833 17.7458 20.1083 18.125 19.875 18.475L23 21.575L21.575 23ZM16.075 18.575C16.775 18.575 17.3667 18.3333 17.85 17.85C18.3333 17.3667 18.575 16.775 18.575 16.075C18.575 15.375 18.3333 14.7833 17.85 14.3C17.3667 13.8167 16.775 13.575 16.075 13.575C15.375 13.575 14.7833 13.8167 14.3 14.3C13.8167 14.7833 13.575 15.375 13.575 16.075C13.575 16.775 13.8167 17.3667 14.3 17.85C14.7833 18.3333 15.375 18.575 16.075 18.575ZM18.3 10.575C17.9833 10.4417 17.6542 10.3333 17.3125 10.25C16.9708 10.1667 16.6167 10.1167 16.25 10.1L21.375 2L23 3.175L18.3 10.575Z" fill="#FFC107"/>
                                </svg>
                            </div>

                            <span class="fw-boldest fs-2 mb-n1"><?= round(array_sum(array_column(filterDataByMonthAndYear($consumptionData, 1, 2024), 'consumption'))) ?> kWh</span>
                            <span>Consumo</span>

                            <span class="mt-4 fw-bold text-center">Beneficio - 28%</span>
                        </div>

                        <div class="d-flex flex-column w-50 mw-sm-150px mh-150px mh-sm-100 bg-warning shadow rounded p-4 position-relative" style="color: #315017;" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top" title="Datos de <?= MES_ANTERIOR ?>">
                            <svg class="position-absolute" style="top: 14px;right: 14px;" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="11" cy="11" r="10.5" stroke="white"/>
                                <path d="M6.5 12.5C6.0875 12.5 5.73438 12.3531 5.44063 12.0594C5.14687 11.7656 5 11.4125 5 11C5 10.5875 5.14687 10.2344 5.44063 9.94063C5.73438 9.64687 6.0875 9.5 6.5 9.5C6.9125 9.5 7.26562 9.64687 7.55938 9.94063C7.85313 10.2344 8 10.5875 8 11C8 11.4125 7.85313 11.7656 7.55938 12.0594C7.26562 12.3531 6.9125 12.5 6.5 12.5ZM11 12.5C10.5875 12.5 10.2344 12.3531 9.94063 12.0594C9.64688 11.7656 9.5 11.4125 9.5 11C9.5 10.5875 9.64688 10.2344 9.94063 9.94063C10.2344 9.64687 10.5875 9.5 11 9.5C11.4125 9.5 11.7656 9.64687 12.0594 9.94063C12.3531 10.2344 12.5 10.5875 12.5 11C12.5 11.4125 12.3531 11.7656 12.0594 12.0594C11.7656 12.3531 11.4125 12.5 11 12.5ZM15.5 12.5C15.0875 12.5 14.7344 12.3531 14.4406 12.0594C14.1469 11.7656 14 11.4125 14 11C14 10.5875 14.1469 10.2344 14.4406 9.94063C14.7344 9.64687 15.0875 9.5 15.5 9.5C15.9125 9.5 16.2656 9.64687 16.5594 9.94063C16.8531 10.2344 17 10.5875 17 11C17 11.4125 16.8531 11.7656 16.5594 12.0594C16.2656 12.3531 15.9125 12.5 15.5 12.5Z" fill="white"/>
                            </svg>

                            <div class="d-flex justify-content-center align-items-center w-50px h-50px bg-white rounded-4 mb-4">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16 20V13H20V20H16ZM10 20V4H14V20H10ZM4 20V9H8V20H4Z" fill="#50CD89"/>
                                </svg>
                            </div>

                            <span class="fw-boldest fs-2 mb-n1"><?= round(array_sum(array_column(filterDataByMonthAndYear($productionData, 1, 2024), 'production'))) ?> kWh</span>
                            <span>Carga Total</span>

                            <span class="mt-4 fw-bold text-center">Pérdida - 12.54%</span>
                        </div>
                    </div>

                    <div class="w-md-100 h-xl-50 bg-white shadow rounded p-4 position-relative">
                        <span class="fw-boldest fs-1 mb-n1">Consumo Actual</span>
                        <p class="f-7 mb-8 pe-6 min-w-175px min-w-sm-0">Seguimiento y análisis de los datos de consumo eléctrico en tiempo real.</p>

                        <div class="d-flex justify-content-between align-items-center">
                            <span id="currentSpent" class="fw-boldest fs-2">3.45 kWh</span>

                            <p class="text-muted fw-light mb-0 d-none d-md-inline">Consumo Estimado</p>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="card-title fw-boldest mt-10">Energía Producida y Gastada</h3>

            <div class="h-300px" id="firstChart"></div>
        </div>
    </div>

    <div class="card shadow-sm w-100 mw-850px mw-xl-400px h-auto mh-xl-850px overflow-auto scroll-auto" style="background-color: rgba(255, 255, 255, 0.90);">
        <div class="card-body">
            <h3 class="fw-boldest mt-4 mb-0">Gastos de <?= MES_ANTERIOR ?></h3>
            <p class="fw-light">Tu consumo en el mes anterior.</p>

            <div class="h-325px" id="secondChart"></div>

            <div class="separator border-success my-10"></div>

            <div class="w-100 d-flex justify-content-around justify-content-xl-between">
                <?php
                // Consultar los consumos maximos
                $consumptionMonth = [];
                $averageConsumption = [];

                $maxConsumption = 0;
                $maxMonth = null;
                $maxYear = null;

                $minConsumption = PHP_INT_MAX;
                $minMonth = null;
                $minYear = null;

                for ($year = 2020; $year <= $today->format('Y'); $year++) { // Iteramos desde 2020 hasta el año actual
                    $maxMonth = ($year < $today->format('Y')) ? 11 : intval($today->format('n')); // Si es el año actual, iteramos hasta el mes actual

                    for ($i = 0; $i <= $maxMonth; $i++) {
                        $totalMonthConsumption = 0;
                        $maxDay = ($year == $today->format('Y') && $i == intval($today->format('n'))) ? intval($today->format('j')) : 30; // Si es el mes y año actual, iteramos hasta el día actual

                        for ($dia = 1; $dia <= $maxDay; $dia++) {
                            $totalMonthConsumption += $consumptionData[($year - 2020) + $i + ($dia - 1)]['consumption'];
                        }

                        $consumptionMonth[] = ['consumption' => $totalMonthConsumption, 'month' => $i, 'year' => $year];
                        $averageConsumption[] = $totalMonthConsumption;
                    }
                }

                $averageConsumption = round(array_sum($averageConsumption) / count($averageConsumption));

                foreach ($consumptionMonth as $dato) {
                    if ($dato['consumption'] > $maxConsumption) {
                        $maxConsumption = round($dato['consumption']);
                        $maxMonth = $dato['month'];
                        $maxYear = $dato['year'];
                    }
                }

                foreach ($consumptionMonth as $dato) {
                    if ($dato['consumption'] < $minConsumption) {
                        $minConsumption = round($dato['consumption']);
                        $minMonth = $dato['month'];
                        $minYear = $dato['year'];
                    }
                }
                ?>

                <div class="d-flex flex-column align-items-center align-items-xl-start">
                    <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="17" cy="17" r="17" fill="#FFC107"/>
                        <path d="M16 25V12.825L10.4 18.425L9 17L17 9L25 17L23.6 18.425L18 12.825V25H16Z" fill="black"/>
                    </svg>

                    <p class="fw-boldest fs-3 mt-4 mb-0"><?= $maxConsumption ?> kWh</p>
                    <span>Uso máximo</span>
                    <span class="fw-light fs-8"><?= $meses[$maxMonth + 1] . " " . $maxYear ?></span>
                </div>

                <div class="d-flex flex-column align-items-center align-items-xl-start">
                    <svg width="35" height="34" viewBox="0 0 35 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="17.5" cy="17" r="17" fill="#FFC107"/>
                        <path d="M18.5 9L18.5 21.175L24.1 15.575L25.5 17L17.5 25L9.5 17L10.9 15.575L16.5 21.175L16.5 9L18.5 9Z" fill="black"/>
                    </svg>

                    <p class="fw-boldest fs-3 mt-4 mb-0"><?= $minConsumption ?> kWh</p>
                    <span>Uso mínimo</span>
                    <span class="fw-light fs-8"><?= $meses[$minMonth + 1] . " " . $maxYear ?></span>
                </div>

                <div class="d-flex flex-column align-items-center align-items-xl-start">
                    <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="17" cy="17" r="17" fill="#FFC107"/>
                        <path d="M17 27C15.6167 27 14.3167 26.7375 13.1 26.2125C11.8833 25.6875 10.825 24.975 9.925 24.075C9.025 23.175 8.3125 22.1167 7.7875 20.9C7.2625 19.6833 7 18.3833 7 17C7 15.6167 7.2625 14.3167 7.7875 13.1C8.3125 11.8833 9.025 10.825 9.925 9.925C10.825 9.025 11.8833 8.3125 13.1 7.7875C14.3167 7.2625 15.6167 7 17 7C18.3833 7 19.6833 7.2625 20.9 7.7875C22.1167 8.3125 23.175 9.025 24.075 9.925C24.975 10.825 25.6875 11.8833 26.2125 13.1C26.7375 14.3167 27 15.6167 27 17C27 18.3833 26.7375 19.6833 26.2125 20.9C25.6875 22.1167 24.975 23.175 24.075 24.075C23.175 24.975 22.1167 25.6875 20.9 26.2125C19.6833 26.7375 18.3833 27 17 27ZM17 25C19.2333 25 21.125 24.225 22.675 22.675C24.225 21.125 25 19.2333 25 17C25 14.7667 24.225 12.875 22.675 11.325C21.125 9.775 19.2333 9 17 9C14.7667 9 12.875 9.775 11.325 11.325C9.775 12.875 9 14.7667 9 17C9 19.2333 9.775 21.125 11.325 22.675C12.875 24.225 14.7667 25 17 25ZM17 23C15.3333 23 13.9167 22.4167 12.75 21.25C11.5833 20.0833 11 18.6667 11 17C11 15.3333 11.5833 13.9167 12.75 12.75C13.9167 11.5833 15.3333 11 17 11C18.6667 11 20.0833 11.5833 21.25 12.75C22.4167 13.9167 23 15.3333 23 17C23 18.6667 22.4167 20.0833 21.25 21.25C20.0833 22.4167 18.6667 23 17 23ZM17 21C18.1 21 19.0417 20.6083 19.825 19.825C20.6083 19.0417 21 18.1 21 17C21 15.9 20.6083 14.9583 19.825 14.175C19.0417 13.3917 18.1 13 17 13C15.9 13 14.9583 13.3917 14.175 14.175C13.3917 14.9583 13 15.9 13 17C13 18.1 13.3917 19.0417 14.175 19.825C14.9583 20.6083 15.9 21 17 21ZM17 19C16.45 19 15.9792 18.8042 15.5875 18.4125C15.1958 18.0208 15 17.55 15 17C15 16.45 15.1958 15.9792 15.5875 15.5875C15.9792 15.1958 16.45 15 17 15C17.55 15 18.0208 15.1958 18.4125 15.5875C18.8042 15.9792 19 16.45 19 17C19 17.55 18.8042 18.0208 18.4125 18.4125C18.0208 18.8042 17.55 19 17 19Z" fill="black"/>
                    </svg>

                    <p class="fw-boldest fs-3 mt-4 mb-0"><?= $averageConsumption ?> kWh</p>
                    <span>Media</span>
                    <span class="fw-light fs-8">Mensual</span>
                </div>
            </div>

            <div class="separator border-success my-10"></div>

            <h3 class="fw-boldest mb-4">Facturas 2023</h3>

            <!--begin::Accordion-->
            <div class="accordion" id="accordion_invoices">
                <div class="d-none accordion-item accordion-item-template">
                    <h2 class="accordion-header">
                        <button class="accordion-button fs-4 fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="" aria-expanded="false" aria-controls="">Enero <span id="januaryConsumption"></span></button>
                    </h2>
                    <div id="" class="accordion-collapse collapse" aria-labelledby="accordion_invoices_header_1" data-bs-parent="#accordion_invoices">

                    </div>
                </div>

                <?php
                foreach ($meses as $index => $mes) { ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button fs-4 fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $mes ?>" aria-expanded="false" aria-controls="<?= $mes ?>">
                                <?= $mes ?>
                            </button>
                        </h2>

                        <div id="<?= $mes ?>" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_2" data-bs-parent="#accordion_invoices">
                            <div class="accordion-body">
                                <?php
                                // Obtener la energia consumida en el mes
                                $filteredConsumptionData = filterDataByMonthAndYear($consumptionData, $index, 2023);
                                $totalConsumption = array_sum(array_column($consumptionData, 'consumption'));

                                $filteredProductionData = filterDataByMonthAndYear($productionData, $index, 2023);
                                $totalProduction = array_sum(array_column($consumptionData, 'consumption'));

                                // GENERAR EL ESTADO DE LA FACTURA ALEATORIAMENTE
                                $randomNumber = rand(1, 100);

                                $paidRange = 70;
                                $returnedRange = $paidRange + 20;
                                $unpaidRange = $returnedRange + 10;

                                if ($randomNumber <= $paidRange) {
                                    $estado = '<span class="badge badge-light-success">Factura Pagada</span>';
                                } elseif ($randomNumber <= $returnedRange) {
                                    $estado = '<span class="badge badge-light-warning">Factura Devuelta</span>';
                                } else {
                                    $estado = '<span class="badge badge-light-danger">Pendiente de Pago</span>';
                                }
                                ?>

                                <p><strong>Producida:</strong> <?= rand(30, 350) ?> kWh</p>
                                <p><strong>Gastada:</strong> <?= rand(30, 200) ?> kWh</p>
                                <p><strong>Estado: </strong> <?= $estado ?></p>

                                <a href="/invoice.php?date=<?= $filteredConsumptionData[0]['date'] ?>" target="_blank" class="btn btn-icon btn-success fw-bolder mt-4 w-100 generate_pdf">
                                    <span class="svg-icon svg-icon-1 me-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                          <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                          <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                        </svg>
                                    </span>
                                    Consultar Factura
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <!--end::Accordion-->
        </div>
    </div>

</div>

<?php include_once 'footer.php'; ?>

<script>
    $(function () {
        // Función para actualizar el número
        function actualizaEnergiaProducida() {
            const energyProduced = $('#energyProduced');
            const numeroActual = parseInt(energyProduced.text());
            const cambio = Math.floor(Math.random() * 21) - 10;
            const total = numeroActual + cambio;

            energyProduced.text(numeroActual);
            energyProduced.animate({
                num: total
            }, {
                duration: 1500,
                step: function(now) {
                    energyProduced.text(Math.floor(now));
                }
            });
        }

        function actualizarEnergiaGastada() {
            const energyProduced = $('#currentSpent');
            const numeroActual = parseInt(energyProduced.text());
            const cambio = Math.random() * 2 - 1;
            let total = numeroActual + cambio;
            total = Math.max(total, 0);

            energyProduced.animate({
                num: total
            }, {
                duration: 1000,
                step: function(now) {
                    energyProduced.text(now.toFixed(2) + 'kWh');
                }
            });
        }

        setInterval(actualizaEnergiaProducida, 10000);
        setInterval(actualizarEnergiaGastada, 3500);

        let i;
        const data = [];

        consumptionData.forEach(item => {
            item.consumption = parseFloat(item.consumption);
        });

        productionData.forEach(item => {
            item.production = parseFloat(item.production);
        });

        // Generar datos ficticios para consumo
        // let consumptionBase = 10; // kWh
        // let dia = 1;

        am5.ready(function () {
            // Combinar los datos de consumo y producción
            for (i = 0; i < consumptionData.length; i++) {
                data.push({
                    date: consumptionData[i].date,
                    consumption: consumptionData[i].consumption,
                    production: productionData[i].production
                });
            }

            // Crear root element
            const root = am5.Root.new("firstChart");

            // Establecer temas
            root.setThemes([
                am5themes_Animated.new(root)
            ]);

            // Crear chart
            const chart = root.container.children.push(
                am5xy.XYChart.new(root, {
                    panX: true,
                    panY: true,
                    wheelX: "panX",
                    wheelY: "zoomX"
                })
            );

            // Agregar cursor
            const cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
                behavior: "none"
            }));
            cursor.lineY.set("visible", false);

            // Crear ejes
            const xAxis = chart.xAxes.push(
                am5xy.DateAxis.new(root, {
                    baseInterval: {timeUnit: "day", count: 1},
                    renderer: am5xy.AxisRendererX.new(root, {}),
                    tooltip: am5.Tooltip.new(root, {}),
                    tooltipDateFormat: "yyyy-MM-dd"
                })
            );

            const yAxis = chart.yAxes.push(
                am5xy.ValueAxis.new(root, {
                    maxDeviation: 1,
                    renderer: am5xy.AxisRendererY.new(root, {pan: "zoom"}),
                    tooltip: am5.Tooltip.new(root, {})
                })
            );

            // Agregar series
            const seriesConsumption = chart.series.push(
                am5xy.LineSeries.new(root, {
                    name: "Energía Gastada",
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueYField: "consumption",
                    valueXField: "date",
                    tooltip: am5.Tooltip.new(root, {
                        labelText: "{valueY}"
                    }),
                    stroke: am5.color(0xf1416c)
                })
            );

            const seriesProduction = chart.series.push(
                am5xy.LineSeries.new(root, {
                    name: "Energía Producida",
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueYField: "production",
                    valueXField: "date",
                    tooltip: am5.Tooltip.new(root, {
                        labelText: "{valueY}"
                    }),
                    stroke: am5.color(0x50CD89)
                })
            );

            // Agregar datos a las series
            seriesConsumption.data.setAll(data);
            seriesProduction.data.setAll(data);

            seriesProduction.events.once("datavalidated", function(ev, target) {
                xAxis.zoomToDates(
                    new Date((new Date).getFullYear(), (new Date).getMonth() - 4, 1), new Date())
            });

            // Animación de carga
            seriesConsumption.appear(1000);
            seriesProduction.appear(1000);
            chart.appear(1000, 100);
        });

        // Procesar los datos para obtener consumo en periodo punto, llano y valle
        const consumoPunto = [];
        const consumoLlano = [];
        const consumoValle = [];

        // Obtener la fecha actual
        const currentDate = new Date();
        const currentMonth = currentDate.getMonth() - 1;
        const currentYear = currentDate.getFullYear();

        // Filtrar los elementos de consumptionData para obtener solo los del mes pasado
        const currentMonthData = consumptionData.filter(function(item) {
            const itemDate = new Date(item.date);
            const itemMonth = itemDate.getMonth();
            const itemYear = itemDate.getFullYear();

            return itemMonth === currentMonth && itemYear === currentYear;
        });

        currentMonthData.forEach(function(item) {
            // Probabilidad de periodo llano: 70%
            // Probabilidad de periodo valle: 20%
            // Probabilidad de periodo punto: 10%
            const randomProbability = Math.random();
            if (randomProbability < 0.5) {
                consumoLlano.push(item.consumption);
            } else if (randomProbability < 0.7) {
                consumoValle.push(item.consumption);
            } else {
                consumoPunto.push(item.consumption);
            }
        });

        // Obtener la cantidad de elementos en cada lista
        const cantidadPunto = consumoPunto.length;
        const cantidadLlano = consumoLlano.length;
        const cantidadValle = consumoValle.length;

        // Calcular el total de consumos
        const totalConsumos = cantidadPunto + cantidadLlano + cantidadValle;

        // Calcular los porcentajes
        const porcentajePunto = ((cantidadPunto / totalConsumos) * 100).toFixed(2);
        const porcentajeLlano = ((cantidadLlano / totalConsumos) * 100).toFixed(2);
        const porcentajeValle = ((cantidadValle / totalConsumos) * 100).toFixed(2);

        am5.ready(function () {
            const root = am5.Root.new("secondChart");

            root.setThemes([
                am5themes_Animated.new(root)
            ]);

            const chart = root.container.children.push(am5radar.RadarChart.new(root, {
                panX: false,
                panY: false,
                wheelX: "panX",
                wheelY: "zoomX",
                innerRadius: am5.percent(20),
                startAngle: -90,
                endAngle: 180
            }));

            // Data
            const data = [{
                category: "Período Punta",
                value: porcentajePunto,
                full: 100,
                columnSettings: {
                    fill: am5.color(0xf1416c)
                }
            }, {
                category: "Período Llano",
                value: porcentajeLlano,
                full: 100,
                columnSettings: {
                    fill: am5.color(0xFFC107)
                }
            }, {
                category: "Período Valle",
                value: porcentajeValle,
                full: 100,
                columnSettings: {
                    fill: am5.color(0x50CD89)
                }
            }];

            const cursor = chart.set("cursor", am5radar.RadarCursor.new(root, {
                behavior: "zoomX"
            }));

            cursor.lineY.set("visible", false);

            const xRenderer = am5radar.AxisRendererCircular.new(root, {
                //minGridDistance: 50
            });

            xRenderer.labels.template.setAll({
                radius: 10
            });

            xRenderer.grid.template.setAll({
                forceHidden: true
            });

            const xAxis = chart.xAxes.push(am5xy.ValueAxis.new(root, {
                renderer: xRenderer,
                min: 0,
                max: 100,
                strictMinMax: true,
                numberFormat: "#'%'",
                tooltip: am5.Tooltip.new(root, {})
            }));

            const yRenderer = am5radar.AxisRendererRadial.new(root, {
                minGridDistance: 20
            });

            yRenderer.labels.template.setAll({
                centerX: am5.p100,
                fontWeight: "500",
                fontSize: 18,
                templateField: "columnSettings"
            });

            yRenderer.grid.template.setAll({
                forceHidden: true
            });

            const yAxis = chart.yAxes.push(am5xy.CategoryAxis.new(root, {
                categoryField: "category",
                renderer: yRenderer
            }));

            yAxis.data.setAll(data);

            const series1 = chart.series.push(am5radar.RadarColumnSeries.new(root, {
                xAxis: xAxis,
                yAxis: yAxis,
                clustered: false,
                valueXField: "full",
                categoryYField: "category",
                fill: root.interfaceColors.get("alternativeBackground")
            }));

            series1.columns.template.setAll({
                width: am5.p100,
                fillOpacity: 0.08,
                strokeOpacity: 0,
                cornerRadius: 20
            });

            series1.data.setAll(data);

            const series2 = chart.series.push(am5radar.RadarColumnSeries.new(root, {
                xAxis: xAxis,
                yAxis: yAxis,
                clustered: false,
                valueXField: "value",
                categoryYField: "category"
            }));

            series2.columns.template.setAll({
                width: am5.p100,
                strokeOpacity: 0,
                tooltipText: "{category}: {valueX}%",
                cornerRadius: 20,
                templateField: "columnSettings"
            });

            series2.data.setAll(data);

            series1.appear(1000);
            series2.appear(1000);
            chart.appear(1000, 100);
        });

        $.ajax({
            url: '/api/endpoint.php?controller=client',
            type: 'GET', // Puedes cambiar 'GET' por 'POST' si necesitas enviar datos al servidor
            dataType: 'json',
            success: function(response) {
                // Manejar la respuesta JSON aquí
                if(response.success) {
                    const clientData = response.success;

                    $('.clientName').text(clientData.name + ' ' + clientData.surname);
                    $('.clientDNI').text(clientData.dni);
                    $('.clientPlan').text(clientData.plan);
                }
            },
            error: function(xhr, status, error) {
                // Manejar errores aquí
                console.error(status, error);
            }
        });
    });
</script>
