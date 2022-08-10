
<h4 class="box-title">
    {{isset($panel_title) ?$panel_title :''}}
</h4>
<div class="col-md-12-col-md-12">
   <div class="col-md-4  "  style="margin-bottom: 16px;">
      <button class="btn btn-success btn-block " id="archive_backup"  onclick="backup()"><span class="btn btn-success btn-block mdi mdi-backup-restore"><i style="margin-right: 12px;">گرفتن فایل پشتیبانی</i></span></button>
   </div>
   <table id="example" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
      <thead>
      <tr>

         <th>نام</th>
         <th>اندازه</th>
         <th >تاریخ</th>
         <th >دایرکتوری</th>
         <th >عملیات</th>


      </tr>
      </thead>
      <tbody id="backup">
         @foreach($backups as $backup)

           <tr >
              <td>{{$backup['file_name']}}</td>
              <td>{{$backup['file_size']}}</td>
              <td>{{\Morilog\Jalali\Jalalian::fromDateTime($backup['last_modified'])->ago()}}</td>
              <td>{{$backup['file_path']}}</td>
              <td height="3%" class="text-center">
                 <a href="{{route('backup.download',$backup['file_name'])}}" ><span><i class="fa fa-download bk" ></i></span></a>
{{--                 <a href="javascript:void(0);"  id="del-backup" data-file-name="{{$backup['file_name']}}"><span><i class="fa fa-trash bk" ></i></span>{{csrf_field()}}</a>--}}
              </td>

           </tr>

            @endforeach

      </tbody>


   </table>
</div>

<script>

    function backup() {

        $('.loading').show();
         $.ajax({
             url:"{{route('backup.create')}}",
             method:'get',
             dataType:'json',
            timeoutSeconds:70000,
             success:function (data) {


               if(data.success){
                  $('.loading').hide();
                  getBackup();


               }



             },

             error:function (data) {

                if(!data.success){
                   $('.loading').hide();
                }

             }


         })

    }
   function delBackup(){

       $(document).on('click','#del-backup',function (event) {
           event.preventDefault();
          $('.loading').show();
         var file_name=$(this).data('file-name');
         var _token=$('input[name="_token"]').val();
          $.ajax({
             url:"{{route('backup.delete')}}",
             type:'delete',
             dataType: 'json',
             data:{_token:_token,file_name:file_name},
             success:function (data) {
                $('.loading').hide();

               getBackup();


             },
             error:function (data) {

              alert('the backup can not delete have a problem');
             }

          })

       })


    }
    function getBackup(){

       $.ajax({
          url:'{{route('backup.getBackup')}}',
          type:'get',
          success:function (data) {
            $('#backup').html(data);
          },
          error:function (data) {
             alert('bad');
          }

       })

    }
    $(document).ready(function () {

       delBackup();

    })

</script>

