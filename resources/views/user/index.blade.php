@php
$numbers =range(1,10);

shuffle($numbers);
@endphp
<div class="col-md-12">
    <h3 style="text-align: center">{{$panel_title  }}</h3>

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

    {{--@if (isset())--}}
        {{--<div class="aler alert-success">--}}
            {{--{{  }}--}}
        {{--</div>--}}
    {{--@endif--}}
    <table id="example" class="table table-striped table-bordered display" style="width:100%">
        <thead>
        <tr>
            <th>ادی</th>
            <th>نام</th>
            <th>فامیلی</th>
            <th>نام کاربری</th>
            <th>نقش کاربری</th>
            <th>فعال/غیرفعال</th>
            {{--<th id="operations_title">عملیات</th>--}}

        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>ادی</th>
            <th>نام</th>
            <th>فامیلی</th>
            <th>نام کاربری</th>
            <th>نقش کاربری</th>
            <th>فعال/غیرفعال</th>
            {{--<th id="operations_title">عملیات</th>--}}

        </tr>
        </tfoot>
        <tbody  id="content-display">
        @foreach($users as $user)
            <tr>
                <td>{{array_pop($numbers)}} </td>
                <td>{{$user->name}}</td>
                <td>{{$user->last_name}}</td>
                <td>{{$user->username}}</td>
                <td>
                    @if($user->user_level == 1)
                        مدیر عمومی
                    @elseif ($user->user_level == 2)
                        مدیر
                    @else
                        کاربر عادی
                    @endif
                </td>

                @if (Auth::user()->user_level == 1)
                    @if ($user->user_level == 1)
                        <td id="operations">
                            <div class="material-switch pull-right">
                                <input id="{{ $user->id }}" data-id="{{$user->id}}" disabled name="someSwitchOption001" type="checkbox" class="toggle-class" @if ($user->status == 0)
                                checked
                                        @endif/>
                                <label for="{{ $user->id }}" onclick="alert('شما اجازه تغییر دادن ندارید')" class="label-primary" style="cursor: not-allowed;"></label>
                            </div>
                        </td>
                    @else
                        <td id="operations">
                            <div class="material-switch pull-right">
                                <input id="{{ $user->id }}" data-id="{{$user->id}}" name="someSwitchOption001" type="checkbox" class="toggle-class" @if ($user->status == 0)
                                checked
                                        @endif/>
                                <label for="{{ $user->id }}" class="label-primary"></label>
                            </div>
                        </td>
                    @endif

                @elseif (Auth::user()->user_level == 2)
                    @if ($user->user_level == 1 || $user->user_level == 2)
                        <td id="operations">
                            <div class="material-switch pull-right">
                                <input id="{{ $user->id }}" data-id="{{$user->id}}" disabled name="someSwitchOption001" type="checkbox" class="toggle-class" @if ($user->status == 0)
                                checked
                                        @endif/>
                                <label for="{{ $user->id }}" onclick="alert('شما اجازه تغییر دادن ندارید')" class="label-primary" style="cursor: not-allowed;"></label>
                            </div>
                        </td>
                    @else
                        <td id="operations">
                            <div class="material-switch pull-right">
                                <input id="{{ $user->id }}" data-id="{{$user->id}}" name="someSwitchOption001" type="checkbox" class="toggle-class" @if ($user->status == 0)
                                checked
                                        @endif/>
                                <label for="{{ $user->id }}" class="label-primary"></label>
                            </div>
                        </td>
                    @endif
                @else
                    <td id="operations">
                        <div class="material-switch pull-right">
                            <input id="{{ $user->id }}" data-id="{{$user->id}}"  disabled name="someSwitchOption001" type="checkbox" class="toggle-class" @if ($user->status == 0)
                            checked
                                    @endif/>
                            <label for="{{ $user->id }}" class="label-primary" onclick="alert('شما اجازه تغییر دادن ندارید')" style="cursor: not-allowed;"></label>
                        </div>
                    </td>
                @endif
                @if(\Illuminate\Support\Facades\Auth::user()->user_level==\App\Models\User::MANAGER)
                <td id="operations">
                <a href="javascript:ajaxLoad('{{route('user.editUserPublicInfoUpdate',$user->id)}}')" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                <a href="javascript:ajaxLoad('{{route('user.editUserSecurityInfoUpdate',$user->id)}}')" class="btn btn-sm btn-success"><i class="fa fa-lock"></i></a>
                    <a href="javascript:if(confirm('Are you sure you want to delete this?')) ajaxDelete('{{route('user.delete',$user->id)}}','{{csrf_token()}}')"
                       class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                </td>

                    @endif
            </tr>



        @endforeach

        </tbody>
    </table>
    <div class="pagination" style="float: left">
        {{ $users->links() }}
    </div>
    <script>
        $(document).ready(function () {


            // var dis = $('input').attr('disabled','disabled');
            // $(dis).on('click', function () {
            //
            // })

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
                var search = $('#search').val();

                if (search != '') {
                    $('.loading').show();
                    $.ajax({
                        type: 'get',
                        url: 'user/search/'+search,
                        success: function (response) {
                            var trHTML = '';

                            $.each(response.data, function (i, item) {
                                trHTML += '<tr><td>' + item.user_id + '</td><td>' +
                                    item.name + '</td><td>'+  item.last_name + '</td><td>'+ item.username ;
                                if(item.user_level==1)
                                    trHTML+= '<td>مدیر کل</td>  ';


                                else if(item.user_level==2)
                                    trHTML+=    '<td>ادمین</td>  ';


                                else
                                    trHTML+=   '<td>کاربر عادی</td>  ';

                                trHTML +='<td>';
                                if (response.user_logged_in.user_level == 1)
                                        if (item.user_level == 1)
                                            if (item.status == 0)
                                            // $(".toggle-class").prop({"checked":true});
                                                trHTML += '<div class="material-switch pull-right"><input id='+item.user_id+' data-id='+item.user_id+' disabled name="someSwitchOption001" type="checkbox" class="toggle-class" checked>'+
                                                    '<label for='+item.user_id+' class="label-primary" onclick="alert(\'شما اجازه تغییر دادن ندارید\')" style="cursor: not-allowed;"></label>'+
                                                    '</div>';
                                            else
                                                trHTML +=
                                                    trHTML += '<div class="material-switch pull-right"><input id='+item.user_id+' data-id='+item.user_id+' disabled name="someSwitchOption001" type="checkbox" class="toggle-class" >'+
                                                        '<label for='+item.user_id+' class="label-primary" onclick="alert(\'شما اجازه تغییر دادن ندارید\')" style="cursor: not-allowed;"></label>'+
                                                        '</div>';
                                        else
                                            if (item.status == 0)
                                            // $(".toggle-class").prop({"checked":true});
                                                trHTML += '<div class="material-switch pull-right"><input id='+item.user_id+' data-id='+item.user_id+' name="someSwitchOption001" type="checkbox" class="toggle-class" checked>'+
                                                    '<label for='+item.user_id+' class="label-primary"></label>'+
                                                    '</div>';
                                            else
                                                trHTML +=
                                                    trHTML += '<div class="material-switch pull-right"><input id='+item.user_id+' data-id='+item.user_id+' name="someSwitchOption001" type="checkbox" class="toggle-class" >'+
                                                        '<label for='+item.user_id+' class="label-primary"></label>'+
                                                        '</div>';
                                else if (response.user_logged_in.user_level == 2)

                                        if (item.user_level == 1 || item.user_level == 2)
                                            if (item.status == 0)
                                            // $(".toggle-class").prop({"checked":true});
                                                trHTML += '<div class="material-switch pull-right"><input id='+item.user_id+' data-id='+item.user_id+' disabled name="someSwitchOption001" type="checkbox" class="toggle-class" checked>'+
                                                    '<label for='+item.user_id+' class="label-primary" onclick="alert(\'شما اجازه تغییر دادن ندارید\')" style="cursor: not-allowed;"></label>'+
                                                    '</div>';
                                            else
                                                trHTML +=
                                                    trHTML += '<div class="material-switch pull-right"><input id='+item.user_id+' data-id='+item.user_id+' disabled name="someSwitchOption001" type="checkbox" class="toggle-class" >'+
                                                        '<label for='+item.user_id+' class="label-primary" onclick="alert(\'شما اجازه تغییر دادن ندارید\')" style="cursor: not-allowed;"></label>'+
                                                        '</div>';
                                        else
                                            if (item.status == 0)
                                            // $(".toggle-class").prop({"checked":true});
                                                trHTML += '<div class="material-switch pull-right"><input id='+item.user_id+' data-id='+item.user_id+' name="someSwitchOption001" type="checkbox" class="toggle-class" checked>'+
                                                    '<label for='+item.user_id+' class="label-primary"></label>'+
                                                    '</div>';
                                            else
                                                trHTML +=
                                                    trHTML += '<div class="material-switch pull-right"><input id='+item.user_id+' data-id='+item.user_id+' name="someSwitchOption001" type="checkbox" class="toggle-class" >'+
                                                        '<label for='+item.user_id+' class="label-primary"></label>'+
                                                        '</div>';
                                else
                                    if (item.status == 0)
                                    // $(".toggle-class").prop({"checked":true});
                                        trHTML += '<div class="material-switch pull-right"><input id='+item.user_id+' data-id='+item.user_id+' disabled name="someSwitchOption001" type="checkbox" class="toggle-class" checked>'+
                                            '<label for='+item.user_id+' class="label-primary" onclick="alert(\'شما اجازه تغییر دادن ندارید\')" style="cursor: not-allowed;"></label>'+
                                            '</div>';
                                    else
                                        trHTML +=
                                            trHTML += '<div class="material-switch pull-right"><input id='+item.user_id+' data-id='+item.user_id+' disabled name="someSwitchOption001" type="checkbox" class="toggle-class" >'+
                                                '<label for='+item.user_id+' class="label-primary" onclick="alert(\'شما اجازه تغییر دادن ندارید\')" style="cursor: not-allowed;"></label>'+
                                                '</div>';

                                trHTML +=
                                    // '<td id="operations">'+
                                    // '<button  id-item=' + item.user_id + ' class="glyphicon glyphicon-edit btn btn-success btn-sm edit_public_user" ></button>' + '&nbsp;' +
                                    // '<button  id-item=' + item.user_id + ' class="glyphicon glyphicon-lock btn btn-success btn-sm edit_security_user" ></button>' + '&nbsp;' +
                                    // '<button  id-item=' + item.user_id + ' class="glyphicon glyphicon-trash btn btn-danger btn-sm delete_user" ></button>' +
                                    '</td>'
                                '</tr>';

                            });
                            $('.loading').hide();
                            $('#content-display').html(trHTML)
                        }

                    })
                }
                //edit detail section
                $("#content-display").on('change', ".toggle-class", function () {

                    var user_id = $(this).attr("data-id");
                    var status = $(this).prop('checked') == true ? 0 : 1;
                    // var user_id = $(this).data('id');

                    $('.loading').show();
                    $.ajax({
                        type: "GET",
                        url: 'user/changeStatus',
                        data: {'status': status, 'user_id': user_id},
                        success: function(data){
                            console.log(data.success)
                            $('.loading').hide();
                        }

                    });
                });

                // Edit User Security
                $("#content-display").on('click', ".edit_security_user", function () {

                    var id = $(this).attr("id-item");
                    //alert(id)
                    javascript:ajaxLoad("user/editUserSecurityInfoUpdate/" + id);
                });

                // Delete user
                $("#content-display").on('click', ".delete_user", function () {

                    var id = $(this).attr("id-item");
                    //alert(id)
                    if (confirm('Are you want to delete this record?')){
                        javascript:ajaxDelete("user/delete/" + id, $('meta[name="csrf-token"]').attr('content'));
                    }
                });

            })


            })

        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 0 : 1;
                var user_id = $(this).data('id');

                $('.loading').show();
                $.ajax({
                    type: "GET",
                    url: 'user/changeStatus',
                    data: {'status': status, 'user_id': user_id},
                    success: function(data){
                        console.log(data.success)
                        $('.loading').hide();
                    }

                });
            })
        })
    </script>
</div>




