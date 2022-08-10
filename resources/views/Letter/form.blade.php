

<h4 class="box-title">
    {{isset($panel_title) ?$panel_title :''}}
</h4>
<div class="col-md-6 col-md-offset-3">
    <form method="post" id="frm" action="{{isset($letter) ? route('letter.update',$letter->id) : route('letter.create')}}" enctype="multipart/form-data">
            {{ isset($letter) ? method_field('put') :''  }}
        {{csrf_field()}}
        <div class="form-group  required" id="form-arch-type-error">
            <label for="arch-type">نوع مکتوب:*</label>
            <select name="arch-type" id="arch-type" class="form-control required">
                <option value="" disabled selected>نوع مکتوب تان را انتخاب نمائید</option>
                <option value="صادره" {{isset($letter) &&$letter->arch_type=='صادره' ? 'selected':''}}>صادره</option>
                <option value="وارده" {{ isset($letter) && $letter->arch_type=='وارده' ? 'selected': ''}}>وارده</option>
                <option value="پیشنهاد" {{isset($letter) && $letter->arch_type=='پیشنهاد' ? 'selected' :'' }}>پیشنهاد</option>
                <option value="استعلام" {{isset($letter) && $letter->arch_type=='استعلام' ? 'selected':''}}>استعلام</option>
            </select>
            <span id="arch-type-error" class="help-block"></span>
        </div>

        <div class="form-group required " id="form-name-error">
            <label for="name">نام:</label>
            <input type="text" class="form-control required" id="name" name="name" value="{{old('name',isset($letter) ? $letter->name:'')}}">
            <span class="help-block" id="name-error"></span>
        </div>

        <div class="form-group required " id="form-last-name-error">
            <label for="last-name">نام پدر:</label>
            <input type="text" class="form-control required" id="last-name" name="last-name" value="{{old('last-name',isset($letter) ? $letter->last_name:'')}}">
            <span class="help-block" id="last-name-error"></span>
        </div>

        <div class="form-group  required" id="form-arch-date-error">
            <label for="arch-date">تاریخ:*</label>
            <input type="text" class="form-control required" id="arch-date" name="arch-date" value="{{old('arch-date',isset($letter) ? $letter->arch_date:'')}}" autocomplete="off">
            <span class="help-block" id="arch-date-error"></span>
        </div>
        <div class="form-group required " id="form-arch-date-register-error">
            <label for="arch-date-register">تاریخ راجستر:*</label>
            <input type="text" class="form-control required" id="arch-date-register" name="arch-date-register" value="{{old('arch-date-register',isset($letter) ? $letter->arch_date_register :'')}}" autocomplete="off">
            <span class="help-block" id="arch-date-register-error"></span>
        </div>
        <div class="form-group required " id="form-arch-no-error">
            <label for="arch-no">نمبر آرشیف:*</label>
            <input type="text" class="form-control required" id="arch-no" name="arch-no" value="{{old('arch-no',isset($letter) ? $letter->arch_no:'')}}">
            <span class="help-block" id="arch-no-error"></span>
        </div>
        <div class="form-group required " id="form-arch-letter-no-error">
            <label for="arch-letter-no">نمبر مکتوب:*</label>
            <input type="text" class="form-control required" id="arch-letter-no" name="arch-letter-no" value="{{old('arch-letter-no',isset($letter) ? $letter->arch_letter_no:'')}}">
            <span class="help-block" id="arch-letter-no-error"></span>
        </div>
        <div class="form-group required " id="form-arch-title">
            <label for="arch-title"> مضمون/عنوان:*</label>
            <input type="text" class="form-control required" id="arch-title" name="arch-title" value="{{old('arch-title' , isset($letter) ? $letter->arch_title:'')}}">
            <span class="help-block" id="arch-title-error"></span>
        </div>
                @if(isset($letter))
                   <div class="image-remove" id="image-remove-arch">
                       <img src="{{asset('storage/images/letter')}}/{{$letter->arch_photo}}" alt="">
                       <a href="#" class="btn btn-danger" id="arch-image-remove" data-image-name="{{$letter->id}}">حذف عکس</a>
                   </div>
            <div class="form-group required " id="form-arch-photo-error" style="display:none;">
                <label for="arch-photo">عکس:*</label>
                <input type="file" class="form-control required" id="arch-photo" name="arch-photo" value="">
                <span class="help-block" id="arch-photo-error"></span>
            </div>

                    @else
            <div class="form-group required " id="form-arch-photo-error" >
                <label for="arch-photo">عکس:*</label>
                <input type="file" class="form-control required" id="arch-photo" name="arch-photo" value="">
                <span class="help-block" id="arch-photo-error"></span>
            </div>

        @endif

        <div class="form-group required " id="form-arch-from-error">
            <label for="arch-from">مرسل:*</label>
            <input type="text" class="form-control required autocomplete_txt" data-field-name="dep_name" id="arch-from" autocomplete="off" name="arch-from" value="{{old('arch-from',isset($letter) ? $letter->arch_from:'')}}">
            <span class="help-block" id="arch-from-error"></span>
        </div>
        <div class="form-group required " id="form-arch-to-error">
            <label for="arch-to">مرسل علیه:*</label>
            <input type="text" class="form-control required autocomplete-text" data-field-name="dep_name" id="arch-to" name="arch-to" value="{{old('arch-to',isset($letter) ? $letter->arch_to:'')}}" autocomplete="off">
            <span class="help-block" id="arch-to-error"></span>
        </div>
        <div class="form-group required " id="form-arch-ejraat-error">
            <label for="arch-ejraat">اجراات:*</label>
            <input type="text" class="form-control required" id="arch-ejraat" name="arch-ejraat" value="{{old('arch-ejraat',isset($letter) ? $letter->arch_ejraat:'')}}">
            <span class="help-block" id="arch-ejraat-error"></span>
        </div>

         <div class="form-group d-flex">
             <label for="send-to-makhzan" class="form-check-inline " style="margin-left: 4px;"> ارسال به مخزن : </label>
             <input type="checkbox" id="send-to-makhzan" name="send-to-makhzan" class="form-check  " {{(isset($letter) && $letter->arch_makhzan==1 )? 'checked':''}}>
         </div>
        <div class="form-group ">
            <button type="submit" id="btn_save" class="btn btn-primary">ثبت اطلاعات</button>
            <a href="javascript:ajaxLoad('{{route('letter.list')}}')" class="btn btn-danger">لغو</a>
        </div>
    </form>
</div>

<script type="text/javascript">



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
        $('#arch-date').val(currDate);
        $('#arch-date-register').val(currDate);
    }

    $( function() {
        $( "#arch-date" ).datepicker({
            changeMonth: true, // show months menu
            changeYear: true, // show years menu
            dayNamesMin: [ "س", "ج", "خ", "ر", "ث", "ن", "ح" ], // arabic days names
            dateFormat: "dd-mm-yy", // set format to dd-mm-yyyy
            monthNames: [ "محرم", "صفر", "ربيع الأول", "ربيع الثاني", "جمادى الأول", "جمادى الثاني", "رجب", "شعبان", "رمضان", "شوال", "ذو القعدة", "ذو الحجة" ],
            yearRange: "c-0:c+15", // year range in Hijri from current year and +15 years
            monthNamesShort: [ "محرم", "صفر", "ربيع الأول", "ربيع الثاني", "جمادى الأول", "جمادى الثاني", "رجب", "شعبان", "رمضان", "شوال", "ذو القعدة", "ذو الحجة" ],
            showAnim: 'fadeIn'
        });

        $( "#arch-date-register" ).datepicker({
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
        // kamaDatepicker('arch-date',{ markToday: true});
        // kamaDatepicker('arch-date-register',{ markToday: true});
        $('#arch-type').select2();



        function handleAutocomplete() {
            var fieldNam, currentEle;
            currentEle = $(this);
            fieldNam = currentEle.data('field-name');
            console.log(fieldNam);
            if (typeof fieldNam == 'undefined') {
                return false;
            }
            currentEle.autocomplete({
                /* autofocus:true,
                 minLength:0,*/

                classes: {

                    "ui-autocomplete": "load",

                },

                source: function (data, cb) {


                    $.ajax({
                        url: '{{route('letter.data')}}',
                        method: 'GET',
                        dataType: 'json',

                        cache: false,
                        async: true,
                        data: {
                            name: data.term,
                            fieldName: fieldNam,


                        },
                        success: function (res) {


                            var result;

                            result = [
                                {
                                    label: 'بخش مورد نظر پیدا نشد' +  data.term,
                                    value: ''
                                }
                            ];

                            if (res.length) {
                                result = $.map(res, function (obj) {

                                    return {
                                        label: obj[fieldNam],
                                        value: obj[fieldNam],
                                        data: obj
                                    };
                                });
                            }


                            cb(result);

                        },
                        error: function (data) {
                            console.log(data);


                        }
                    });
                },


                select: function (event, ui) {


                    $('#arch-from').val(ui.item.value);






                }
            });

        }
        function handleAutocompletetwo() {
            var fieldNam, currentEle;
            currentEle = $(this);
            fieldNam = currentEle.data('field-name');
            console.log(fieldNam);
            if (typeof fieldNam == 'undefined') {
                return false;
            }
            currentEle.autocomplete({
                /* autofocus:true,
                 minLength:0,*/

                classes: {

                    "ui-autocomplete": "load",

                },

                source: function (data, cb) {


                    $.ajax({
                        url: '{{route('letter.data')}}',
                        method: 'GET',
                        dataType: 'json',

                        cache: false,
                        async: true,
                        data: {
                            name: data.term,
                            fieldName: fieldNam,


                        },
                        success: function (res) {


                            var result;

                            result = [
                                {
                                    label: 'بخش مورد نظر پیدا نشد ' +  data.term,
                                    value: ''
                                }
                            ];

                            if (res.length) {
                                result = $.map(res, function (obj) {

                                    return {
                                        label: obj[fieldNam],
                                        value: obj[fieldNam],
                                        data: obj
                                    };
                                });
                            }


                            cb(result);

                        },
                        error: function (data) {
                            console.log(data);


                        }
                    });
                },


                select: function (event, ui) {


                    $('#arch-to').val(ui.item.value);






                }
            });

        }


        function registerEvent() {


            $(document).on('focus', '.autocomplete_txt', handleAutocomplete);
            $(document).on('focus', '.autocomplete-text', handleAutocompletetwo);
            $(document).on('click', '#arch-image-remove', removeImage);


        }
        registerEvent();
    })
    function removeImage() {

        var imagename=$(this).data('image-name');
        console.log(imagename);

        $.ajax({
            method:'post',
            url:'/public/letter/removeImage',
            data:{
                id:imagename,
                _token:'{{csrf_token()}}',
            },

            success:function (res) {

                if(res.deleted==true){
                    $('#image-remove-arch').css('display','none');
                    $('#form-arch-photo-error').css('display','block');




                }else if(res.file_null==true){
                    $('#image-remove-arch').css('display','none');
                    $('#form-arch-photo-error').css('display','block');

                }
            },
            error:function (res) {

            }

        });
    }




</script>
