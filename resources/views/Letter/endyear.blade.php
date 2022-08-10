<div class="col col-md-2">
    <div class="form-group " id="between_date">
        <label for="end_date" class="control-label ">تاریخ:*</label>
        <input type="text" value="" class="form-control end-year date-picker" placeholder="روز/ماه/سال"
               name="end_date" id="end_date">

    </div>
</div>

<script>

    var currDate = '';
    function initWork() {
        //Today

        // get today's date in Hijri
        currDate = HijriJS.today().toString();
        // to remove H from yearH ex: 1440H, drop the last character to be 1440
        currDate = currDate.substring(0, currDate.length - 1);
        // reformat date from dd/mm/yyyy to dd-mm-yyyy
        currDate = currDate.split('/').join('-');
        // set the date input field to currDate so, datepicker sets it as the current date automatically

        $('#end_date').val(currDate);
    }

    $( function() {


        $( "#end_date" ).datepicker({
            changeMonth: true, // show months menu
            changeYear: true, // show years menu
            dayNamesMin: [ "س", "ج", "خ", "ر", "ث", "ن", "ح" ], // arabic days names
            dateFormat: "dd-mm-yy", // set format to dd-mm-yyyy
            monthNames: [ "محرم", "صفر", "ربيع الأول", "ربيع الثاني", "جمادى الأول", "جمادى الثاني", "رجب", "شعبان", "رمضان", "شوال", "ذو القعدة", "ذو الحجة" ],
            yearRange: "c-0:c+15", // year range in Hijri from current year and +15 years
            monthNamesShort: [ "محرم", "صفر", "ربيع الأول", "ربيع الثاني", "جمادى الأول", "جمادى الثاني", "رجب", "شعبان", "رمضان", "شوال", "ذو القعدة", "ذو الحجة" ],
            showAnim: 'fadeIn'
        });
    });
    $(document).ready(function () {
        initWork();
    })
</script>
