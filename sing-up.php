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
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
         style="background-image: url(images/background_animated.svg); background-size: 90%; background-position: center bottom">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <!--begin::Logo-->
            <a href="/" class="mb-12">
                <img alt="Logo" src="images/logo.svg" class="h-60px"/>
            </a>
            <!--end::Logo-->
            <!--begin::Wrapper-->
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <!--begin::Form-->
                <form class="form w-100" id="sign_up_form">
                    <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <!--begin::Title-->
                        <h1 class="text-dark mb-3">Únete a Nosotros</h1>
                        <!--end::Title-->
                        <!--begin::Link-->
                        <div class="text-gray-400 fw-bold fs-4">¿Ya eres cliente?,
                            <a href="/sign-in.php" class="link-primary fw-bolder">Iniciar Sesión</a></div>
                        <!--end::Link-->
                    </div>
                    <!--begin::Heading-->

                    <!--begin::Input group-->
                    <div class="row fv-row mb-7">
                        <!--begin::Col-->
                        <div class="col-xl-6 mb-7 mb-xl-0">
                            <label for="name" class="form-label fw-bolder text-dark fs-6">Nombre</label>
                            <input id="name" class="form-control form-control-lg form-control-solid" type="text"
                                   placeholder=""
                                   name="first-name" autocomplete="off"/>
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-xl-6">
                            <label for="last_name" class="form-label fw-bolder text-dark fs-6">Apellidos</label>
                            <input id="last_name" class="form-control form-control-lg form-control-solid" type="text"
                                   placeholder=""
                                   name="last-name" autocomplete="off"/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <label for="email" class="form-label fw-bolder text-dark fs-6">Correo Electrónico</label>
                        <input id="email" class="form-control form-control-lg form-control-solid" type="email"
                               placeholder=""
                               name="email" autocomplete="off"/>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <label for="dni" class="form-label fw-bolder text-dark fs-6">DNI</label>
                        <input id="dni" class="form-control form-control-lg form-control-solid" type="text"
                               placeholder=""
                               name="dni" autocomplete="off"/>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="mb-10 fv-row" data-kt-password-meter="true">
                        <!--begin::Wrapper-->
                        <div class="mb-1">
                            <!--begin::Label-->
                            <label class="form-label fw-bolder text-dark fs-6" for="password">Contraseña</label>
                            <!--end::Label-->
                            <!--begin::Input wrapper-->
                            <div class="position-relative mb-3">
                                <input id="password" class="form-control form-control-lg form-control-solid"
                                       type="password"
                                       placeholder="" name="password" autocomplete="off"/>
                                <span id="password_visibility" data-visibility="false"
                                      class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2">
                                    <i class="bi bi-eye-slash fs-2"></i>
                                    <i class="bi bi-eye fs-2 d-none"></i>
                                </span>
                            </div>
                            <!--end::Input wrapper-->
                            <!--begin::Meter-->
                            <div id="password_meter" class="align-items-center mb-3">
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                            </div>
                            <!--end::Meter-->
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Hint-->
                        <div id="password_meter_hint" class="text-muted">Utilice 8 o más caracteres con una mezcla de
                            letras, números y
                            símbolos.
                        </div>
                        <!--end::Hint-->
                    </div>
                    <!--end::Input group=-->

                    <!--begin::Input group-->
                    <div class="fv-row mb-5">
                        <label for="confirm_password" class="form-label fw-bolder text-dark fs-6">Confirmar
                            Contraseña</label>
                        <input id="confirm_password" class="form-control form-control-lg form-control-solid"
                               type="password" placeholder=""
                               name="confirm-password" autocomplete="off"/>

                        <!--begin::Hint-->
                        <div class="d-none text-danger mt-3">Las contraseñas no coinciden</div>
                        <!--end::Hint-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="fv-row mb-10 d-none">
                        <label class="form-check form-check-custom form-check-solid form-check-inline">
                            <input class="form-check-input" type="checkbox" name="toc" value="1"/>
                            <span class="form-check-label fw-bold text-gray-700 fs-6">Acepto
									<a href="#" class="ms-1 link-primary">Términos y condiciones</a>.</span>
                        </label>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Actions-->
                    <div class="text-center">
                        <!--begin::Submit button-->
                        <button type="submit" class="btn btn-lg btn-success w-100 mb-5">
                            <span class="indicator-label">Seleccionar Tarifa</span>
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

<?php
include_once 'components/ratesModal.php';
include_once 'footer.php'
?>

<script>
    const lettersDNI = new Map([
        [0, 'T'],
        [1, 'R'],
        [2, 'W'],
        [3, 'A'],
        [4, 'G'],
        [5, 'M'],
        [6, 'Y'],
        [7, 'F'],
        [8, 'P'],
        [9, 'D'],
        [10, 'X'],
        [11, 'B'],
        [12, 'N'],
        [13, 'J'],
        [14, 'Z'],
        [15, 'S'],
        [16, 'Q'],
        [17, 'V'],
        [18, 'H'],
        [19, 'L'],
        [20, 'C'],
        [21, 'K'],
        [22, 'E']
    ]);

    $(function () {
        const nameInput = $('#name');
        const lastNameInput = $('#last_name');
        const emailInput = $('#email');
        const dniInput = $('#dni');
        const passwordInput = $('#password');
        const confirmPasswordInput = $('#confirm_password');
        const ratesModalButton = $('#rates_modal').find('button[type="submit"]');

        $('#password_meter, #password_meter_hint').hide();
        ratesModalButton.text('Crear Cuenta');

        Inputmask({
            "mask": "99999999-A",
        }).mask("#dni");

        function toggleInput(obj, toggle) {
            if (toggle) {
                $(obj)
                    .removeClass('is-invalid border border-danger')
                    .addClass('is-valid border border-success');
            } else {
                $(obj)
                    .removeClass('is-valid border border-success')
                    .addClass('is-invalid border border-danger');
            }
        }

        function validateEmail() {
            const isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.val());

            toggleInput(emailInput, isValid);

            return isValid;
        }

        function validateDNI() {
            const value = dniInput.val();
            const isValid = /^[0-9]{8}[A-Z]$/.test(value.replace('-', ''));

            if (value.length === 10) {
                if (!value || value.trim() === '') {
                    toggleInput(dniInput, false);
                    return;
                }

                const DNI = value.split('-');
                const number = Number(DNI[0]) % 23;
                const letter = lettersDNI.get(number);

                toggleInput(dniInput, letter === DNI[1]);

                return letter === DNI[1];
            } else {
                toggleInput(dniInput, isValid);

                return false;
            }
        }

        function validatePassword() {
            const value = passwordInput.val();
            const validLength = value.length >= 8;
            const haveUpperCase = /[A-Z]/.test(value);
            const haveNumbers = /\d/.test(value);
            const haveSymbols = /[@$!%*?&]/.test(value);

            const total = [validLength, haveUpperCase, haveNumbers, haveSymbols].filter(Boolean).length;

            $('#password_meter').find('div').removeClass('active').slice(0, total).addClass('active');

            return validLength && haveUpperCase && haveNumbers && haveSymbols;
        }

        function validatePasswordConfirm() {
            const currentPass = confirmPasswordInput.val();
            const pass = passwordInput.val();

            toggleInput(confirmPasswordInput, currentPass === pass && currentPass);

            return currentPass === pass && currentPass;
        }

        emailInput.on('input', function () {
            validateEmail();
        });

        dniInput.on('input', function () {
            validateDNI();
        });

        passwordInput.on('input', function () {
            validatePassword();
        });

        passwordInput.on('focus', function () {
            $('#password_meter, #password_meter_hint').fadeIn(250);
        });

        passwordInput.on('blur', function () {
            $('#password_meter, #password_meter_hint').fadeOut(250);
        });

        $('#password_visibility').on('click', function () {
            if ($(this).data('visibility') === true) {
                $(this).find('i').eq(0).removeClass('d-none');
                $(this).find('i').eq(1).addClass('d-none');
                $(this).data('visibility', false);

                passwordInput.attr('type', 'password');
            } else {
                $(this).find('i').eq(0).addClass('d-none');
                $(this).find('i').eq(1).removeClass('d-none');
                $(this).data('visibility', true);

                passwordInput.attr('type', 'text');
            }
        });

        confirmPasswordInput.on('input', function () {
            validatePasswordConfirm();
        });


        $('#sign_up_form').on('submit', function (event) {
            event.preventDefault();

            const name = nameInput.val();
            const surname = lastNameInput.val();

            if(name && surname && validateEmail() && validateDNI() && validatePassword() && validatePasswordConfirm()) {
                $('#rates_modal').modal('show');
            }else {
                Swal.fire({
                    title: "Error!",
                    text: "Rellene todos los campos antes de continuar.",
                    icon: "error",
                    confirmButtonText: "Aceptar"
                });
            }
        });

        async function encryptPassword(password) {
            try {
                // Genera un hash SHA-256 de la contraseña
                return CryptoJS.SHA256(password).toString();
            } catch (error) {
                throw error;
            }
        }

        ratesModalButton.on('click', function() {
            const name = nameInput.val();
            const surname = lastNameInput.val();
            const email = emailInput.val();
            const dni = dniInput.val();
            const password = passwordInput.val();
            const planID = $('input[name="plan"]:checked').val();

            encryptPassword(password).then(hash => {
                const formData = {
                    name: name,
                    surname: surname,
                    email: email,
                    dni: dni,
                    password: hash,
                    energy_plan: planID
                };

                // Realizar la solicitud POST
                $.post('/api/endpoint.php?controller=client', formData)
                    .done(function(response) {
                        let showError, text;
                        const responseData = JSON.parse(response);

                        if(responseData.success) {
                            Swal.fire({
                                title: "Registrado con Éxito!",
                                html: "Tu cuenta ha sido creada con éxito, tu usuario es: <strong>" + responseData.success + ".</strong><br> ¡Bienvenido a EcoSun Power! ¿Listo para comenzar tu viaje con nosotros?",
                                icon: "success",
                                confirmButtonText: "Aceptar"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location = '/sing-up.php';
                                }
                            });
                        }else if(responseData.warning) {
                            showError = true;
                            text = "Ya estás dado de alta, prueba a iniciar sesión en tu perfil.";
                        }else {
                            showError = true;
                            text = "Hubo un error al crear tu perfil, inténtelo de nuevo más tarde.";
                        }

                        if(showError) {
                            Swal.fire({
                                title: "Error!",
                                text: text,
                                icon: "error",
                                confirmButtonText: "Aceptar"
                            }) .then((result) => {
                                if (result.isConfirmed) {
                                    window.location = '/sing-up.php';
                                }
                            });
                        }
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        // Manejar errores de la solicitud
                        console.error('Error en la solicitud:', textStatus, errorThrown);
                    });
            })
        });
    });
</script>
