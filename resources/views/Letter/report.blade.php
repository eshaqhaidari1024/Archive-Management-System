<link rel="stylesheet" type="text/css" href="/css/jquery-ui.min.css">
<div class="row">
    <h4 style="text-align: center">
        {{isset($panel_title) ?$panel_title :''}}
    </h4>
    <form action="{{route('letter.get_report')}}" id="report">
        <div class="col d-flex col-md-12">

            <div class="col col-md-3">
                <div class="form-group">
                    <label for="letter_name">انتخاب مکتوب:*</label>
                    <select name="letter_name" id="letter_name" class="form-control">
                        <option value="all">همه مکاتیب</option>
                        <option value="صادره">صادره</option>
                        <option value="وارده">وارده</option>
                        <option value="پیشنهاد">پیشنهاد</option>
                        <option value="استعلام">استعلام</option>

                    </select>
                </div>


            </div>
            <div class="col col-md-3">
                <div class="form-group" id="choose">
                    <label for="type">نحوه گزارش:</label>
                    <select id="type" name="type" class="form-control">
                        <option value="type-1">نوع</option>
                        <option value="day">روز</option>
                        <option value="week">هفته</option>
                        <option value="month">ماه</option>
                        <option value="year">سال</option>
                        <option value="bt_date">بین تاریخ</option>
                    </select>
                </div>


            </div>
            <div class="col col-md-2">

                @include('letter.month')
                @include('letter.bettwen_date')
                @include('letter.year')




            </div>

            <div class="col col-md-2">
                <div class="form-group " id="between_date">
                    <label for="end_date" class="control-label ">تا تاریخ:</label>
                    <input type="text" value="{{ date('Y-m-d') }}" class="form-control year-start date-picker" placeholder="روز/ماه/سال" name="end_date"  id="end_date">


                </div>
            </div>
            <div class="col col-md-2 d-flex align-items-center">
                <button id="get-report" type="button" class="btn btn-info btn-rounded btn-sm"> گرفتن گزارش&nbsp;<i class="report_icon"></i></button>
            </div>

        </div>
    </form>

    <div class="col-md-12">
        <div class="col-md-2">
            <div class="form-group" >
                <select class="list-page form-control" >
                    <option>select count</option>
                    <option>5</option>
                    <option>10</option>
                    <option>20</option>
                    <option>50</option>
                </select>
            </div>

        </div>
        <div class="form-group col-md-1  text-left" >
            <button class="btn btn-primary form-control" onclick="imprimir()"><i class="fa fa-print"></i></button>
        </div>
    </div>
    <div class="col-md-12">


        <table id="example" class="table table-striped table-bordered display" style="width:100%">
            <thead>
            <tr>
            <th >شماره</th>
            <th >نام/ نام پدر</th>
            <th >نمبر آرشیف</th>
            <th >تاریخ راجستر</th>
            <th >نمبر مکتوب</th>
            <th >تاریخ مکتوب</th>
            <th >مضمون</th>


            </tr>
            </thead>
            <tfoot id="footer_table">


            </tfoot>
            <tbody id="table_report">


            </tbody>
        </table>
        <div class="pagination" style="float: left" id="pagination">

        </div>
    </div>
</div>
<script src="/js/jquery-ui.min.js"></script>
<script type="text/javascript">
  /*  var currDate = '';
    function initWork() {
        //Today

        // get today's date in Hijri
        currDate = HijriJS.today().toString();
        // to remove H from yearH ex: 1440H, drop the last character to be 1440
        currDate = currDate.substring(0, currDate.length - 1);
        // reformat date from dd/mm/yyyy to dd-mm-yyyy
        currDate = currDate.split('/').join('/');
        // set the date input field to currDate so, datepicker sets it as the current date automatically
        $('#year-start').val(currDate);
        $('#end_date').val(currDate);
        $('#start_date').val(currDate);

    }

    $( function() {
        $("#year-start").datepicker({
            changeMonth: true, // show months menu
            changeYear: true, // show years menu
            dayNamesMin: ["س", "ج", "خ", "ر", "ث", "ن", "ح"], // arabic days names
            dateFormat: "dd-mm-yy", // set format to dd-mm-yyyy
            monthNames: ["محرم", "صفر", "ربيع الأول", "ربيع الثاني", "جمادى الأول", "جمادى الثاني", "رجب", "شعبان", "رمضان", "شوال", "ذو القعدة", "ذو الحجة"],
            yearRange: "c-0:c+15", // year range in Hijri from current year and +15 years
            monthNamesShort: ["محرم", "صفر", "ربيع الأول", "ربيع الثاني", "جمادى الأول", "جمادى الثاني", "رجب", "شعبان", "رمضان", "شوال", "ذو القعدة", "ذو الحجة"],
            showAnim: 'fadeIn'
        });

        $("#end_date").datepicker({
            changeMonth: true, // show months menu
            changeYear: true, // show years menu
            dayNamesMin: ["س", "ج", "خ", "ر", "ث", "ن", "ح"], // arabic days names
            dateFormat: "dd-mm-yy", // set format to dd-mm-yyyy
            monthNames: ["محرم", "صفر", "ربيع الأول", "ربيع الثاني", "جمادى الأول", "جمادى الثاني", "رجب", "شعبان", "رمضان", "شوال", "ذو القعدة", "ذو الحجة"],
            yearRange: "c-0:c+15", // year range in Hijri from current year and +15 years
            monthNamesShort: ["محرم", "صفر", "ربيع الأول", "ربيع الثاني", "جمادى الأول", "جمادى الثاني", "رجب", "شعبان", "رمضان", "شوال", "ذو القعدة", "ذو الحجة"],
            showAnim: 'fadeIn'
        });
        $("#start_date").datepicker({
            changeMonth: true, // show months menu
            changeYear: true, // show years menu
            dayNamesMin: ["س", "ج", "خ", "ر", "ث", "ن", "ح"], // arabic days names
            dateFormat: "dd-mm-yy", // set format to dd-mm-yyyy
            monthNames: ["محرم", "صفر", "ربيع الأول", "ربيع الثاني", "جمادى الأول", "جمادى الثاني", "رجب", "شعبان", "رمضان", "شوال", "ذو القعدة", "ذو الحجة"],
            yearRange: "c-0:c+15", // year range in Hijri from current year and +15 years
            monthNamesShort: ["محرم", "صفر", "ربيع الأول", "ربيع الثاني", "جمادى الأول", "جمادى الثاني", "رجب", "شعبان", "رمضان", "شوال", "ذو القعدة", "ذو الحجة"],
            showAnim: 'fadeIn'
        });


    });*/



    $(document).ready(function () {

        // initWork();

        $('#get-report').on('click', function (e) {



            e.preventDefault();
            // initWork();
            var data = $("#report").serialize();
            var url = $("#report").attr('action');

            var html = '';
            var stock = $("#reason option:selected").text();

            var type = $("#type option:selected").text();

            if (type != "نوع") {

                if (type == "روز") {

                    html += getdate();
                }
                if (type == "هفته") {

                    html += getdate("week") + " " + getdate("month") + "/" + getdate("year");

                }
                if (type == "ماه") {

                    html += $("#month_r option:selected").text() + "/" + getdate("year");
                }
                if (type == "سال") {



                    html += $(".year-start").val();

                }
                if (type == "بین تاریخ") {

                    html += $(".year-end").val() + " تا " + $(".year-start").val();

                }
            }


            $(".report_icon").addClass('fa fa-spinner fa-spin');
            $('.loading').show();

            // var Post = $(this).attr('method');
            $.ajax({
                type: 'GET',
                url: url,
                data: data,
                dataType: 'json',
                success: function (response) {
                    // console.log(response['table_data'].data);
                    var data = response['table_data'].data;
                    var table = "";

                    if (data.length > 0)
                    {
                        for(var i = 0; i<data.length ; i++){
                            table += '<tr>'+
                                '<td>' +(i+1)+'</td>'+
                                '<td>'+(data[i].name!=null ? data[i].name : " ")+ ' ' +(data[i].last_name!=null ? data[i].last_name: " ") +'</td>'+
                                '<td>' +data[i].arch_no+ '</td>'+
                                '<td>' +data[i].arch_date_register+ '</td>'+
                                '<td>' +data[i].arch_letter_no+ '</td>'+
                                '<td>' +data[i].arch_date+ '</td>'+
                                '<td>' +data[i].arch_title+ '</td>'+
                                '</tr>';
                        }



                    } else {

                        table += '<tr><td colspan="5" class="text-center">اطلاعاتی برای نمایش وجود ندارد</td></tr>';

                    }
                    $(".report_icon").removeClass('fa fa-spinner fa-spin');
                    $('.loading').hide();

                    $('#table_report').html(table);
                    // $('#footer_table').html(tr);
                    $('#pagination').html(response['pagination']);
                    // table.column(4).visible(false);
                    $(".dt-button").addClass("btn");

                }
            });
        });

    });

    // Pagination
    $(document).on('click','.pagination a', function (event) {
        event.preventDefault();

        $('li').removeClass('active');
        $(this).parent('li').addClass('active');

        var url = $(this).attr("href");

        var data = $("#report").serialize();
        $('.loading').show();

        $.ajax({
            type: 'GET',
            url: url,
            data: data,
            dataType: 'json',
            success: function (response) {
                // console.log(response['table_data'].data);
                var data = response['table_data'].data;
                var table = "";

                for(var i = 0; i<data.length ; i++){
                    table += '<tr>'+
                    '<td>' +(i+1)+'</td>'+
                    '<td>'+(data[i].name!=null ? data[i].name : " ")+ ' ' +(data[i].last_name!=null ? data[i].last_name: " ") +'</td>'+
                    '<td>' +data[i].arch_no+ '</td>'+
                    '<td>' +data[i].arch_date_register+ '</td>'+
                    '<td>' +data[i].arch_letter_no+ '</td>'+
                    '<td>' +data[i].arch_date+ '</td>'+
                    '<td>' +data[i].arch_title+ '</td>'+
                    '</tr>';
                }
                $('.loading').hide();
                $('#table_report').html(table);

                var tr = '<tr>';
                tr += '<th colspan="2">مجموع محصولات ثبت شده</th>';
                tr += '<th colspan="3">' + response.sum + '</th>';
                tr += '</tr>';

                // $('#footer_table').html(tr);
                $('#pagination').html(response['pagination']);
                // table.column(4).visible(false);
                $(".dt-button").addClass("btn");

            }
        });
    })

    // Pagination According to Selecting Number
    $(".list-page").change(function () {
        var data = $("#report").serialize();
        var url = $("#report").attr('action');

        var html = '';

        var type = $("#type option:selected").text();

        if (type != "نوع") {

            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();


            if (type == "روز") {



                html +=    mm + '/' + dd + '/' + yyyy;

            }
            if (type == "هفته") {

                var curr = new Date; // get current date
                var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
                var last = first + 6; // last day is the first day + 6

                var firstday = new Date(curr.setDate(first));
                var lastday = new Date(curr.setDate(last));

                let  firstdaydate = [
                    firstday.getFullYear(),
                    ('0' + (firstday.getMonth() + 1)).slice(-2),
                    ('0' + firstday.getDate()).slice(-2)
                ].join('/');
                let lastdaydate = [
                    lastday.getFullYear(),
                    ('0' + (lastday.getMonth() + 1)).slice(-2),
                    ('0' + lastday.getDate()).slice(-2)
                ].join('/');

                html += firstdaydate+ ' - ' + lastdaydate;



            }
            if (type == "ماه") {

                html += $("#month_r option:selected").text() + "/" +  new Date().getFullYear();

            }
            if (type == "سال") {

                let txt = $(".year-start").val();

                console.log(txt);
                let currenyear = txt.split("-")[0];

                html += currenyear;


            }
            if (type == "بین تاریخ") {

                html += $(".year-start").val() + " تا " + $(".year-end").val();

            }

        }
        $('.loading').show();
        // var Post = $(this).attr('method');
        $.ajax({
            type: 'GET',
            url: url+"/"+$(this).val(),
            data: data,
            dataType: 'json',
            success: function (response) {
                // console.log(response['table_data'].data);
                var data = response['table_data'].data;
                var table = "";

                if (data.length > 0)
                {
                    for(var i = 0; i<data.length ; i++){
                        table += '<tr>'+
                        '<td>' +(i+1)+'</td>'+
                        '<td>'+(data[i].name!=null ? data[i].name : " ")+ ' ' +(data[i].last_name!=null ? data[i].last_name: " ") +'</td>'+
                        '<td>' +data[i].arch_no+ '</td>'+
                        '<td>' +data[i].arch_date_register+ '</td>'+
                        '<td>' +data[i].arch_letter_no+ '</td>'+
                        '<td>' +data[i].arch_date+ '</td>'+
                        '<td>' +data[i].arch_title+ '</td>'+
                            '</tr>';
                    }

                    var tr = '<tr>';
                    tr += '<th colspan="2">مجموع محصولات ثبت شده</th>';
                    tr += '<th colspan="3">' + response.sum + '</th>';
                    tr += '</tr>';
                } else {
                    table += '<tr><td colspan="5" class="text-center">اطلاعاتی برای نمایش وجود ندارد</td></tr>';
                }
                $('.loading').hide();

                $('#table_report').html(table);
                // $('#footer_table').html(tr);
                $('#pagination').html(response['pagination']);
                // table.column(4).visible(false);
                $(".dt-button").addClass("btn");

            }
        });

    })

    $(document).ready(function () {

       $(".date-picker").persianDatepicker({
            onRender: function () {
                $(".date-picker").val($(".today ").data("jdate"))
            }
        });

        $('#letter_name').select2();

    });
    /** customer report js**/
    $(function () {
        $('#as_date').hide();
        $('#year').hide();
        $('#month').hide();
        $('#between_date').hide();
        $('#type').change(function () {

            if ($('#type').val() == 'month') {
                $('#between_date').hide();
                $('#year').hide();
                $('#as_date').hide();
                $('#month').show();
            } else if ($('#type').val() == 'week') {
                $('#month').hide();
                $('#as_date').hide();
                $('#between_date').hide();
                $('#year').hide();

            } else if ($('#type').val() == 'day') {
                $('#month').hide();
                $('#as_date').hide();
                $('#between_date').hide();
                $('#year').hide();

            } else if ($('#type').val() == 'year') {
                $('#month').hide();
                $('#as_date').hide();
                $('#between_date').hide();
                $('#year').show();
            } else if ($('#type').val() == 'bt_date') {
                $('#month').hide();
                 $('#year').hide();

                $('#as_date').show();
                $('#between_date').show();
            } else {
                $('#selection').hide();
            }
        });
    });

</script>

<script type="text/javascript">

    function imprimir() {

        var stack = $("#stack_name option:selected").text();


        var type = $("#type option:selected").text();
        var html = '';
        if (type != "نوع") {

            if (type == "روز") {

                html += getdate();
            }
            if (type == "هفته") {

                html += getdate("week") + " " + getdate("month") + "/" + getdate("year");

            }
            if (type == "ماه") {

                html += $("#month_r option:selected").text() + "/" + getdate("year");
            }
            if (type == "سال") {

                html += $(".year-start").val();

            }
            if (type == "بین تاریخ") {

                html += $(".year-end").val() + " تا " + $(".year-start").val();

            }
        }


        var table = document.getElementById("example");
        var d = "<html><head>" +
            "<link rel='stylesheet' href='{{ asset("assets/plugin/bootstrap/css/bootstrap.min.css") }}' >" +
            "<style> th{text-align:right !important} body{font-family:sahle}</style>"+
            "</head><body style='direction: rtl;font-family:sahel'>"+
            "<h1 class='text-center'>گزارش مکتوب های   : "+stack+" </h1>"
            +
            "</h4></div><div class='col-md-2'><h4>تاریخ گزارش : "+type+"&nbsp;"+ html+"</h4></div></div>"

            + table.outerHTML + "</body></html>";


        newWin = window.open();
        newWin.document.write(d);
        newWin.setTimeout(function () {

            newWin.self.print();
            newWin.close();
        },3000)



    }
</script>
