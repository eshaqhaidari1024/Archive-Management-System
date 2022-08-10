

<h4 class="box-title">
    {{isset($panel_title) ?$panel_title :''}}
</h4>
<div class="col-md-6 col-md-offset-3">
    <form method="post" id="frm" action="{{isset($company) ?route('company.update',$company->company_id):route('company.create')}}" >
        {{isset($company) ?method_field('put') :''}}
        {{csrf_field()}}
        <div class="form-group required" id="form-company-name-error">
            <label for="company-name">نام کمپنی:*</label>
            <input type="text" class="form-control required" id="country-code" name="company-name" value="{{old('company-name',isset($company) ?$company->company_name :'')}}">
            <span id="company-name-error" class="help-block"></span>
        </div>
        <div class="form-group required" id="form-phone-error">
            <label for="phone">شماره تلفن:*</label>
            <input type="text" class="form-control required" id="phone" name="phone" value="{{old('phone',isset($company)? $company->phone:'')}}">
            <span class="help-block" id="phone-error"></span>
        </div>
        <div class="form-group required" id="form-address-error">
            <label for="address">آدرس:*</label>
            <textarea type="text" class="form-control required" id="address" name="address" value="" cols="4">{{isset($company)? $company->address:''}}</textarea>
            <span class="help-block" id="address-error"></span>
        </div>
        <div class="form-group">
            <button type="submit" id="btn_save" class="btn btn-primary">ثبت اطلاعات</button>
            <a href="javascript:ajaxLoad('{{route('company.list')}}')" class="btn btn-danger">لغو</a>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function () {


    })
</script>
