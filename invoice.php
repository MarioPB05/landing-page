<?php
session_start();

if (empty($_SESSION['connected'])) {
    header("Location: /");
}

if(isset($_GET['date'])) {
    $timestamp_segundos = $_GET['date'] / 1000;
    $date = date_create("@$timestamp_segundos");
} else {
    header("Location: /dashboard.php");
}

$show_header = false;
include_once 'header.php';

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

$indice_mes = intval(date_format($date, 'm'));

if($indice_mes >= 1 && $indice_mes <= 3) {
    $background_url = "images/winter.jpg";
}else if($indice_mes >= 4 && $indice_mes <= 6) {
    $background_url = "images/spring.jpg";
}else if($indice_mes >= 7 && $indice_mes <= 9) {
    $background_url = "images/summer.jpg";
}else {
    $background_url = "images/autumn.jpg";
}
?>

<!-- begin::Invoice 1-->
<div class="card">
    <!-- begin::Body-->
    <div class="card-body py-20">
        <div id="print">
            <!-- begin::Wrapper-->
            <div class="mw-lg-950px mx-auto w-100">
                <!-- begin::Header-->
                <div id="invoice_header" class="d-flex justify-content-between flex-column flex-sm-row mb-19">
                    <h4 class="fw-boldest text-gray-800 fs-2qx pe-5 pb-7">FACTURA <?= strtoupper($meses[$indice_mes]) ?></h4>
                    <!--end::Logo-->
                    <div class="text-sm-end">
                        <!--begin::Logo-->
                        <a href="#">
                            <img alt="Logo" src="images/logo.svg" height="45"/>
                        </a>
                        <!--end::Logo-->
                        <!--begin::Text-->
                        <div class="text-sm-end fw-bold fs-4 text-muted mt-7">
                            <div>C. Calatrava, 38, Casco Antiguo 41002</div>
                            <div>Sevilla, España</div>
                        </div>
                        <!--end::Text-->
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="border-bottom pb-12">
                    <!--begin::Image -->
                    <div id="banner"
                         class="d-flex flex-row-fluid bgi-no-repeat bgi-position-x-center bgi-size-cover card-rounded h-150px h-lg-250px mb-lg-20"
                         style="background-image: url(<?= $background_url ?>);background-position: center center"></div>
                    <!--end::Image-->
                    <!--begin::Wrapper-->
                    <div class="d-flex justify-content-between flex-column flex-md-row">
                        <!--begin::Content-->
                        <div class="flex-grow-1 pt-8 mb-13">
                            <!--begin::Table-->
                            <div class="table-responsive border-bottom mb-14">
                                <?php
                                // Generar datos
                                $horas_valle = rand(150, 300);
                                $horas_llano = rand(30, 80);
                                $horas_punta = rand(10, 30);

                                $precio_valle = number_format($horas_valle * 0.094, 2);
                                $precio_llano = number_format($horas_llano * 0.188, 2);
                                $precio_punta = number_format($horas_punta * 0.277, 2);

                                $total = number_format($precio_valle + $precio_llano + $precio_punta, 2);
                                $impuesto_electricidad = number_format($total * 0.05113, 2);
                                $iva = number_format($total * 0.21, 2);
                                $total_con_impuestos = number_format($total + $impuesto_electricidad + $iva, 2);
                                ?>

                                <table class="table">
                                    <thead>
                                    <tr class="border-bottom fs-6 fw-bolder text-muted text-uppercase">
                                        <th class="min-w-175px pb-9">Descripción</th>
                                        <th class="min-w-70px pb-9 text-end">Horas</th>
                                        <th class="min-w-80px pb-9 text-end">Tarifa (€/kWh)</th>
                                        <th class="min-w-100px pe-lg-6 pb-9 text-end">Importe (€)</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr class="fw-bolder text-gray-700 fs-5 text-end">
                                        <td class="d-flex align-items-center pt-11">
                                            <i class="bi bi-circle-fill text-success me-2"></i>Horario Valle
                                        </td>
                                        <td class="pt-11"><?= $horas_valle ?></td>
                                        <td class="pt-11">0.094</td>
                                        <td class="pt-11 fs-5 pe-lg-6 text-dark fw-boldest"><?= $precio_valle ?></td>
                                    </tr>

                                    <tr class="fw-bolder text-gray-700 fs-5 text-end">
                                        <td class="d-flex align-items-center">
                                            <i class="bi bi-circle-fill text-warning me-2"></i>Horario Llano
                                        </td>
                                        <td><?= $horas_llano ?></td>
                                        <td>0.188</td>
                                        <td class="fs-5 text-dark fw-boldest pe-lg-6"><?= $precio_llano ?></td>
                                    </tr>

                                    <tr class="fw-bolder text-gray-700 fs-5 text-end">
                                        <td class="d-flex align-items-center">
                                            <i class="bi bi-circle-fill text-primary me-2"></i>Horario Punta
                                        </td>
                                        <td><?= $horas_punta ?></td>
                                        <td>0.277</td>
                                        <td class="fs-5 text-dark fw-boldest pe-lg-6"><?= $precio_punta ?></td>
                                    </tr>

                                    <tr class="fw-bolder text-gray-700 fs-5 text-end">
                                        <td class="d-flex align-items-center">
                                            <i class="bi bi-tag-fill text-info me-2"></i>I.V.A
                                        </td>
                                        <td>-</td>
                                        <td>21%</td>
                                        <td class="fs-5 text-dark fw-boldest pe-lg-6"><?= $iva ?></td>
                                    </tr>

                                    <tr class="fw-bolder text-gray-700 fs-5 text-end">
                                        <td class="d-flex align-items-center pb-10">
                                            <i class="bi bi-tag-fill text-info me-2"></i>I.E
                                        </td>
                                        <td>-</td>
                                        <td>0.0511</td>
                                        <td class="fs-5 text-dark fw-boldest pe-lg-6"><?= $impuesto_electricidad ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--end::Table-->

                            <!--begin::Section-->
                            <div class="d-flex w-100 justify-content-between">
                                <div class="d-flex flex-column mw-md-300px w-100">
                                    <!--begin::Label-->
                                    <div class="fw-bold fs-5 mb-3 text-dark00">TRANSFERENCIA BANCARIA</div>
                                    <!--end::Label-->

                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack text-gray-800 mb-3 fs-6">
                                        <!--begin::Accountname-->
                                        <div class="fw-bold pe-5">Banco:</div>
                                        <!--end::Accountname-->
                                        <!--begin::Label-->
                                        <div class="text-end fw-norma">Santander</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Item-->

                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack text-gray-800 mb-3 fs-6">
                                        <!--begin::Accountnumber-->
                                        <div class="fw-bold pe-5">Número de Cuenta:</div>
                                        <!--end::Accountnumber-->
                                        <!--begin::Number-->
                                        <div class="text-end fw-norma">1234567890934</div>
                                        <!--end::Number-->
                                    </div>
                                    <!--end::Item-->

                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack text-gray-800 fs-6">
                                        <!--begin::Code-->
                                        <div class="fw-bold pe-5">Código:</div>
                                        <!--end::Code-->
                                        <!--begin::Label-->
                                        <div class="text-end fw-norma">BARC0032UK</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Item-->
                                </div>

                                <div class="d-none d-md-inline">
                                    <div id="qr_payment"></div>
                                    <span class="text-muted">CARTA DE PAGO</span>
                                </div>
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Content-->
                        <!--begin::Separator-->
                        <div class="border-end d-none d-md-block mh-450px mx-9"></div>
                        <!--end::Separator-->
                        <!--begin::Content-->
                        <div class="text-end pt-10">
                            <!--begin::Total Amount-->
                            <div class="fs-3 fw-bolder text-muted mb-3">IMPORTE TOTAL</div>
                            <div class="fs-xl-2x fs-2 fw-boldest"><?= $total_con_impuestos ?> €</div>
                            <div class="text-muted fw-bold">Impuestos incluidos</div>
                            <!--end::Total Amount-->
                            <div class="border-bottom w-100 my-7 my-lg-16"></div>
                            <!--begin::Invoice To-->
                            <div class="text-gray-600 fs-6 fw-bold mb-3">CLIENTE</div>
                            <div class="fs-6 text-gray-800 fw-bold mb-8">Mario Perdiguero.
                                <br/>Olivares Sevilla 20620
                            </div>
                            <!--end::Invoice To-->
                            <!--begin::Invoice No-->
                            <div class="text-gray-600 fs-6 fw-bold mb-3">Nº FACTURA.</div>
                            <div class="fs-6 text-gray-800 fw-bold mb-8">56758</div>
                            <!--end::Invoice No-->
                            <!--begin::Invoice Date-->
                            <div class="text-gray-600 fs-6 fw-bold mb-3">FECHA</div>
                            <div class="fs-6 text-gray-800 fw-bold"><?= date_format($date, "d M, Y") ?></div>
                            <!--end::Invoice Date-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Body-->
                <!-- begin::Footer-->
                <div id="invoice_footer" class="d-flex flex-stack flex-wrap mt-lg-20 pt-13">
                    <!-- begin::Actions-->
                    <div class="my-1 me-5">
                        <!-- begin::Pint-->
                        <button type="button" id="generate-pdf" class="btn btn-success my-1 me-12">Imprimir Factura
                        </button>
                        <!-- end::Pint-->
                    </div>
                    <!-- end::Actions-->
                </div>
                <!-- end::Footer-->
            </div>
            <!-- end::Wrapper-->
        </div>
    </div>
    <!-- end::Body-->
</div>
<!-- end::Invoice 1-->

<?php include_once 'footer.php'; ?>

<script>
    $(function () {
        const qrcode = new QRCode("qr_payment", {
            text: "https://google.es",
            width: 110,
            height: 110,
            title: "QR de Pago",
            correctLevel : QRCode.CorrectLevel.H
        });
    });

    $('#generate-pdf').on('click', function () {
        const opt = {
            margin: [0.5, 0.1, 0, 0.1],
            filename: 'Factura de Enero.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'in',
                format: 'letter',
                orientation: 'landscape',
                // orientation: 'portrait',
            },
            pagebreak: {
                mode: 'avoid-all'
            }
        };
        const element = $('#print')[0]; // Puedes seleccionar cualquier elemento del DOM que desees incluir en el PDF
        const originalStyles = element.getAttribute('style');

        element.style.margin = '0';
        element.style.padding = '0';

        $(this).hide();
        $('#banner, #invoice_footer').removeClass('d-flex').addClass('d-none');
        $('#invoice_header').removeClass('mb-19');
        $('.bi').hide();

        html2pdf().set(opt).from(element).outputPdf().get('pdf').then((pdfObj) => {
            pdfObj.autoPrint();
            window.open(pdfObj.output("bloburl"), "F");

            $(this).show();
            element.setAttribute('style', originalStyles);
            $('#banner, #invoice_footer').addClass('d-flex').removeClass('d-none');
            $('#invoice_header').addClass('mb-19');
            $('.bi').show();

            $('html, body').animate({scrollTop: 0}, 'slow');
        });
    });
</script>
