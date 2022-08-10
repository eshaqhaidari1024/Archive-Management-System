<h4 class="box-title">
    {{isset($panel_title) ?$panel_title :''}}
</h4>
<div class="col-md-6 col-md-offset-3">
    <form method="post" id="frm" action="{{isset($department) ? route('dep.update',$department->id) : route('dep.create')}}" enctype="multipart/form-data">
        {{ isset($department) ? method_field('put') :''  }}
        {{csrf_field()}}


        <div class="form-group required " id="form-arch-dep-error">
            <label for="arch-dep">نام دیپارتمنت:*</label>
            <input type="text" class="form-control required" id="arch-dep" name="arch-dep" value="{{old('arch-dep',isset($department) ? $department->dep_name :'')}}">
            <span class="help-block" id="arch-dep-error"></span>
        </div>


        <div class="form-group ">
            <button type="submit" id="btn_save" class="btn btn-primary">ثبت اطلاعات</button>
            <a href="javascript:ajaxLoad('{{route('dep.list')}}')" class="btn btn-danger">لغو</a>
        </div>
    </form>
</div>