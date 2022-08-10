<?php

namespace App\Http\Controllers\Admin;

use App\Models\Currency;
use App\Models\Option;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\DocBlock\Tags\Method;

class OptionsController extends Controller
{
    public function general(Request $request)
    {

        $currencies = Currency::all()->where("status","0");
        $stores = Store::all()->where("status","0");
        if ($request->isMethod("get")) {
            return view('options.general',compact('currencies','stores'))->with(['panel_title' => "تنظمیات اصلی"]);

        } else {


            $arr = $request->input();
            foreach ($arr as $key => $value){

                if($key == '_token')
                    continue;
                $re = \DB::table("options")->where("option_name","=",$key)->update([
                    'option_value' => $value
                ]);

            }

            return array(
                'content' => 'content',
                'url' => route('options.general')
            );

        }
    }
    public function personality(Request $request)
    {

        $currencies = Currency::all()->where("status","0");
        if ($request->isMethod("get")) {
            return view('options.personality',compact('currencies'))->with(['panel_title' => "تنظمیات اطلاعات شرکت"]);

        } else {


            $arr = $request->input();


            foreach ($arr as $key => $value){




                    if($key == '_token')
                        continue;
                if ($value){

                    $re = \DB::table("options")->where("option_name","=",$key)->update([
                        'option_value' => $value
                    ]);

                }else{
                    $re = \DB::table("options")->where("option_name","=",$key)->update([
                        'option_value' => ""
                    ]);
                }

            }

            return array(
                'content' => 'content',
                'url' => route('options.personality')
            );

        }
    }

    public function LogoUploading(Request $request) {



        $this->validate($request, [
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {

            $image = $request->file('logo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);

            $lastUploadAddress = "images/".$name;

            $re = \DB::table("options")->where("option_name","=",'CompanyLogo')->update([
                'option_value' => $lastUploadAddress
            ]);

            return array(
                'url' =>$lastUploadAddress
            );
        }
    }

}
