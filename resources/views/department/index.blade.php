<?php $i=0;?>
<div class="col-md-12">
    <h4 style="text-align: center" id="title">
        {{isset($panel_title) ?$panel_title :''}}
    </h4>
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
                <button id="print_button"  class="fa fa-print form-control" ></button>
            </div>
        </div>
        <div class="col-md-6"></div>
        <div class="col-md-3">
            <div class="input-group">
                <input type="text" class="form-control" id="search" placeholder="Search" autocomplete="off">
                <div class="input-group-addon">
                    <i class="glyphicon glyphicon-search" id="search_icon"></i>
                </div>
            </div>
        </div>
    </div>
    <table id="example" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th >شماره</th>
            <th >نام بخش</th>
            <th >عملیات</th>



        </tr>
        </thead>
        <tbody id="content-display">
        @foreach($departments as $department)
            <tr>
                <td>{{++$i}}</td>
                <td>{{$department->dep_name}}</td>
                <td colspan="2" id="operations">
                    <a href="javascript:if(confirm('Are you want to delete this record?'))ajaxDelete('{{route('dep.delete',$department->id)}}','{{csrf_token()}}')" ><i class=" glyphicon glyphicon-trash "  style="padding: 4px;border-radius: 8px;color:#FFFFFF; background-color:red"></i></a>
                    <a href="javascript:ajaxLoad('{{route('dep.update',$department->id)}}')"  ><i class="glyphicon glyphicon-edit " style="padding: 4px;border-radius: 8px;color:#FFFFFF; background-color: dodgerblue"></i></a>
                </td>
            </tr>

        @endforeach

        </tbody>

    </table>
    <div class="pagination" style="float: left">
        {{$departments->links()}}
    </div>
    <script>

        $(document).ready(function () {
            $(".list-page").change(function () {

                console.log();
                ajaxLoad('<?php echo $route; ?>'+"/"+$(this).val())

            })
        })

        $(".pagination a").unbind().bind("click",function (event) {
            event.preventDefault();

            $('li').removeClass('active');
            $(this).parent('li').addClass('active');

            var myurl = $(this).attr('href');

            ajaxLoad(myurl);


        })


    </script>
</div>
