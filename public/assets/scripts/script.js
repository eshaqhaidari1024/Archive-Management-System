



function  addTOdatabase(url,data,method){


    return $.ajax({
        type: method,
        url: url,
        data: data,

    });

}
function readURL1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah1')
                .attr('src', e.target.result)
                .width(200)
                .height(200);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function readURL2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah2')
                .attr('src', e.target.result)
                .width(200)
                .height(200);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function ajaxLoad(filename, content) {
    content = typeof content !== 'undefined' ? content : 'content';
    $('.loading').show();
    $.ajax({
        type: "GET",
        url: filename,
        contentType: false,
        success: function (data) {
            $("#" + content).html(data);
            $('.loading').hide();
        },
        error: function (xhr, status, error) {




            if (error === 'Unauthorized'){
                alert("برنامه قفل شده دوباره وارد شوید!");
                location.assign("login");
            }
        }
    });
}

function ajaxDelete(filename, token, content) {
    content = typeof content !== 'undefined' ? content : 'content';
    $('.loading').show();
    $.ajax({
        type: 'POST',
        data: {_method: 'DELETE', _token: token},
        url: filename,
        success: function (data) {
            $("#" + content).html(data);
            $('.loading').hide();
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
}

/*$(document).on('click', '.pagination a', function (event) {
    event.preventDefault();
    ajaxLoad($(this).attr('href'));
});*/

routie('*', function () {
    // var url = window.location.href;
    // var p = url.indexOf('#');
    // if (p > -1) {
    //     var controllerAction = url.substr(url.indexOf('#') + 1);
    //     var pos = controllerAction.indexOf('*');
    //     var menu = controllerAction;
    //     if (pos > -1)
    //         menu = controllerAction.substr(0, pos);
    //     activeMenu("nav_" + menu.replace('/', '_'));
    //     $('body,html').animate({
    //         scrollTop: 0
    //     }, 800);
    //     ajaxLoad(controllerAction.replace('*', '/'));
    // } else {
        activeMenu("nav_home");
        ajaxLoad('home');
    // }
});

function activeMenu(nav) {
    $('.nav li.active').removeClass('active');
    $(".nav ." + nav).addClass('active');
}

var arabics = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
var engs = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];


$(document).on('keyup', 'input[type=text]', function (e) {

    var insideText = (e.key);
    var index = arabics.indexOf(insideText);
    if (index >= 0) {
        var value = $(this).val();
        value.substr(0, value.length - 1) != null ? value = value.substr(0, value.length - 1) + engs[index] : value = engs[index];
        $(this).val(value);
    }


});

function setEnabled($a, Enabled ){
    $a.each(function(i, a){
        var en = a.onchange !== null;
        if(en == Enabled)return;
        if(Enabled){
            a.onclick = $(a).data('orgChange');
        }
        else
        {
            $(a).data('orgChange',a.onchange);
            a.onclick = null;
        }
    });
}


$(document).on('submit', 'form#frm', function (event) {



    if (!confirm("ایا مطمین  هستین برای ثبت؟")){
        return false ;
    }else{

        $(".btn_save").attr('disabled', 'disabled').html("<i class='glyphicon glyphicon-floppy-disk'></i> ذخیره کردن...");
        event.preventDefault();
        $("#frm input").css("pointer-events", "none");
        var form = $(this);
        var data = new FormData($(this)[0]);
        var url = form.attr("action");
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                

               
                if (data.fail ) {

                       
                    $('#frm input.required, #frm textarea.required').each(function () {
                        index = $(this).attr('name');
                        if (index in data.errors) {
                            $("#form-" + index + "-error").addClass("has-error");
                            $("#" + index + "-error").html(data.errors[index]);
                        }
                        else {
                            $("#form-" + index + "-error").removeClass("has-error");
                            $("#" + index + "-error").empty();
                        }
                    });
                    $('#focus').focus().select();


                    toastr["error"](objToString(data.errors))
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-center",
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
                    }


                }else if(data.exist){

                    alert('این نام قبلا در دیتابیس ثبت است لطفایک نام دیگری را ثب کنید!');
                    
                }
                else {
                    $(".has-error").removeClass("has-error");
                    $(".help-block").empty();


                    if (!data.url) {

                        $('#myModal').modal('hide');
                        var url = window.location.href;
                        var controllerAction = url.substr(url.indexOf('#') + 1).replace('*', '/');
                        ajaxLoad(controllerAction);


                    }
                    else {

                        ajaxLoad(data.url, data.content);
                        if (data.print) {

                            window.open(data.url_print, "_blank");
                            win.focus();
                        }


                        toastr["success"]("  انجام شد  ")
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-center",
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
                        }
                    }

                }
                $("#btn_save").removeAttr('disabled').html("<i class='glyphicon glyphicon-floppy-disk'></i> Save");
                $("#frm input").css("pointer-events", "");
                $(".btn_save").removeAttr('disabled').html("<i class='glyphicon glyphicon-floppy-disk'></i> Save");
               },
            error: function (xhr, textStatus, errorThrown) {
                alert(errorThrown);
                $(".btn_save").removeAttr('disabled').html("<i class='glyphicon glyphicon-floppy-disk'></i> Save");
                $("#frm input").css("pointer-events", "");
            }
        });
        return false;
    }
});
$("#msg").delay(5000).fadeOut();


function getdate(type = "full") {


    week = ["يكشنبه", "دوشنبه", "سه شنبه", "چهارشنبه", "پنج شنبه", "جمعه", "شنبه"];
    months = ["حوت", "دلو", "جدی", "قوس", "عقرب", "میزان", "سنبله", "اسد", "سرطان", "جوزا", "ثور", "حمل"];
    today = new Date();
    d = today.getDay();
    day = today.getDate();
    month = today.getMonth() + 1;
    year = today.getYear();

    year = (window.navigator.userAgent.indexOf('MSIE') > 0) ? year : 1900 + year;
    if (year == 0) {
        year = 2000;
    }
    if (year < 100) {
        year += 1900;
    }
    y = 1;
    for (i = 0; i < 3000; i += 4) {
        if (year == i) {
            y = 2;
        }
    }
    for (i = 1; i < 3000; i += 4) {
        if (year == i) {
            y = 3;
        }
    }
    if (y == 1) {
        year -= ((month < 3) || ((month == 3) && (day < 21))) ? 622 : 621;
        switch (month) {
            case 1:
                (day < 21) ? (month = 10, day += 10) : (month = 11, day -= 20);
                break;
            case 2:
                (day < 20) ? (month = 11, day += 11) : (month = 12, day -= 19);
                break;
            case 3:
                (day < 21) ? (month = 12, day += 9) : (month = 1, day -= 20);
                break;
            case 4:
                (day < 21) ? (month = 1, day += 11) : (month = 2, day -= 20);
                break;
            case 5:
            case 6:
                (day < 22) ? (month -= 3, day += 10) : (month -= 2, day -= 21);
                break;
            case 7:
            case 8:
            case 9:
                (day < 23) ? (month -= 3, day += 9) : (month -= 2, day -= 22);
                break;
            case 10:
                (day < 23) ? (month = 7, day += 8) : (month = 8, day -= 22);
                break;
            case 11:
            case 12:
                (day < 22) ? (month -= 3, day += 9) : (month -= 2, day -= 21);
                break;
            default:
                break;
        }
    }
    if (y == 2) {
        year -= ((month < 3) || ((month == 3) && (day < 20))) ? 622 : 621;
        switch (month) {
            case 1:
                (day < 21) ? (month = 10, day += 10) : (month = 11, day -= 20);
                break;
            case 2:
                (day < 20) ? (month = 11, day += 11) : (month = 12, day -= 19);
                break;
            case 3:
                (day < 20) ? (month = 12, day += 10) : (month = 1, day -= 19);
                break;
            case 4:
                (day < 20) ? (month = 1, day += 12) : (month = 2, day -= 19);
                break;
            case 5:
                (day < 21) ? (month = 2, day += 11) : (month = 3, day -= 20);
                break;
            case 6:
                (day < 21) ? (month = 3, day += 11) : (month = 4, day -= 20);
                break;
            case 7:
                (day < 22) ? (month = 4, day += 10) : (month = 5, day -= 21);
                break;
            case 8:
                (day < 22) ? (month = 5, day += 10) : (month = 6, day -= 21);
                break;
            case 9:
                (day < 22) ? (month = 6, day += 10) : (month = 7, day -= 21);
                break;
            case 10:
                (day < 22) ? (month = 7, day += 9) : (month = 8, day -= 21);
                break;
            case 11:
                (day < 21) ? (month = 8, day += 10) : (month = 9, day -= 20);
                break;
            case 12:
                (day < 21) ? (month = 9, day += 10) : (month = 10, day -= 20);
                break;
            default:
                break;
        }
    }
    if (y == 3) {
        year -= ((month < 3) || ((month == 3) && (day < 21))) ? 622 : 621;
        switch (month) {
            case 1:
                (day < 20) ? (month = 10, day += 11) : (month = 11, day -= 19);
                break;
            case 2:
                (day < 19) ? (month = 11, day += 12) : (month = 12, day -= 18);
                break;
            case 3:
                (day < 21) ? (month = 12, day += 10) : (month = 1, day -= 20);
                break;
            case 4:
                (day < 21) ? (month = 1, day += 11) : (month = 2, day -= 20);
                break;
            case 5:
            case 6:
                (day < 22) ? (month -= 3, day += 10) : (month -= 2, day -= 21);
                break;
            case 7:
            case 8:
            case 9:
                (day < 23) ? (month -= 3, day += 9) : (month -= 2, day -= 22);
                break;
            case 10:
                (day < 23) ? (month = 7, day += 8) : (month = 8, day -= 22);
                break;
            case 11:
            case 12:
                (day < 22) ? (month -= 3, day += 9) : (month -= 2, day -= 21);
                break;
            default:
                break;
        }
    }
    if (type == 'full') {
        return (week[d] + " " + day + " " + months[month - 1] + " " + year);
    }
    else if (type == 'year') {
        return year;
    }
    else if (type == "day") {
        return day;
    } else if (type == "month") {
        return months[month - 1]

    } else if (type == "week") {
        return week[d];
    }
}

function objToString(obj) {
    var str = '';
    for (var p in obj) {
        if (obj.hasOwnProperty(p)) {
            str += p + '::' + obj[p] + '\n';
        }
    }
    return str;
}


function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [year, month, day].join('/');
}

function removeImage(url,token){

    $(document).on('click','#btn_r',function (event) {

        event.preventDefault();
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        $.ajax({
           method:'post',
           url:url,
            data:{
              _token:token,
            },
            contentType:false,
            success:function (data) {
                console.log(data);
            },
            error:function (data) {
               console.log(data);
            }
        });
    })
}

