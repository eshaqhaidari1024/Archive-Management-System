<!-- Modal -->
<div class="modal fade " id="stack_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">ویرایش گدام مورد نظر</h4>
            </div>
            <div class="modal-body">

                <form action="{{route('store.edit')}}" id="frm" method="post">
                    {{csrf_field()}}
                    <input type="hidden" id="store_id" name="store_id">
                    <div class="form-group required" id="form-store_name-error">
                        <label for="store_name">نام گدام:*</label>
                        <input type="text" name="store_name" id="store_name" class="form-control required">
                        <span id="store_name-error" class="help-block"></span>
                    </div>
                    <div class="form-group required" id="form-store_address-error">
                        <label for="store_address">آدرس:*</label>
                        <textarea type="text" name="store_address" id="store_address" class="form-control required"
                                  cols="4" rows="4"></textarea>
                        <span id="store_address-error" class="help-block"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm waves-effect waves-light"
                                data-dismiss="modal">منصرف شدن
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light" id="btn_save">
                            ذخیره اطلاعات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).on('submit', '#btn_save', function () {

        $('#stack_modal').modal('hide');

    })
</script>


