
<?php $i=0; ?>
<div class="col-md-12">
    <h4 style="text-align: center" id="title">
        {{isset($panel_title) ?$panel_title :''}}
    </h4>
    <a href="{{route('letter.export')}}">export</a>
    <div class="row margin-bottom-10">
        <div class="col-md-2">
            <div class="form-group">
                <select class="list-page form-control" >
                    <option>select count</option>
                    <option>5</option>
                    <option>10</option>
                    <option>20</option>
                    <option>50</option>
                </select>
            </div>
        </div>
        <div class="col-md-1">
            <div class="input-group">
                <button   class="fa fa-print form-control" onclick="imprimir()"></button>
            </div>
        </div>
        <div class="col-md-8">
            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" class="form-control" id="search_by_letter_no" placeholder="نمبر مکتوب" autocomplete="off">

                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" class="form-control" id="search_by_arch_no" placeholder="نمبر آرشیف" autocomplete="off">

                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" class="form-control" id="search_by_title" placeholder="موضوع" autocomplete="off">

                </div>
            </div>
        </div>
        <div class="col-md-1">
        <div class="input-group">
                <button   class="fa fa-search form-control" id="search_icon"></button>
            </div>
        </div>
    </div>

    <table id="example" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th >شماره</th>
            <th >نام/ نام پدر</th>
            <th >نمبر آرشیف</th>
            <th >تاریخ راجستر</th>
            <th >نمبر مکتوب</th>

            <th >تاریخ مکتوب</th>
            <th >مضمون</th>
            <th >عملیات</th>



        </tr>
        </thead>
        <tbody id="content-display">
    @foreach($letters as $letter)
            <tr>
                <td>{{++$i}}</td>
                <td>{{$letter->name .' ' .$letter->last_name}}</td>
                <td>{{$letter->arch_no}}</td>
                <td>{{$letter->arch_date_register}}</td>
                <td>{{$letter->arch_letter_no}}</td>
                <td>{{$letter->arch_date}}</td>
                <td>{{$letter->arch_title}}</td>
                <td colspan="2" id="operations">
                    <a href="javascript:if(confirm('آیا شما مطمئین  هستین  این {{$letter->id}}   ?'))ajaxDelete('{{route('letter.delete',$letter->id)}}','{{csrf_token()}}')"><i class=" glyphicon glyphicon-trash " style="padding: 4px;border-radius: 8px;color:#FFFFFF; background-color: red" ></i></a>
                    <a href="javascript:ajaxLoad('{{route('letter.update',$letter->id)}}')" ><i class="glyphicon glyphicon-edit" style="padding: 4px;border-radius: 8px;color:#FFFFFF; background-color: dodgerblue"></i></a>
                    <a href="javascript:ajaxLoad('{{route('letter.single',$letter->id)}}')" ><i class="glyphicon glyphicon-eye-open " style="padding: 4px;border-radius: 8px;color:#FFFFFF; background-color: cadetblue"></i></a>
                </td>



            </tr>

    @endforeach

        </tbody>

    </table>
    <div class="pagination" style="float: left">
        {{$letters->links()}}
    </div>

</div>
<script>

    $(document).ready(function (){

        $('#print_button').on('click',function(){
            window.print()
        })

        $(".list-page").change(function () {

            console.log();
            ajaxLoad('<?php echo $route; ?>'+"/"+$(this).val())

        })


        $(".pagination a").unbind().bind("click",function (event) {
            event.preventDefault();

            $('li').removeClass('active');
            $(this).parent('li').addClass('active');

            var myurl = $(this).attr('href');

            ajaxLoad(myurl);


        })

        // Search with Enter Key
        var input =$("#search");
        input.keyup(function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                $("#search_icon").click();
            }
        });

        // search section
        $('#search_icon').click(function () {
            var letter =$('#search_by_letter_no').val();
            var arch =$('#search_by_arch_no').val();
            var title=$('#search_by_title').val();
            var search=[letter,arch,title];

            if (search != '') {
                $('.loading').show();
                $.ajax({
                    type: 'get',
                    url: 'letter/search/'+search,
                    success: function (response) {
                        var trHTML = '';
                        if(response.data==false){

                            trHTML+='<tr><td colspan="7" style="text-align: center">هیج معلوماتی در دیتابیس یافت نشد :)</td></tr>';

                        }


                        $.each(response.data, function (i, item) {
                            trHTML += '<tr xmlns="http://www.w3.org/1999/html"><td>' + (i+1) +
                                '</td><td>' + item.name+' ' + item.last_name +
                                '</td><td>' + item.arch_no +
                                '</td><td>' + item.arch_date_register +
                                '</td><td>' +  item.arch_letter_no +
                                '</td><td>'+ item.arch_date+
                                '</td><td>'+ item.arch_title+
                                '</td><td id="operations">' +
                                '<a   id-item=' + item.id + ' class="  delete_letter" ><i class="glyphicon glyphicon-trash" style="padding: 4px;border-radius: 8px;color:#FFFFFF; background-color: red ; cursor: pointer;"></i></a>' + '&nbsp;' +
                                '<a  id-item=' + item.id + ' class="  edit_letter" ><i class="glyphicon glyphicon-edit" style="padding: 4px;border-radius: 8px;color:#FFFFFF; background-color:dodgerblue ; cursor: pointer;"></i></a>' +'&nbsp;'+
                                '<a  id-item=' + item.id + ' class="  view_letter" ><i class="glyphicon glyphicon-eye-open" style="padding: 4px;border-radius: 8px;color:#FFFFFF; background-color:cadetblue ; cursor: pointer;"></i></a>'+
                                '</td>'
                            '</tr>';

                        });
                        $('.loading').hide();
                        $('#content-display').html(trHTML)
                    }

                })
            }else {

                javascript:ajaxLoad('{{route('letter.list')}}')
            }



        })

        //edit detail section
        $("#content-display").on('click', ".edit_letter", function () {

            var id = $(this).attr("id-item");
            //alert(id)
            alert('update');
            javascript:ajaxLoad("letter/update/" + id);
        });

        // Delete company
        $("#content-display").on('click', ".delete_letter", function () {

            var id = $(this).attr("id-item");
            //alert(id)
            if (confirm('Are you want to delete this record?')){
                javascript:ajaxDelete("letter/delete/" + id, $('meta[name="csrf-token"]').attr('content'));
            }
        });
        $("#content-display").on('click', ".view_letter", function () {

            var id = $(this).attr("id-item");
            javascript:ajaxLoad('letter/single/'+id);
        });


    });



</script>
<script type="text/javascript">
    function imprimir() {

        // var company = $("#company_id option:selected").text();

        var table = document.getElementById("example");
        var d = "<html><head>" +
            "<link rel='stylesheet' href='{{ asset("assets/plugin/bootstrap/css/bootstrap.min.css") }}' >" +
            "<style> th{text-align:right !important} th:last-child,td:last-child{display: none;} body{font-family:sahle}</style>"+
            "</head><body style='direction: rtl;font-family:sahel'>"+ "<h1 class='text-center'>{{$panel_title}}</h1>"+ table.outerHTML +"</body></html>";


        newWin = window.open();
        newWin.document.write(d);
        newWin.setTimeout(function () {

            newWin.self.print();
            newWin.close();
        },3000)



    }
</script>
