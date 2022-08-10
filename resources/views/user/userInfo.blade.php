<div class="col-md-12">
    <h3 style="text-align: center" id="title">{{$panel_title  }}</h3>
    <table id="example" class="table table-striped table-bordered display" style="width:100%">
        <thead>
        <tr>
            <th>ادی</th>
            <th>نام</th>
            <th>فامیلی</th>
            <th>نام کاربری</th>
            <th>نقش کاربری</th>
            <th id="operations_title">عملیات</th>

        </tr>
        </thead>
        <tfoot id="footer">
        <tr>
            <th>ادی</th>
            <th>نام</th>
            <th>فامیلی</th>
            <th>نام کاربری</th>
            <th>نقش کاربری</th>
            <th>عملیات</th>

        </tr>
        </tfoot>
        <tbody id="content-display">
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->last_name}}</td>
                <td>{{$user->username}}</td>
                @if($user->user_level == 1)
                    <td>مدیر عمومی</td>
                @elseif ($user->user_level == 2)
                    <td>مدیر</td>
                @else
                    <td>کاربر عادی</td>
                @endif
                <td id="operations"><a href="javascript:ajaxLoad('{{route('user.editUserInfo',$user->id)}}')" style="font-size: 20px; padding-top: 3px;"><i class="fa fa-edit"></i></a>
                    <a href="javascript:ajaxLoad('{{route('user.editUserSecurity',$user->id)}}')" style="font-size: 20px; padding-right: 5px;"><i class="fa fa-expeditedssl"></i></a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <script>


    </script>

</div>




