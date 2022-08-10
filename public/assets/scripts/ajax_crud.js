
$(document).on('submit','form#frm',function (e) {

    e.preventDefault();
    var form =$(this);
    var url =form.attr('action');
    var data =new FormData($(this)[0]);

    $.ajax({
        type:form.attr('method'),
        url:url,
        data:data,
        catch:false,
        contentType:false,
        processData:false,
        success:function(data){

            $('.is-invalid').removeClass('is-invalid');
            if(data.fail){

                for(country in data.errors){

                    $('#'+country).addClass('is-invalid');
                    $('#error-'+country).html(data.errors[country]);
                    $('#error-'+country).css('color','red');
                    $('#'+country).css('border','solid 1px red')
                }
            }else{

                ajaxLoad(data.redirect_url);

            }

        },
        error:function (xhr,textStatus,errorThrown) {

            alert("Error:"+errorThrown);

        }

    })
    return false;
});

function ajaxLoad(filename){

    /*content=typeof content!=='undefined'? content:'';*/

    $.ajax({

       type: 'GET',
       url:filename,
       contentType: false,
       success:function (data) {
            $('#tbcontent').html(data)

           
       } ,
        error:function (xhr,status,eror) {
            alert(xhr.responseText);
        }

    });
}
function ajaxDelete(filename,token){

    $.ajax({
        type:'POST',
        url:filename,
        data: {_method:'delete', _token:token},
        success:function(data){
            $('#tbcontent').html(data);
        },
        error:function (xhr,status,error){

            alert("errror",xhr.responseText);
        }

    })


}