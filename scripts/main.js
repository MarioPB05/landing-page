function loadEvents() {
    $('.price-card a').on('click', function() {
        if($(this).data('display')  === false) {
            $(this).removeClass().addClass('btn btn-success mb-10');
            $(this).text('Contratar Tarifa');
            $(this).data('display', true);
            $(this).parent().find('div').show();
        }else {
            const target = $(this).data('target');

            $(target).trigger('click');
            $(target).find('input').prop('checked', true);

            $('#rates_modal').modal('toggle');

            $(this).removeClass().addClass('btn btn-outline btn-outline-success btn-active-light-success mb-10');
            $(this).text('Mostrar Detalles');
            $(this).data('display', false);
            $(this).parent().find('div').hide();
        }

        // Animar el desplazamiento cuando se hace clic en el elemento
        $('html, body').animate({
            scrollTop: $(this).parent().find('p').first().offset().top + -100
        }, 800);

        $(this).trigger('blur');
    });

    $('.nav-link').on('click', function() {
       if($(this).data('bs-toggle') === 'tab') {
           $(this).find('input').prop('checked', true);
       }
    });

    $('.scroll-btn').on('click', function (e) {
        e.preventDefault();

        $('html, body').animate({
            scrollTop: $($(this).data('target')).offset().top + -100
        }, 800);
    });

    $('#contact_form').on('submit', function(e) {
        e.preventDefault();

        const email = $('#email').val();
        const subject = $('#subject').val();
        const text = $('#text').val();

        if(!email || !subject || !text) {
            Swal.fire({
                title: "Error!",
                text: "Rellene todos los campos antes de enviar el formulario.",
                icon: "error",
                confirmButtonText: "Aceptar"
            });
        }else {
            Swal.fire({
                title: "Mensaje enviado!",
                text: "Tu mensaje se ha enviado correctamente, en 24 horas uno de nuestros agentes se pondrá en contacto con usted.",
                icon: "success",
                confirmButtonText: "Aceptar"
            });
        }
    });
}


$(function () {
    $('body').css("overflow-y", "auto");
    $('#loading_indicator').removeClass("d-flex");

    $('.price-card-details').each(function(){
        $(this).hide();
    });

    loadEvents();
});