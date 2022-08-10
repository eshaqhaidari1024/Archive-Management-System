<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ArchDepartment extends Controller
{

    public function index($id=null)
    {

       if(isset($id) && $id >0){

           $departments=\DB::table('departments')->where('status','=',0)->paginate($id);
       }else{

           $departments=\DB::table('departments')->where('status','=',0)->paginate(10);
       }


        return view('department.index',compact('departments'))->with(['panel_title'=>'لیست بخش ها','route'=>route('dep.list')]);
    }

    public function create(Request  $request)
    {
        if($request->isMethod('get')){


            return view('department.form')->with(['panel_title'=>'ایجاد بخش']);

        }else{


          $validator =Validator::make($request->all(),[

              'arch-dep'=>'required',
          ]);

          if($validator->fails()){

              return  array(
                  'fail'=>true,
                  'errors'=>$validator->getMessageBag()->toArray(),
              );
          }else{


              

              if(\App\Models\ArchDepartment::where('dep_name',$request->get('arch-dep'))->exists()){

                return array(
                    'exist'=>true,
                );
              }else{
                $department=new \App\Models\ArchDepartment();
                $department->dep_name=$request->get('arch-dep');
                $department->status=0;
                $department->save();
                return  array(
                    'content'=>'content',
                    'url'=>route('dep.list'),
                );   

              }
              
              
          }




        }
    }

    public function update(Request  $request , $id)
    {
        $department=\App\Models\ArchDepartment::find($id);


        if($request->isMethod('get')){


            return view('department.form',compact('department'))->with(['panel_title'=>'ویرایش بخش']);
        }else{

            $validator=Validator::make($request->all(),[
                'arch-dep'=>'required',
            ]);
            if($validator->fails()){


                return  array(
                    'fail'=>true,
                    'errors'=>$validator->getMessageBag()->toArray(),
                );
            }else{


                $department->dep_name=$request->get('arch-dep');
                $department->status=0;

                $department->save();
                Session::put('msg_status', true);

                return  array(
                    'content'=>'content',
                    'url'=>route('dep.list'),
                );
            }
        }

    }

    public function delete( $id)
    {

        $department=\App\Models\ArchDepartment::find($id);


        $department->delete();


        return redirect()->route('dep.list')->with('success','به صورت موفقانه حذف گردید');
    }
}
