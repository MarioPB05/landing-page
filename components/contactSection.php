<section id="contactSection" class="w-100 d-flex flex-column flex-xl-row align-items-center mt-100">

    <div class="p-8 p-md-0 w-100 w-md-50 d-flex flex-column justify-content-center align-items-center">
        <h1 class="fs-3x mb-12">Contáctanos</h1>
        <p class="text-center mw-md-400px">¿Tienes preguntas, comentarios o estás listo para dar el paso hacia la energía renovable? Estamos aquí para ayudarte. En EcoSun Power, valoramos la comunicación directa con nuestros clientes.</p>

        <div class="d-flex gap-3 mb-10 mb-xl-0">
            <a href="https://www.instagram.com/ecosunpower/" target="_blank" class="text-hover-success">
                <i class="bi bi-instagram fs-2"></i>
            </a>

            <a href="https://www.facebook.com/ecosunpower/" target="_blank" class="text-hover-success">
                <i class="bi bi-facebook fs-2"></i>
            </a>

            <a href="https://wa.me/1234567890" target="_blank" class="text-hover-success">
                <i class="bi bi-whatsapp fs-2"></i>
            </a>

            <a href="mailto:clients@ecosunpower.es" target="_blank" class="text-hover-success">
                <i class="bi bi-envelope fs-2"></i>
            </a>
        </div>
    </div>

    <form id="contact_form" class="w-100 w-sm-400px w-lg-50 m-8 m-md-0 p-8 d-flex flex-column justify-content-center align-items-center rounded-4 border border-2 border-success">
        <!--begin::Input group-->
        <div class="form-floating mb-7 w-100 mw-400px">
            <input type="email" class="form-control" id="email" placeholder="client@ecosunpower.es"/>
            <label for="email">Correo electrónico</label>
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="form-floating mb-7 w-100 mw-400px">
            <input type="text" class="form-control" id="subject" placeholder=""/>
            <label for="subject">Asunto</label>
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="form-floating w-100 mw-400px">
            <textarea class="form-control h-200px" placeholder="Escribe lo que necesitas!" id="text"></textarea>
            <label for="text">Mensaje</label>
        </div>
        <!--end::Input group-->

        <!--begin::Actions-->
        <div class="d-flex flex-center flex-row-fluid pt-12">
            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Borrar</button>
            <button type="submit" class="btn btn-success">Enviar Mensaje</button>
        </div>
        <!--end::Actions-->
    </form>
</section>