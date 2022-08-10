<div class="container">

    <div class="tabbable boxed parentTabs">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#set1">ثبت شرکت</a></li>
            <li><a href="#set2">ثبت حساب شرکت</a></li>


        </ul>
        {{--  start tab content  --}}
        <div class="tab-content">
            {{--first tab--}}
            <div class="tab-pane fade in active" id="set1">
                <h4 class="box-title" style="text-align: center">
                    {{isset($panel_title) ?$panel_title :'ثبت مشخصات شرکت'}}
                </h4>
                <form method="post" id="frm"
                      action="{{isset($company) ?route('company.update',$company->company_id):route('company.create')}}">
                    {{isset($company) ?method_field('put') :''}}
                    {{csrf_field()}}
                    <div class="form-group required" id="form-company-name-error">
                        <label for="company-name">نام کمپنی:*</label>
                        <input type="text" class="form-control required" id="country-code" name="company-name"
                               value="{{old('company-name',isset($company) ?$company->company_name :'')}}">
                        <span id="company-name-error" class="help-block"></span>
                    </div>
                    <div class="form-group required" id="form-phone-error">
                        <label for="phone">شماره تلفن:*</label>
                        <input type="text" class="form-control required" id="phone" name="phone"
                               value="{{old('phone',isset($company)? $company->phone:'')}}">
                        <span class="help-block" id="phone-error"></span>
                    </div>
                    <div class="form-group required" id="form-address-error">
                        <label for="address">آدرس:*</label>
                        <textarea type="text" class="form-control required" id="address" name="address" value=""
                                  cols="4">{{isset($company)? $company->address:''}}</textarea>
                        <span class="help-block" id="address-error"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="btn_save" class="btn btn-primary">ثبت اطلاعات</button>
                        <a href="javascript:ajaxLoad('{{route('company.list')}}')" class="btn btn-danger">لغو</a>
                    </div>
                </form>
            </div>
            {{--second tab--}}
            <div class="tab-pane fade in" id="set2">
                <h4 class="box-title" style="text-align: center">
                    {{isset($panel_title) ?$panel_title :'ثبت حساب شرکت'}}
                </h4>
                <form method="post" id="frm" action="{{ route('customer_company_store_money.create') }}">
                    {{csrf_field()}}
                    <input type="hidden" id="type" name="type" value="company">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required" id="form-account_type-error">
                                <label for=""> انتخاب شرکت: *</label>
                                <select name="account_type" id="account_type" class="form-control">
                                    <option selected disabled>انتخاب کنید...</option>
                                    @foreach($companies as $company)
                                        <option value="{{$company->company_id}}">{{$company->company_name}}</option>
                                    @endforeach
                                </select>
                                <span id="account_type-error" class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group required" id="form-payment_type-error">
                                <label for=""> ثبت بدهی/پیش پرداخت: *</label>
                                <select name="payment_type" id="payment_type" class="form-control">
                                    <option selected disabled>انتخاب کنید...</option>
                                    <option value="old_borrow">بدهی</option>
                                    <option value="new_payment">طلب</option>
                                </select>
                                <span id="payment_type-error" class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group required" id="form-amount-error">
                                <label for="amount"> مقدار پول: *</label>
                                <input type="number" name="amount" step="any" id="amount"
                                       class="form-control required"
                                       value="">
                                <span id="amount-error" class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group required" id="form-currency_id-error">
                                <label for="currency_id">واحد پولی:</label>
                                <select name="currency_id" id="currency_id" class="form-control ">
                                    @foreach ($currencies as $currency)
                                        <option value="{{ $currency->currency_id }}">{{ $currency->currency_name }} {{$currency->symbol}}</option>
                                    @endforeach
                                </select>
                                <span id="currency_id-error" class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group required" id="form-currency_id-error">
                                <label for="date">تاریخ:</label>
                                <input type="text" class="form-control date-picker" name="date" id="date">
                                <span id="date-error" class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group required" id="form-agency_name-error">
                                <label for="agency_name">نماینده گی:</label>
                                <select name="agency_name" id="agency_name" class="form-control ">
                                    @foreach ($agencies as $agency)
                                        <option value="{{ $agency->agency_id }}">{{ $agency->agency_name }}</option>
                                    @endforeach
                                </select>
                                <span id="agency_name-error" class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btn-save">ذخیره</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
<script type="text/javascript">


    $(document).ready(function () {
        /*-------------------------*/
        $("ul.nav-tabs a").click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
        $(".date-picker").persianDatepicker({
            // onRender: function () {
            //     $(".date-picker").val($(".today ").data("jdate"))
            // }
        });
    });
</script>
