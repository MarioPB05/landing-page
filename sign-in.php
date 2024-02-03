<?php
session_start();

if(isset($_SESSION['connected']) && $_SESSION['connected']) {
    header("Location: /dashboard.php");
}

$show_header = false;
include_once 'header.php';

?>

<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(images/background_animated.svg); background-size: 90%; background-position: center bottom">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Logo-->
            <a href="/" class="mb-12">
                <img alt="Logo" src="images/logo.svg" class="h-60px" />
            </a>
            <!--end::Logo-->

            <!--begin::Wrapper-->
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <!--begin::Form-->
                <form class="form w-100" id="loginForm">
                    <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <!--begin::Title-->
                        <h1 class="text-dark mb-3">Iniciar Sesión</h1>
                        <!--end::Title-->
                        <!--begin::Link-->
                        <div class="text-gray-400 fw-bold fs-4">¿Todavía no eres cliente?,
                            <a href="/sing-up.php" class="link-primary fw-bolder">Únete hoy</a></div>
                        <!--end::Link-->
                    </div>
                    <!--begin::Heading-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label for="username" class="form-label fs-6 fw-bolder text-dark">Usuario</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input id="username" class="form-control form-control-lg form-control-solid" type="text" name="username" autocomplete="off" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack mb-2">
                            <!--begin::Label-->
                            <label for="password" class="form-label fw-bolder text-dark fs-6 mb-0">Contraseña</label>
                            <!--end::Label-->
                            <!--begin::Link-->
                            <a href="#" class="link-primary fs-6 fw-bolder">Recuperar Contraseña</a>
                            <!--end::Link-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Input-->
                        <input id="password" class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center">
                        <!--begin::Submit button-->
                        <button type="submit" class="btn btn-lg btn-success w-100 mb-5">
                            <span class="indicator-label">Acceder</span>
                        </button>
                        <!--end::Submit button-->

                        <a href="/" class="text-muted text-hover-primary px-2">Volver al Inicio</a>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
<!--end::Root-->

<?php include_once 'footer.php';?>

<script>
    $('#loginForm').on('submit', function(event) {
        event.preventDefault();

        const username = $('#username').val();
        const password = $('#password').val();
        const hashedPassword = CryptoJS.SHA256(password).toString();

        $.ajax({
            url: '/api/endpoint.php?controller=login',
            type: 'POST',
            dataType: 'json',
            data: {
                username: username,
                password: hashedPassword
            },
            success: function(response) {
                if(response.success) {
                    window.location = '/dashboard.php';
                }
            },
            error: function(error) {
                console.error(error);
            }
        });
    });
</script>