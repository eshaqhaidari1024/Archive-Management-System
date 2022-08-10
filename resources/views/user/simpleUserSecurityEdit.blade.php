
<h3 class="box-title">
    {{isset($panel_title) ?$panel_title :''}}
</h3>
<div class="col-lg-6 col-xs-12">
    <form action="{{url('user/editUserSecurity',$user->id)}}" method="post" id="frm">
        {{isset($user)?method_field('put'):''}}
        {{csrf_field()}}


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
        <a href="javascript:ajaxLoad('{{ route('user.userInfo', $user->id) }}')" class="btn btn-danger">لغو<i class="fa fa-backward" style="margin-right: 5px;"></i></a>
        <button class="btn btn-primary" type="submit" id="btn_save">ذخیره<i class="fa fa-save" style="margin-right: 5px;"></i></button>
    </form>

</div>
<!-- /.col-lg-4 ol-xs-12 -->

<script>
    selectTwo();
</script>

