<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Artisan;
use Morilog\Jalali\Jalalian;
use phpDocumentor\Reflection\Types\Void_;
use Spatie\Backup\Helpers\Format;
use Storage;


class BackupController extends Controller
{

    public function index(Request $request)
    {
        $disk=Storage::disk(config('backup.backup.destination.disks')[0]);
        $files=$disk->files(config('backup.backup.name'));
        $backups=[];
        foreach ($files as $k=>$f){
            if(substr($f,-4)=='.zip' && $disk->exists($f)){
               $backups[]=[
                   'file_path'=>$f,
                   'file_name'=>str_replace(config('backup.backup.name').'/','',$f),
                   'file_size'=>Format::humanReadableSize($disk->size($f)),
                   'last_modified'=>Carbon::createFromTimestamp($disk->lastModified($f))
               ];


            }

        }
        $backups=array_reverse($backups);

           return view('backup.backup',compact('backups'))->with(['panel_title'=>'بکاب از کل دتابس']);


    }

    public function getBackup()
    {
        $disk=Storage::disk(config('backup.backup.destination.disks')[0]);
        $files=$disk->files(config('backup.backup.name'));
        $backups=[];
        foreach ($files as $k=>$f){
            if(substr($f,-4)=='.zip' && $disk->exists($f)){
                $backups[]=[
                    'file_path'=>$f,
                    'file_name'=>str_replace(config('backup.backup.name').'/','',$f),
                    'file_size'=>Format::humanReadableSize($disk->size($f)),
                    'last_modified'=>Carbon::createFromTimestamp($disk->lastModified($f))
                ];


            }

        }
        $backups=array_reverse($backups);
        $output='';
        foreach ($backups as $backup){
            $output.='<tr>';
            $output.='<td>'.$backup['file_name'].'</td>';
            $output.='<td>'.$backup['file_size'].'</td>';
            $output.='<td>'.Jalalian::fromDateTime($backup['last_modified'])->ago().'</td>';
            $output.='<td>'.$backup['file_path'].'</td>';
            $output.='<td><a href="'.route('backup.download',$backup['file_name']).'" ><span><i class="fa fa-download bk"></i></span></a><a href="javascript:void(0);"  id="del-backup" data-file-name="'.$backup['file_name'].'" ><span><i class="fa fa-trash bk" style="margin-right: 8px;" ></i></span>'.csrf_field().'</a></td></tr>';

        }

        echo $output;
    }

    public function create()
    {

        try{

        Artisan::call('backup:run',['--only-db'=>true]);
      $output =Artisan::output();

            return array(
                'success'=>true,
                'output'=>$output,
            );

        }catch (\Exception $exception){



           return array(
               'success'=>false,
               'msg'=>$exception->getMessage(),
           );

        }

    }

    public function download($file_name)
    {


        $file=config('backup.backup.name').'/'.$file_name;



        $disk=Storage::disk(config('backup.backup.destination.disks')[0]);
        if($disk->exists($file)){


            return \Illuminate\Support\Facades\Storage::download($file);
            $fs=Storage::disk(config('backup.backup.destination.disks')[0])->getDriver();

            $stream=$fs->readStream($file);

            return \Response::stream(function () use ($stream){
               fpassthru($stream);
            }
            ,200,[
                'content-type'=>$fs->getMimetype($file),
                'content-length'=>$fs->getSize($file),
                'content-disposition'=>"attachment; filename=\"" .basename($file)."\"",
                ]);

        }else{
            abort('404','can not download');
        }
    }

    public function delete(Request $request)
    {
        $file_name=$request->get('file_name');
        $disk =Storage::disk(config('backup.backup.destination.disks')[0]);
        if($disk->exists(config('backup.backup.name').'/'.$file_name)){

            if($disk->delete(config('backup.backup.name').'/'.$file_name)) {


                return array(
                    'success' => true,
                    'msg' => 'به صورت موفقانه حذف گردید!',
                    'url'=>route('backup.index'),
                );
            }else{
                    return array(
                        'success' => false,
                        'msg' => 'مشکلی برای جذف وجود دارد',
                    );

                }
        }
    }
}
