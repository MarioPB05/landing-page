<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
const ASSETS_PATH = "assets";

?>

<!DOCTYPE HTML>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>EcoSun Power</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta content="Trabajo Lenguaje de Marcas" name="description" />
    <meta content="Mario Perdiguero Barrera" name="author" />

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,300,600,700,800,900&subset=all" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

    <!-- CSS Personalizado -->
    <link href="css/styles.css" rel="stylesheet" type="text/css" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/images/icon.ico">

    <style>
        * {
            font-family: 'Montserrat', serif !important;
        }

        .pagination>li.active:hover a {
            color: white !important;
        }
    </style>
</head>
<!-- END HEAD -->

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px;<?= !empty($CUSTOM_BODY_STYLES) ? $CUSTOM_BODY_STYLES : ''  ?>">
    <div class="page-loader d-flex flex-column align-items-center justify-content-center" id="loading_indicator">
        <span class="spinner-border text-primary" role="status"></span>
        <span id="text-loading" class="text-muted fs-6 fw-semibold mt-5">Cargando...</span>
    </div>

    <script>
        document.body.style.overflowY = 'hidden';
    </script>

    <?php if(isset($show_header) && $show_header) { ?>
        <!--begin::Root-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Page-->
            <div class="page d-flex flex-row flex-column-fluid">
                <!--begin::Wrapper-->
                <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                    <!--begin::Header-->
                    <div id="kt_header" class="header align-items-stretch">
                        <!--begin::Container-->
                        <div class="container-fluid d-flex align-items-stretch justify-content-between">

                            <!--begin::Mobile logo-->
                            <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                                <p class="mb-0" href="#">
                                    EcoSun Power
                                </p>
                            </div>
                            <!--end::Mobile logo-->

                            <!--begin::Wrapper-->
                            <div class="d-flex align-items-stretch flex-lg-grow-1">
                                <!--begin::Navbar-->
                                <div class="d-flex align-items-stretch w-100" id="kt_header_nav">
                                    <!--begin::Menu wrapper-->
                                    <div class="header-menu align-items-stretch w-100" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                                        <!--begin::Menu-->
                                        <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch justify-content-center" id="#kt_header_menu" data-kt-menu="true">
                                            <div class="menu-item menu-lg-down-accordion me-lg-1">
                                                <a href="#" data-target="#ratesSection" class="menu-link scroll-btn py-3">
                                                    <span class="menu-title">Tarifas</span>
                                                </a>
                                            </div>

                                            <div class="menu-item menu-lg-down-accordion me-lg-1">
                                                <a href="#" data-target="#historySection" class="menu-link scroll-btn py-3">
                                                    <span class="menu-title">Nuestro compromiso</span>
                                                </a>
                                            </div>

                                            <div class="menu-item menu-lg-down-accordion me-lg-1">
                                                <a href="#" data-target="#contactSection" class="menu-link scroll-btn py-3">
                                                    <span class="menu-title">Contáctanos</span>
                                                </a>
                                            </div>
                                        </div>
                                        <!--end::Menu-->
                                    </div>
                                    <!--end::Menu wrapper-->
                                </div>
                                <!--end::Navbar-->

                                <!--begin::Toolbar wrapper-->
                                <div class="d-flex align-items-stretch flex-shrink-0">
                                    <!--begin::User menu-->
                                    <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                                        <!--begin::Menu wrapper-->
                                        <a href="/sign-in.php" class="btn btn-outline btn-outline-success btn-active-light-success">Área Clientes</a>
                                        <!--end::Menu wrapper-->
                                    </div>
                                    <!--end::User menu-->
                                </div>
                                <!--end::Toolbar wrapper-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Content-->
                    <div class="content d-flex flex-column flex-column-fluid bg-white" id="kt_content">
                        <!--begin::Post-->
                        <div class="post d-flex flex-column-fluid" id="kt_post">
                            <!--begin::Container-->
                            <div id="kt_content_container" class="container-xxl">
    <?php }