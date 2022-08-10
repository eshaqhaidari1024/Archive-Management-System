{{--<footer class="footer">--}}
{{--    <ul class="list-inline">--}}
{{--        <li>2019 © Tutia Technology Co.LTD.</li>--}}
{{--        <li><a href="https://tutiatech.com">www.tutiatech.com</a></li>--}}
{{--        <li><a href="">info@tutiatech.com</a></li>--}}
{{--        <li><a href="https://facebook.com">www.facebook.com/Tutia_Tech</a></li>--}}
{{--    </ul>--}}
{{--</footer>--}}
</div>
<!-- /.main-content -->
</div><!--/#wrapper -->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="{{asset('assets/script/html5shiv.min.js')}}"></script>
<script src="{{asset('assets/script/respond.min.js')}}"></script>
<![endif]-->
<!--
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{asset('assets/scripts/jquery.min.js')}}"></script>

<script src="{{asset('assets/scripts/modernizr.min.js')}}"></script>
<script src="{{asset('assets/plugin/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/scripts/bootstrap-switch.min.js')}}"></script>
<script src="{{asset('assets/scripts/bootstrap-toggle.min.js')}}"></script>

<script src="{{asset('assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>

<script src="{{asset('assets/plugin/nprogress/nprogress.js')}}"></script>
<script src="{{asset('assets/plugin/sweet-alert/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/plugin/waves/waves.min.js')}}"></script>
<!--Bootstrap Date Picker -->
<script src="{{asset('assets/plugin/datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('assets/plugin/timepicker/js/bootstrap-timepicker.min.js')}}"></script>
<!--Jalali-->
<script src="{{asset('assets/plugin/jalali/kamadatepicker.js')}}"></script>

<!-- Dropify -->
<script src="{{asset('assets/plugin/dropify/js/dropify.min.js')}}"></script>
<script src="{{asset('assets/scripts/fileUpload.demo.min.js')}}"></script>

<!-- FullCalendar -->
<script src="{{asset('assets/plugin/moment/moment.js')}}"></script>
<script src="{{asset('assets/plugin/fullcalendar/fullcalendar.min.js')}}"></script>
<script src="{{asset('assets/scripts/fullcalendar.init.js')}}"></script>

<!-- select2 -->
<script src="{{asset('assets/plugin/select2/js/select2.min.js')}}"></script>
<script src="{{asset('assets/plugin/persianDatepicker/js/persianDatepicker.min.js')}}"></script>

<!-- Data Tables -->
{{--<script src="{{asset('assets/plugin/datatables/media/js/jquery-3.3.1.js')}}"></script>--}}
<script src="{{asset('assets/plugin/datatables/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugin/datatables/media/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('assets/plugin/datatables/media/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugin/datatables/media/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/plugin/datatables/media/js/jszip.min.js')}}"></script>
<script src="{{asset('assets/plugin/datatables/media/js/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/plugin/datatables/media/js/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/plugin/datatables/media/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugin/datatables/media/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/plugin/datatables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugin/datatables/extensions/Responsive/js/responsive.bootstrap.min.js')}}"></script>
<script src="{{asset('assets/scripts/datatables.demo.min.js')}}"></script>
<script src="{{asset('assets/scripts/main.min.js')}}"></script>
<!--Demo Script-->
<script src="{{asset('assets/scripts/form.demo.min.js')}}"></script>
{{--autocomplete js plugin--}}
{{--<script src="{{asset('assets/plugin/autocomplete/jquery-ui.min.js')}}"></script>--}}
<script src="{{asset('assets/plugin/jquery-ui-1.12.1/jquery-ui.min.js')}}"></script>
{{--Route I--}}
<script src="{{asset('assets/scripts/routie.min.js')}}"></script>
{{--Gritter--}}
<link rel="stylesheet" href="{{asset('assets/plugin/gritter/jquery.gritter.min.js')}}">

<link rel="stylesheet" href="{{ asset("assets/toastr.min.css") }}">
<link rel="stylesheet" href="{{ asset("assets/toastr.css") }}">
<script src="{{ asset("assets/toastr.min.js") }}"></script>

<!-- Qamari Taqwim -->

<script src="{{asset('assets/datepickercc/Hijri.js')}}"></script>

{{--form-wizard--}}
<script src="{{asset('assets/plugin/form-wizard/prettify.js')}}"></script>
<script src="{{asset('assets/plugin/form-wizard/jquery.bootstrap.wizard.min.js')}}"></script>
<script src="{{asset('assets/scripts/form.wizard.init.min.js')}}"></script>
<script src="{{asset('assets/scripts/script.js')}}"></script>
<script src="{{asset('assets/scripts/custom.js')}}"></script>

@yield('js');
</body>
<script>
    $(document).ready(function () {
        $('#agency_id').change(function() {
            var agency_id = $("#agency_id option:selected").val();

            $('.loading').show();
            $.ajax({
                type: "GET",
                url: 'user/changeBranches',
                data: {'agency_id': agency_id},
                success: function(data){
                    console.log(data.success)
                    $('.loading').hide();
                }

            });
        })


    })
</script>
<!-- Mirrored from demo.ninjateam.org/html/my-admin/rtl/light/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 04 Jan 2018 15:06:55 GMT -->
</html>
