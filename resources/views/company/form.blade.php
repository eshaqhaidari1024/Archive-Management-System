

<h4 class="box-title">
    {{isset($panel_title) ?$panel_title :''}}
</h4>
<div class="col-md-6 col-md-offset-3">
    <form method="post" id="frm" action="" >

        <div class="form-group required" id="form-company-name-error">
            <label for="company-name">نام کمپنی:*</label>
            <input type="text" class="form-control required" id="country-code" name="company-name" value="">
            <span id="company-name-error" class="help-block"></span>
        </div>
        <div class="form-group required" id="form-phone-error">
            <label for="phone">شماره تلفن:*</label>
            <input type="text" class="form-control required" id="phone" name="phone" value="">
            <span class="help-block" id="phone-error"></span>
        </div>
        <div class="form-group required" id="form-address-error">
            <label for="address">آدرس:*</label>
            <textarea type="text" class="form-control required" id="address" name="address" value="" cols="4"></textarea>
            <span class="help-block" id="address-error"></span>
        </div>
        <div class="form-group">
            <button type="submit" id="btn_save" class="btn btn-primary">ثبت اطلاعات</button>
            <a href="" class="btn btn-danger">لغو</a>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function () {


    })
</script>
