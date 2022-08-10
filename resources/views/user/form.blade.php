
<h3 class="box-title">
    {{isset($panel_title) ?$panel_title :''}}
</h3>
<div class="col-lg-6 col-xs-12">
    <form action="{{isset($user)?route('user.update',$user->id): route('user.create')}}" method="post" id="frm">
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
               @if(\Illuminate\Support\Facades\Auth::user()->user_level==1)
                    <option value = "1" {{(isset($user->user_level) && $user->user_level==1)?'selected'.'='.'selected':''}}>Manager</option>
                    <option value = "2" {{(isset($user->user_level) && $user->user_level==2)?'selected'.'='.'selected':''}}>Admin</option>

                @endif
                @if(\Illuminate\Support\Facades\Auth::user()->user_level==2)
                    <option value = "2" {{(isset($user->user_level) && $user->user_level==2)?'selected'.'='.'selected':''}}>Admin</option>
                @endif
                <option value = "3" {{(isset($user->user_level) && $user->user_level==3)?'selected'.'='.'selected':''}}>User</option>
            </select>
        </div>
        <!-- /.input-group -->

        @can('isManager')
            <div class="input-group margin-bottom-20" id="agency">
                <div class="input-group-btn"><label for="agency_id" class="btn btn-default">انتخاب نماینده گی:*</label></div>
                <!-- /.input-group-btn -->
                <select id="agency_id"  class="form-control select2_1"  name="agency_id">
                    @foreach ($agencies as $agency)
                        <option value="{{ $agency->agency_id }}"  @if (isset($user) && $agency->agency_id == $user->agency_id)
                        selected
                                @endif>{{ $agency->agency_name }}</option>
                    @endforeach
                </select>
            </div>
        @endcan

        @if(isset($status))
            <div class="input-group margin-bottom-20 " >
                <div class="input-group-btn"><label for="password" class="btn btn-default"><i class="fa fa-lock"></i></label></div>
                <!-- /.input-group-btn -->
                <input id="old-password" type="password" class="form-control" placeholder="رمز قدیم" name="old-password" >
            </div>
        @endif

        <div class="input-group margin-bottom-20 required" id="form-password-error">
            <div class="input-group-btn required"><label for="password" class="btn btn-default"><i class="fa fa-lock"></i></label></div>
            <!-- /.input-group-btn -->
            <input id="password" type="password" class="form-control required" placeholder="رمز عبور" name="password" >
        </div>
        <span id="password-error" class="help-block"></span>

        <!-- /.input-group -->
        <div class="input-group margin-bottom-20">
            <div class="input-group-btn"><label for="password_confirmation" class="btn btn-default"><i class="fa fa-lock"></i></label></div>
            <!-- /.input-group-btn -->
            <input id="password_confirmation" type="password" class="form-control" placeholder="تایید رمز عبور" name="password_confirmation">
        </div>
        <a href="javascript:ajaxLoad('{{route('user.list')}}')" class="btn btn-danger">لغو<i class="fa fa-backward" style="margin-right: 5px;"></i></a>
        <button class="btn btn-primary" type="submit" id="btn_save">ذخیره<i class="fa fa-save" style="margin-right: 5px;"></i></button>
    </form>

</div>
<!-- /.col-lg-4 ol-xs-12 -->

<script>
    selectTwo();
</script>

{{--<script>--}}
{{--    $(document).ready(function () {--}}
{{--        $('#agency').hide();--}}
{{--        $('#user_level').change(function () {--}}
{{--            if ($('#user_level').val() != 1){--}}
{{--                $('#agency').show();--}}
{{--            } else if ($('#user_level').val() == 1) {--}}
{{--                $('#agency').hide();--}}
{{--            }--}}
{{--        })--}}
{{--    })--}}
{{--</script>--}}




{{--

<div class="container">
    <div class="row">
        <h3 style="margin-right: 2%">ثبت کاربرجدید</h3>
        <div class="col-md-8 col-md-offset-2">
            <form method="post" id="frm" action="{{isset($user) ?url('user/update/'.$user->user_id):route('user.create')}}" >
                {{isset($user) ?method_field('put') :''}}
                {{csrf_field()}}

                <div class="form-group required" id="form-name-error">
                    <label for="name" class="col-md-4 control-label">نام:</label>
                    <div class="col-md-12">
                        <input id="name" type="text" class="form-control required" name="name" value="{{ old('name',isset($user->name)? $user->name:'' ) }}" required autofocus>
                        <span id="name-error" class="help-block"></span>
                    </div>
                </div>
                <div class="form-group required" id="form-last_name-error">
                    <label for="last_name" class="col-md-4 control-label"> فامیلی:</label>
                    <div class="col-md-12">
                        <input id="last_name" type="text" class="form-control required" name="last_name" value="{{ old('last_name',isset($user->last_name)? $user->last_name:'') }}" required autofocus>
                        <span id="last_name-error" class="help-block"></span>
                    </div>
                </div>

                <div class="form-group required " id="form-user_name-error">
                    <label for="user_name" class="col-md-4 control-label">نام کاربری:</label>
                    <div class="col-md-12">
                        <input id="user_name" type="email" class="form-control required" name="user_name" value="{{ old('user_name',isset($user->user_name)? $user->user_name:'') }}" required>
                        <span id="user_name-error" class="help-block"></span>
                    </div>
                </div>

                <div class="form-group required" id="form-password-error">
                    <label for="password" class="col-md-4 control-label">رمز عبور:</label>
                    <div class="col-md-12">
                        <input id="password" type="password" class="form-control required" name="password" required>
                        <span id="password-error" class="help-block"></span>
                    </div>
                </div>
                <div class="form-group required " id="form-level-error">
                    <label for="level" class="col-md-4 control-label">نقش کاربر:</label>

                    <div class="col-md-12">
                        <select name="level" id="level" class="form-control required">
                            <option value="1"{{ isset($user) && $user->user_level==1 ? 'selected': '' }}>boss</option>
                            <option value="2"{{ isset($user) && $user->user_level==2 ? 'selected': '' }}>admin </option>
                            <option value="3"{{ isset($user) && $user->user_level==3 ? 'selected': '' }}> user</option>
                        </select>
                        <span id="level-error" class="help-block"></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <a href="javascript:ajaxLoad('user')" class="btn btn-danger">لغو</a>
                        <button type="submit" id="btn_save" class="btn btn-primary">ذخیره</button>

                    </div>
                </div>


            </form>



        </div>
    </div>
</div>
--}}
