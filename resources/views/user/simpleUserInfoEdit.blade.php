
<h3 class="box-title">
    {{isset($panel_title) ?$panel_title :''}}
</h3>
<div class="col-lg-6 col-xs-12">
    <form action="{{route('user.editUserInfo', $user->id)}}" method="post" id="frm">
        {{isset($user)?method_field('put'):''}}
        {{csrf_field()}}
        <div class="input-group margin-bottom-20 required" id="form-name-error">
            <div class="input-group-btn"><label for="name" class="btn btn-default">نام:*</label></div>
            <!-- /.input-group-btn -->
            <input id="name" type="text" class="form-control required" placeholder="نام" name="name" value="{{old('name',isset($user->name)?$user->name:'')}}">
        </div>
        <span id="name-error" class="help-block"></span>
        <!-- /.input-group -->
        <div class="input-group margin-bottom-20 required" id="form-last_name-error">
            <div class="input-group-btn"><label for="last_name" class="btn btn-default">فامیلی:</label></div>
            <!-- /.input-group-btn -->
            <input id="last_name" type="text" class="form-control required" placeholder="نام فامیلی" name="last_name" value="{{old('last_name',isset($user->last_name)?$user->last_name:'')}}">
            <span id="last_name-error" class="help-block"></span>
        </div>
        <div class="input-group margin-bottom-20 required" id="form-username-error">
            <div class="input-group-btn"><label for="username" class="btn btn-default"><i class="fa fa-user"></i></label></div>
            <!-- /.input-group-btn -->
            <input id="username" type="text" class="form-control required" placeholder="نام کاربری" name="username" value="{{old('username',isset($user->username)?$user->username:'')}}">
        </div>
        <span id="username-error" class="help-block"></span>
        <!-- /.input-group -->

        <!-- /.input-group -->
        <div class="input-group margin-bottom-20" >
            <div class="input-group-btn"><label for="user_level" class="btn btn-default">نقش کاربری:*</label></div>
            <!-- /.input-group-btn -->
            <select id="user_level"  class="form-control select2_1" placeholder="نقش کاربری" name="user_level">
                @if(\Illuminate\Support\Facades\Auth::user()->user_level==\App\Models\User::MANAGER)
                    <option value="1" {{(isset($user->user_level) && $user->user_level == \App\Models\User::MANAGER)?'selected'.'='.'selected':''}}>Manager</option>
                    <option value="2" {{(isset($user->user_level) && $user->user_level ==\App\Models\User::ADMIN)?'selected'.'='.'selected':''}}>Admin</option>
                @endif
                @if(\Illuminate\Support\Facades\Auth::user()->user_level==\App\Models\User::ADMIN)
                        <option value="2" {{(isset($user->user_level) && $user->user_level ==\App\Models\User::ADMIN)?'selected'.'='.'selected':''}}>Admin</option>
                @endif
                    <option value="3" {{(isset($user->user_level) && $user->user_level ==\App\Models\User::USER)?'selected'.'='.'selected':''}}>User</option>
            </select>
        </div>
        <!-- /.input-group -->


        <a href="javascript:ajaxLoad('{{ route('user.userInfo', $user->id) }}')" class="btn btn-danger">لغو<i class="fa fa-backward" style="margin-right: 5px;"></i></a>
        <button class="btn btn-primary" type="submit"  id="btn_save">ذخیره<i class="fa fa-save" style="margin-right: 5px;"></i></button>
    </form>

</div>
<!-- /.col-lg-4 ol-xs-12 -->

<script>
    selectTwo();
</script>





