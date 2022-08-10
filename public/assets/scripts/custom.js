

var notify_message;
var datatable;
var selectTwo;
var jalali;
var getCompany;


$(document).ready(function () {

    $('ul.menu>li').each(function (i,v) {

        $(this).click(function () {

            $('.current').removeClass('current');
            $(this).addClass(' current')
        });
    })


    getCompany=function(){

        $('.stack_name').change(function () {

            alert('stack_name');
        });
    }
     selectTwo=function(){


        $('.select2_1').select2();

    }
     datatable=function () {
        $('#example').dataTable();
    }

     jalali=function () {

        /*================
     JALALI DATEPICKER
     * ===============*/
        var opt={

            // placeholder text

            placeholder: "",

            // enable 2 digits

            twodigit: true,

            // close calendar after select

            closeAfterSelect: true,

            // nexy / prev buttons

            nextButtonIcon: "fa fa-forward",

            previousButtonIcon: "fa fa-backward",

            // color of buttons

            buttonsColor: "پیشفرض ",

            // force Farsi digits

            forceFarsiDigits: true,

            // highlight today

            markToday: true,


            // highlight holidays

            markHolidays: false,

            // highlight user selected day

            highlightSelectedDay: true,

            // true or false

            sync: false,

            // display goto today button

            gotoToday: true

        }


        kamaDatepicker('jalali-datepicker',opt);
         kamaDatepicker('jalali-enddate', opt);
         kamaDatepicker('jalali-startdate', opt);
         /*Ashour*/
         kamaDatepicker('pr_date', opt);
         kamaDatepicker('tat', opt);
    }







});
/*Ebahim*/
$(document).ready(function () {
    $(document).on('change','#employee_id',function () {
        var employeeID=$(this).val();


        $.ajax({

            url:'employeereport/getemployeeinfo',
            type:'get',
            data: {
                'id': employeeID,
            },
            success:function (data) {

                for (var i=0;i<data.length;i++){
                    $('#main').text( "معاش " +'  '  +data[i].first_name +'    '+'  '+ data[i].last_name +'  '+ data[i].salary   );
                    $('#hids').val(data[i].salary);
                    $('#hide').val(data[i].salary);
                }
            }

        });

    });

});
$(document).ready(function(){
    $(document).on('change','#month_id',function(){
        var name=$(this).val();

        var employeeid=$('#employeeid').val();



        $.ajax({

            url:'employeereport/getdat',
            type:'get',
            data:{'id':name,
                'employeeId':employeeid,

            } ,
            success:function(data){
                for (var i = 0;i<data.length ;i++) {




                    $('#barrow').text(data[i].payment_barrow+' قرض دار از ماه  '   +name);

                }
                if (data.length==0) {
                    $('#payment_amount').val("") ;


                    $('#barrow').text("");


                }

                else {
                    $('#payment_amount').css("background-color", "");
                }
            }

        })
    });
});






