<?php if(isset($show_header) && $show_header) { ?>
    </div>
    </div>
    <!--end::Post-->
    </div>
    <!--end::Content-->
    <!--begin::Footer-->
    <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
        <!--begin::Container-->
        <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
            <!--begin::Copyright-->
            <div id="footer_copy" class="text-dark order-2 order-md-1">
                <span class="text-muted fw-bold me-1">2024 ©</span>
                <a href="#" target="_blank" class="text-gray-800 text-hover-primary">EcoSun Power</a>
            </div>
            <!--end::Copyright-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Footer-->
    </div>
    <!--end::Wrapper-->
    </div>
    <!--end::Page-->
    </div>
    <!--end::Root-->
<?php } ?>

<!-- JQuery -->
<script src="assets/plugins/custom/jquery/jquery.min.js" type="text/javascript"></script>

<!-- Popper.js CDN -->
<script src="https://unpkg.com/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

<script src="assets/js/scripts.bundle.js"></script>
<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="assets/plugins/custom/fslightbox/fslightbox.bundle.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/crypto-js.min.js" integrity="sha512-a+SUDuwNzXDvz4XrIcXHuCf089/iJAoN4lmrXJg18XnduKK6YlDHNRalv4yd1N40OKI80tFidF+rqTFKGPoWFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- QR Generator -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- HTML to PDF -->
<script src="assets/plugins/custom/html2pdf/html2pdf.bundle.min.js"></script>

<!-- AmCharts -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<!-- APP MAIN Script -->
<script src="scripts/main.js" type="module" defer></script>

<script type="text/javascript">
    // Datatable Spanish
    const spanishDatatable = "<?= ASSETS_PATH ?>/plugins/custom/datatables/spanish.json";
</script>

<script>
    $(() => {
        // Enable all Tooltips
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    });

    $(function() {
        $('[data-toggle="m-tooltip"]').tooltip()
    });

    $(window).on('beforeunload', function() {
        $(window).scrollTop(0);
    });

    // Toastr
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toastr-bottom-full-width",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
</script>
<!-- END THEME LAYOUT SCRIPTS -->
</body>

</html>