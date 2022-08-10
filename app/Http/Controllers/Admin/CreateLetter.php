<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CreateLetterExport;
use App\Imports\CreateLetterImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Morilog\Jalali\Jalalian;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class CreateLetter extends Controller
{

    public function index($id=null)
    {

        if(isset($id) && $id >0){

            $letters = DB::table('letter')->paginate($id);

        }else{
            $letters = DB::table('letter')->paginate(10);
        }

        return view('letter.index', compact('letters'))->with(['panel_title' => 'لیست مکاتیب','route'=>route('letter.list')]);
    }


    public function export(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new CreateLetterExport(), 'CreateLetter.xlsx');
    }


    public function import(): \Illuminate\Http\RedirectResponse
    {
        Excel::import(new CreateLetterImport() ,request()->file('file'));

        return back();
    }

    public function create(Request $request)
    {

        if ($request->isMethod('get')) {

            return view('letter.form')->with(['panel_title' => 'ایجاد مکتوب جدید']);
        } else {



            $validator = Validator::make($request->all(), [
                'arch-type' => 'required',
                'arch-date' => 'required',
                'arch-date-register' => 'required',
                'arch-no' => 'required',
                'arch-letter-no' => 'required',
                'arch-title' => 'required',
                'arch-photo' => 'required',
                'arch-from' => 'required',
                'arch-to' => 'required',
                'arch-ejraat' => 'required',



            ]);
            if ($validator->fails()) {


                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray(),
                );
            } else {

                $arch_date=explode('-',$request->get('arch-date'));
                $arch_date=array_reverse($arch_date);
                $arch_date=implode('/',$arch_date);
                $arch_date_reg=explode('-',$request->get('arch-date-register'));
                $arch_date_reg=array_reverse($arch_date_reg);
                $arch_date_reg=implode('/',$arch_date_reg);

                $createLetter = new \App\Models\CreateLetter();

                $createLetter->arch_type = $request->get('arch-type');
                $createLetter->arch_date = $arch_date;
                $createLetter->name=$request->get('name');
                $createLetter->last_name=$request->get('last-name');

                $createLetter->arch_date_register = $arch_date_reg;
                $arch_no = $createLetter->arch_no = $request->get('arch-no');
                $createLetter->arch_letter_no = $request->get('arch-letter-no');

                $createLetter->arch_from = $request->get('arch-from');
                $createLetter->arch_title = $request->get('arch-title');
                $createLetter->arch_to = $request->get('arch-to');
                $createLetter->arch_ejraat = $request->get('arch-ejraat');

                if($request->get('send-to-makhzan')!=null){

                    $createLetter->arch_makhzan=1;

                }

                $createLetter->user_id=Auth::user()->id;
                /*photo upload save*/
                // $image = $createLetter->arch_photo = $request->file('arch-photo');
                // $imageName = time().'.' . $image->getClientOriginalExtension();
                // $fullAddressImage = $image->move(public_path('images'), $imageName);
                // $createLetter->arch_photo = $imageName;

                // upload photo in storate path
                if($request->hasFile('arch-photo')){

                    $image =$request->file('arch-photo');
                    $destination_path='public/images/letter';
                    $imageName = time().'.'.$image->getClientOriginalExtension();
                    $path=$request->file('arch-photo')->storeAs($destination_path,$imageName);
                    $createLetter->arch_photo=$imageName;

                }

                $createLetter->save();


                return array(
                    'content' => 'content',
                    'url' => route('letter.list'),
                );

            }
        }
    }

    public function update(Request $request, $id)
    {

        $letter = \App\Models\CreateLetter::find($id);
        if ($request->isMethod('get')) {

            return view('letter.form', compact('letter'))->with(['panel_title' => 'ویرایش مکتوب']);
        }
        else {


            $validator = Validator::make($request->all(), [
                'arch-type' => 'required',
                'arch-date' => 'required',
                'arch-date-register' => 'required',
                'arch-no' => 'required',
                'arch-letter-no' => 'required',
                'arch-title' => 'required',
                'arch-photo' => 'required',
                'arch-from' => 'required',
                'arch-to' => 'required',
                'arch-ejraat' => 'required',




            ]);
            if ($validator->fails()) {


                return array(
                    'fail' => true,
                    'errors' => $validator->getMessageBag()->toArray(),
                );
            } else {


                $createLetter =\App\Models\CreateLetter::find($id);

                $createLetter->arch_type = $request->get('arch-type');
                $createLetter->arch_date = $request->get('arch-date');
                $createLetter->name=$request->get('name');
                $createLetter->last_name=$request->get('last-name');
                $createLetter->arch_date_register = $request->get('arch-date-register');
                $arch_no = $createLetter->arch_no = $request->get('arch-no');
                $createLetter->arch_letter_no = $request->get('arch-letter-no');

                $createLetter->arch_from = $request->get('arch-from');
                $createLetter->arch_title = $request->get('arch-title');
                $createLetter->arch_to = $request->get('arch-to');
                $createLetter->arch_ejraat = $request->get('arch-ejraat');

                if($request->get('send-to-makhzan')!=null){

                    $createLetter->arch_makhzan=1;

                }else{
                    $createLetter->arch_makhzan=0;
                }
                $createLetter->user_id=Auth::user()->id;

                /*photo upload save*/
                if($request->hasFile('arch-photo')){

                    $image =$request->file('arch-photo');
                    $destination_path='public/images/letter';
                    $imageName = time().'.'.$image->getClientOriginalExtension();
                    $path=$request->file('arch-photo')->storeAs($destination_path,$imageName);
                    $createLetter->arch_photo=$imageName;

                }


//                $oldImage=public_path().'/images/'.$createLetter->arch_photo;
//                    unlink($oldImage);
                $createLetter->save();


                return array(
                    'content' => 'content',
                    'url' => route('letter.list'),
                );

            }
        }


    }

    public function singleLetter(Request $request, $id)
    {

        $singleLetter = \App\Models\CreateLetter::find($id);

        return view('letter.single', compact('singleLetter'))->with(['panel_title' => 'جزئیات مکتوب']);
    }

    public function delete($id)
    {


        if(isset($id)){

            $letter=\App\Models\CreateLetter::find($id);
//            $image_path = public_path() . '/storage/images/letter/' . $letter->arch_photo;
//            if(file_exists($image_path)){
//
//                if(unlink($image_path)){
//
//                    $letter->delete();
//                    return redirect()->route('letter.list')->with('success','به صورت موفقانه حذف گردید');
//        }
//    }

            $letter->delete();

        }
    }

    public function search($id)
    {
        $data=explode(',',$id);

        $data = \DB::table('letter')
            ->select('letter.id', 'letter.arch_title', 'letter.arch_no','letter.name','letter.last_name', 'letter.arch_letter_no','letter.arch_from','letter.arch_to','letter.arch_date','letter.arch_date_register')
            ->where('letter.arch_letter_no', 'LIKE', "%$data[0]%")
            ->Where('letter.arch_no', 'LIKE', "%$data[1]%")
            ->Where('letter.arch_title', 'LIKE', "%$data[2]%")
//            ->Where('letter.arch_letter_no', 'LIKE', "$id%")
//            ->orWhere('letter.arch_from', 'LIKE', "%$id%")
//            ->orWhere('letter.arch_to', 'LIKE', "%$id%")
//            ->orWhere('letter.arch_type', 'LIKE', "%$id%")
//            ->orWhere('letter.name', 'LIKE', "%$id%")
//            ->orWhere('letter.last_name', 'LIKE', "%$id%")
            ->get();


        if (count($data) > 0) {
            return response(array(
                'data' => $data
            ));
        }else{

            return  response(array(
                'data'=>false,
            ));
        }
    }

    public function removeImage(Request  $request)
    {


        $id=$request->get('id');

        $image = \App\Models\CreateLetter::find($id);


        $image_path = public_path() . '/storage/images/letter/' . $image->arch_photo;

        if(!file_exists($image_path)){

            return array(
                'file_null'=>true,
            );
        }else{
            if(unlink($image_path)){

                return array(
                    'deleted'=>true,
                );
            }
        }



    }



    public function getDownload($id)
    {

        $file=\App\Models\CreateLetter::find($id);
        $filename=public_path().'/storage/images/letter/'.$file->arch_photo;

        return Response::download($filename);
    }

    public function getData(Request  $request)
    {
        $fieldName = $request->get('fieldName');
        $name=$request->get('name');
        $department=DB::table('departments')
            ->select('departments.dep_name','departments.id')
            ->where("$fieldName",'LIKE','%'.$name.'%')
            ->get();

        return $department;
    }

    public function report(){

        return view('letter.report');
    }

    public function getReport(Request $request, $id = null)
    {
        if ($request->ajax()) {



            $output = '';
            $data = '';
            $sum = 0;
            $store_id = $request->get('letter_name');
            $type = $request->get('type');
            $y = $request->get('year');


            if ($store_id === 'all') {
                if (isset($id) && $id > 0) {
                    $data = \DB::table('letter')
                        ->select('letter.id', 'letter.name', 'letter.last_name', 'letter.arch_no', 'letter.arch_date_register','letter.arch_letter_no','letter.arch_date','letter.arch_title')
                        ->paginate($id);
                } else {
                    $data = \DB::table('letter')
                        ->select('letter.id', 'letter.name', 'letter.last_name', 'letter.arch_no', 'letter.arch_date_register','letter.arch_letter_no','letter.arch_date','letter.arch_title')
                        ->paginate(10);


                }
                // $sum = \DB::table('sale_factor')
                //     ->sum('total_price');
                if ($type === 'day') {
                    $jyear = Jalalian::fromCarbon(Carbon::now())->getYear();
                    $jmonth = Jalalian::fromCarbon(Carbon::now())->getMonth();
                    $jday = Jalalian::fromCarbon(Carbon::now())->getDay();
                    $jdate = '';
                    if ($jmonth < 10 && $jday > 9) {
                        $jdate = $jyear . '-0' . $jmonth . '-' . $jday;
                    } elseif ($jday < 10 && $jmonth > 9) {
                        $jdate = $jyear . '-' . $jmonth . '-0' . $jday;

                    } elseif ($jmonth < 10 && $jday < 10) {
                        $jdate = $jyear . '-0' . $jmonth . '-0' . $jday;
                    } else {
                        $jdate = $jyear . '-' . $jmonth . '-' . $jday;
                    }

                    if (\Auth::user()->user_level ==\App\Models\User::MANAGER || \Illuminate\Support\Facades\Auth::user()->user_level==\App\Models\User::ADMIN || \Illuminate\Support\Facades\Auth::user()->user_level==\App\Models\User::USER) {

                        if (isset($id) && $id > 0) {
                            $data = \DB::table('letter')
                                ->select('letter.id', 'letter.name', 'letter.last_name', 'letter.arch_no', 'letter.arch_date_register','letter.arch_letter_no','letter.arch_date','letter.arch_title')
                                ->where('letter.arch_date_register', $jdate)
                                ->paginate($id);
                        } else {
                            $data = \DB::table('letter')
                                ->select('letter.id', 'letter.name', 'letter.last_name', 'letter.arch_no', 'letter.arch_date_register','letter.arch_letter_no','letter.arch_date','letter.arch_title')
                                ->where('letter.arch_date_register', $jdate)
                                ->paginate(10);
                        }

                    }

                    // } else {
                    //     if (isset($id) && $id > 0) {
                    //         $data = \DB::table('sale_factor')
                    //             ->join('store', 'sale_factor.store_id', '=', 'store.store_id')
                    //             ->select('sale_factor_id', 'sale_factor_code', 'recieption_price', 'total_price', 'sale_date')
                    //             ->where('store.agency_id', '=', \Auth::user()->agency_id)
                    //             ->where('sale_date', $jdate)
                    //             ->paginate($id);
                    //     } else {
                    //         $data = \DB::table('sale_factor')
                    //             ->join('store', 'sale_factor.store_id', '=', 'store.store_id')
                    //             ->select('sale_factor_id', 'sale_factor_code', 'recieption_price', 'total_price', 'sale_date')
                    //             ->where('store.agency_id', '=', \Auth::user()->agency_id)
                    //             ->where('sale_date', $jdate)
                    //             ->paginate(5);
                    //     }
                    // }

                    // $sum = \DB::table('sale_factor')
                    //     ->where('sale_date', $jdate)
                    //     ->sum('total_price');

                } elseif ($type === 'week') {
                    $year = Jalalian::fromCarbon(Carbon::now())->getYear();
                    $month = Jalalian::fromCarbon(Carbon::now())->getMonth();
                    $day = Jalalian::fromCarbon(Carbon::now())->getDay();
                    $date = '';
                    if ($month < 10 && $day > 9) {
                        $date = $year . '-0' . $month . '-' . $day;
                    } elseif ($day < 10 && $month > 9) {
                        $date = $year . '-' . $month . '-0' . $day;

                    } elseif ($month < 10 && $day < 10) {
                        $date = $year . '-0' . $month . '-0' . $day;
                    } else {
                        $date = $year . '-' . $month . '-' . $day;
                    }


                    $jyear = Jalalian::fromCarbon(Carbon::now())->getYear();
                    $jmonth = Jalalian::fromCarbon(Carbon::now())->getMonth();
                    $jday = Jalalian::fromCarbon(Carbon::now())->getDay();

                    $dayofweek = Jalalian::fromCarbon(Carbon::now())->getDayOfWeek();

                    switch ($dayofweek) {
                        case 0:
                            $jday = $jday;
                            break;
                        case 1:
                            $jday = $jday - 1;
                            break;
                        case 2:
                            $jday = $jday - 2;
                            break;
                        case 3:
                            $jday = $jday - 3;
                            break;
                        case 4:
                            $jday = $jday - 4;
                            break;
                        case 5:
                            $jday = $jday - 5;
                            break;
                        case 6:
                            $jday = $jday - 6;
                            break;

                    }
                    $jdate = '';
                    if ($jmonth < 10 && $jday > 9) {
                        $jdate = $jyear . '-0' . $jmonth . '-' . $jday;
                    } elseif ($jday < 10 && $jmonth > 9) {
                        $jdate = $jyear . '-' . $jmonth . '-0' . $jday;

                    } elseif ($jmonth < 10 && $jday < 10) {
                        $jdate = $jyear . '-0' . $jmonth . '-0' . $jday;
                    } else {
                        $jdate = $jyear . '-' . $jmonth . '-' . $jday;
                    }

                    if (\Auth::user()->user_level ==\App\Models\User::MANAGER || \Illuminate\Support\Facades\Auth::user()->user_level==\App\Models\User::ADMIN || \Illuminate\Support\Facades\Auth::user()->user_level==\App\Models\User::USER) {
                        if (isset($id) && $id > 0) {
                            $data = \DB::table('letter')
                                ->select('letter.id', 'letter.name', 'letter.last_name', 'letter.arch_no', 'letter.arch_date_register','letter.arch_letter_no','letter.arch_date','letter.arch_title')
                                ->whereBetween('arch_date_register', [$jdate, $date])
                                ->paginate($id);
                        } else {
                            $data = \DB::table('letter')
                                ->select('letter.id', 'letter.name', 'letter.last_name', 'letter.arch_no', 'letter.arch_date_register','letter.arch_letter_no','letter.arch_date','letter.arch_title')
                                ->whereBetween('arch_date_register', [$jdate, $date])
                                ->paginate(10);
                        }
                    }
                    //  else {
                    //     if (isset($id) && $id > 0) {
                    //         $data = \DB::table('sale_factor')
                    //             ->join('store', 'sale_factor.store_id', '=', 'store.store_id')
                    //             ->select('sale_factor_id', 'sale_factor_code', 'recieption_price', 'total_price', 'sale_date')
                    //             ->where('store.agency_id', '=', \Auth::user()->agency_id)
                    //             ->whereBetween('sale_date', [$jdate, $date])
                    //             ->paginate($id);
                    //     } else {
                    //         $data = \DB::table('sale_factor')
                    //             ->join('store', 'sale_factor.store_id', '=', 'store.store_id')
                    //             ->select('sale_factor_id', 'sale_factor_code', 'recieption_price', 'total_price', 'sale_date')
                    //             ->where('store.agency_id', '=', \Auth::user()->agency_id)
                    //             ->whereBetween('sale_date', [$jdate, $date])
                    //             ->paginate(5);
                    //     }
                    // }

                    // $sum = \DB::table('sale_factor')
                    //     ->whereBetween('sale_date', [$jdate, $date])
                    //     ->sum('total_price');

                } elseif ($type === 'month') {
                    $get_month = $request->get('month_r');

                    if (ctype_digit($get_month)) {
                        $jyear = Jalalian::fromCarbon(Carbon::now())->getYear();
                        $jmonth = $get_month;
                        $jday = '1';
                        $start_date = '';
                        if ($jmonth < 10 && $jday > 9) {
                            $start_date = $jyear . '-0' . $jmonth . '-' . $jday;
                        } elseif ($jday < 10 && $jmonth > 9) {
                            $start_date = $jyear . '-' . $jmonth . '-0' . $jday;

                        } elseif ($jmonth < 10 && $jday < 10) {
                            $start_date = $jyear . '-0' . $jmonth . '-0' . $jday;
                        } else {
                            $start_date = $jyear . '-' . $jmonth . '-' . $jday;
                        }
                        // end date
                        $end_date = '';
                        $end_day = '31';
                        if ($jmonth < 10 && $end_day > 9) {
                            $end_date = $jyear . '-0' . $jmonth . '-' . $end_day;
                        } elseif ($end_day < 10 && $jmonth > 9) {
                            $end_date = $jyear . '-' . $jmonth . '-0' . $end_day;

                        } elseif ($jmonth < 10 && $end_day < 10) {
                            $end_date = $jyear . '-0' . $jmonth . '-0' . $end_day;
                        } else {
                            $end_date = $jyear . '-' . $jmonth . '-' . $end_day;
                        }

                        if (\Auth::user()->user_level ==\App\Models\User::MANAGER || \Illuminate\Support\Facades\Auth::user()->user_level==\App\Models\User::ADMIN || \Illuminate\Support\Facades\Auth::user()->user_level==\App\Models\User::USER) {
                            if (isset($id) && $id > 0) {
                                $data = \DB::table('letter')
                                    ->select('letter.id', 'letter.name', 'letter.last_name', 'letter.arch_no', 'letter.arch_date_register','letter.arch_letter_no','letter.arch_date','letter.arch_title')
                                    ->whereBetween('arch_date_register', [$start_date, $end_date])
                                    //->where('expens_reason_id', $reason)
                                    ->paginate($id);
                            } else {

                                $data = \DB::table('letter')
                                    ->select('letter.id', 'letter.name', 'letter.last_name', 'letter.arch_no', 'letter.arch_date_register','letter.arch_letter_no','letter.arch_date','letter.arch_title')
                                    ->whereBetween('arch_date_register', [$start_date, $end_date])
                                    //->where('expens_reason_id', $reason)
                                    ->paginate(10);
                            }
                        }
                        // else {
                        //     if (isset($id) && $id > 0) {
                        //         $data = \DB::table('sale_factor')
                        //             ->join('store', 'sale_factor.store_id', '=', 'store.store_id')
                        //             ->select('sale_factor_id', 'sale_factor_code', 'recieption_price', 'total_price', 'sale_date')
                        //             ->where('store.agency_id', '=', \Auth::user()->agency_id)
                        //             ->whereBetween('sale_date', [$start_date, $end_date])
                        //             //->where('expens_reason_id', $reason)
                        //             ->paginate($id);
                        //     } else {

                        //         $data = \DB::table('sale_factor')
                        //             ->join('store', 'sale_factor.store_id', '=', 'store.store_id')
                        //             ->select('sale_factor_id', 'sale_factor_code', 'recieption_price', 'total_price', 'sale_date')
                        //             ->where('store.agency_id', '=', \Auth::user()->agency_id)
                        //             ->whereBetween('sale_date', [$start_date, $end_date])
                        //             //->where('expens_reason_id', $reason)
                        //             ->paginate(5);
                        //     }
                        // }


                        // $sum = \DB::table('sale_factor')
                        //     ->whereBetween('sale_date', [$start_date, $end_date])
                        //     //->where('expens_reason_id', $reason)
                        //     ->sum('total_price');
                    }
                } elseif ($type === 'year') {

                    $getyear = $request->get('year_r');


                    $yaer_date = explode('/', $getyear);

                    $final_year = $yaer_date[0];

                    $startfrom = $final_year . '-01-01';

                    $end = $final_year . '-12-31';



                    if (\Auth::user()->user_level == 1) {
                        if (isset($id) && $id > 0) {
                            $data = \DB::table('letter')
                                ->select('letter.id', 'letter.name', 'letter.last_name', 'letter.arch_no', 'letter.arch_date_register','letter.arch_letter_no','letter.arch_date','letter.arch_title')
                                ->whereBetween('letter.arch_date_register', [$startfrom, $end])
                                ->paginate($id);
                        } else {
                            $data = \DB::table('letter')
                                ->select('letter.id', 'letter.name', 'letter.last_name', 'letter.arch_no', 'letter.arch_date_register','letter.arch_letter_no','letter.arch_date','letter.arch_title')
                                ->whereBetween('letter.arch_date_register', [$startfrom, $end])
                                ->paginate(10);
                        }
                    }
                    // else {
                    //     if (isset($id) && $id > 0) {
                    //         $data = \DB::table('sale_factor')
                    //             ->join('store', 'sale_factor.store_id', '=', 'store.store_id')
                    //             ->select('sale_factor_id', 'sale_factor_code', 'recieption_price', 'total_price', 'sale_date')
                    //             ->where('store.agency_id', '=', \Auth::user()->agency_id)
                    //             ->whereBetween('sale_date', [$startfrom, $end])
                    //             ->paginate($id);
                    //     } else {
                    //         $data = \DB::table('sale_factor')
                    //             ->join('store', 'sale_factor.store_id', '=', 'store.store_id')
                    //             ->select('sale_factor_id', 'sale_factor_code', 'recieption_price', 'total_price', 'sale_date')
                    //             ->where('store.agency_id', '=', \Auth::user()->agency_id)
                    //             ->whereBetween('sale_date', [$startfrom, $end])
                    //             ->paginate(5);
                    //     }
                    // }

                    // $sum = \DB::table('sale_factor')
                    //     ->whereBetween('sale_date', [$startfrom, $end])
                    //     ->sum('total_price');

                } elseif ($type === 'bt_date') {

                    if ($request->get('start_date') != '') {
                        $start_date = $request->get('start_date');
                        $end_date = $request->get('end_date');

                        if (\Auth::user()->user_level ==\App\Models\User::MANAGER || \Illuminate\Support\Facades\Auth::user()->user_level==\App\Models\User::ADMIN || \Illuminate\Support\Facades\Auth::user()->user_level==\App\Models\User::USER) {
                            if (isset($id) && $id > 0) {
                                $data = \DB::table('letter')
                                    ->select('letter.id', 'letter.name', 'letter.last_name', 'letter.arch_no', 'letter.arch_date_register','letter.arch_letter_no','letter.arch_date','letter.arch_title')
                                    ->whereBetween('arch_date_register', [$start_date, $end_date])
                                    ->paginate($id);
                            } else {
                                $data = \DB::table('letter')
                                    ->select('letter.id', 'letter.name', 'letter.last_name', 'letter.arch_no', 'letter.arch_date_register','letter.arch_letter_no','letter.arch_date','letter.arch_title')
                                    ->whereBetween('arch_date_register', [$start_date, $end_date])
                                    ->paginate(10);
                            }
                        }
                        // else {
                        //     if (isset($id) && $id > 0) {
                        //         $data = \DB::table('sale_factor')
                        //             ->join('store', 'sale_factor.store_id', '=', 'store.store_id')
                        //             ->select('sale_factor_id', 'sale_factor_code', 'recieption_price', 'total_price', 'sale_date')
                        //             ->where('store.agency_id', '=', \Auth::user()->agency_id)
                        //             ->whereBetween('sale_date', [$start_date, $end_date])
                        //             ->paginate($id);
                        //     } else {
                        //         $data = \DB::table('sale_factor')
                        //             ->join('store', 'sale_factor.store_id', '=', 'store.store_id')
                        //             ->select('sale_factor_id', 'sale_factor_code', 'recieption_price', 'total_price', 'sale_date')
                        //             ->where('store.agency_id', '=', \Auth::user()->agency_id)
                        //             ->whereBetween('sale_date', [$start_date, $end_date])
                        //             ->paginate(5);
                        //     }
                        // }

                        // $sum = \DB::table('sale_factor')
                        //     ->whereBetween('sale_date', [$start_date, $end_date])
                        //     ->sum('total_price');

                    }

                }
            } else {
                if (is_string($store_id)) {


                    if ($type === 'day') {
                        $jyear = Jalalian::fromCarbon(Carbon::now())->getYear();
                        $jmonth = Jalalian::fromCarbon(Carbon::now())->getMonth();
                        $jday = Jalalian::fromCarbon(Carbon::now())->getDay();
                        $jdate = '';
                        if ($jmonth < 10 && $jday > 9) {
                            $jdate = $jyear . '-0' . $jmonth . '-' . $jday;
                        } elseif ($jday < 10 && $jmonth > 9) {
                            $jdate = $jyear . '-' . $jmonth . '-0' . $jday;

                        } elseif ($jmonth < 10 && $jday < 10) {
                            $jdate = $jyear . '-0' . $jmonth . '-0' . $jday;
                        } else {
                            $jdate = $jyear . '-' . $jmonth . '-' . $jday;
                        }

                        if (isset($id) && $id > 0) {
                            $data = \DB::table('letter')
                                ->select('letter.id', 'letter.name', 'letter.last_name', 'letter.arch_no', 'letter.arch_date_register','letter.arch_letter_no','letter.arch_date','letter.arch_title')
                                ->where('letter.arch_type', $store_id)
                                ->where('letter.arch_date_register', $jdate)
                                ->paginate($id);
                        } else {
                            $data = \DB::table('letter')
                            ->select('letter.id', 'letter.name', 'letter.last_name', 'letter.arch_no', 'letter.arch_date_register','letter.arch_letter_no','letter.arch_date','letter.arch_title')
                            ->where('letter.arch_type',$store_id)
                            ->where('letter.arch_date_register',$jdate)
                                ->paginate(10);
                        }

                        // $sum = \DB::table('sale_factor')
                        //     ->where('sale_factor.store_id', $store_id)
                        //     ->where('sale_date', $jdate)
                        //     ->sum('total_price');


                    } elseif ($type === 'week') {
                        $year = Jalalian::fromCarbon(Carbon::now())->getYear();
                        $month = Jalalian::fromCarbon(Carbon::now())->getMonth();
                        $day = Jalalian::fromCarbon(Carbon::now())->getDay();
                        $date = '';
                        if ($month < 10 && $day > 9) {
                            $date = $year . '-0' . $month . '-' . $day;
                        } elseif ($day < 10 && $month > 9) {
                            $date = $year . '-' . $month . '-0' . $day;

                        } elseif ($month < 10 && $day < 10) {
                            $date = $year . '-0' . $month . '-0' . $day;
                        } else {
                            $date = $year . '-' . $month . '-' . $day;
                        }


                        $jyear = Jalalian::fromCarbon(Carbon::now())->getYear();
                        $jmonth = Jalalian::fromCarbon(Carbon::now())->getMonth();
                        $jday = Jalalian::fromCarbon(Carbon::now())->getDay();

                        $dayofweek = Jalalian::fromCarbon(Carbon::now())->getDayOfWeek();

                        switch ($dayofweek) {
                            case 0:
                                $jday = $jday;
                                break;
                            case 1:
                                $jday = $jday - 1;
                                break;
                            case 2:
                                $jday = $jday - 2;
                                break;
                            case 3:
                                $jday = $jday - 3;
                                break;
                            case 4:
                                $jday = $jday - 4;
                                break;
                            case 5:
                                $jday = $jday - 5;
                                break;
                            case 6:
                                $jday = $jday - 6;
                                break;

                        }
                        $jdate = '';
                        if ($jmonth < 10 && $jday > 9) {
                            $jdate = $jyear . '-0' . $jmonth . '-' . $jday;
                        } elseif ($jday < 10 && $jmonth > 9) {
                            $jdate = $jyear . '-' . $jmonth . '-0' . $jday;

                        } elseif ($jmonth < 10 && $jday < 10) {
                            $jdate = $jyear . '-0' . $jmonth . '-0' . $jday;
                        } else {
                            $jdate = $jyear . '-' . $jmonth . '-' . $jday;
                        }


                        if (isset($id) && $id > 0) {
                            $data = \DB::table('letter')
                            ->select('letter.id', 'letter.name', 'letter.last_name', 'letter.arch_no', 'letter.arch_date_register','letter.arch_letter_no','letter.arch_date','letter.arch_title')
                            ->where('letter.arch_type',$store_id)
                            ->where('letter.arch_date_register', [$jdate, $date])
                                ->paginate($id);
                        } else {
                            $data = \DB::table('letter')
                            ->select('letter.id', 'letter.name', 'letter.last_name', 'letter.arch_no', 'letter.arch_date_register','letter.arch_letter_no','letter.arch_date','letter.arch_title')
                            ->where('letter.arch_type',$store_id)
                            ->where('letter.arch_date_register', [$jdate, $date])
                                ->paginate(10);
                        }

                        // $sum = \DB::table('sale_factor')
                        //     ->where('sale_factor.store_id', $store_id)
                        //     ->whereBetween('sale_date', [$jdate, $date])
                        //     ->sum('total_price');


                    } elseif ($type === 'month') {

                        $get_month = $request->get('month_r');
                        if (ctype_digit($get_month)) {
                            $jyear = Jalalian::fromCarbon(Carbon::now())->getYear();
                            $jmonth = $get_month;
                            $jday = '1';
                            $start_date = '';
                            if ($jmonth < 10 && $jday > 9) {
                                $start_date = $jyear . '-0' . $jmonth . '-' . $jday;
                            } elseif ($jday < 10 && $jmonth > 9) {
                                $start_date = $jyear . '-' . $jmonth . '-0' . $jday;

                            } elseif ($jmonth < 10 && $jday < 10) {
                                $start_date = $jyear . '-0' . $jmonth . '-0' . $jday;
                            } else {
                                $start_date = $jyear . '-' . $jmonth . '-' . $jday;
                            }
                            // end date
                            $end_date = '';
                            $end_day = '31';
                            if ($jmonth < 10 && $end_day > 9) {
                                $end_date = $jyear . '-0' . $jmonth . '-' . $end_day;
                            } elseif ($end_day < 10 && $jmonth > 9) {
                                $end_date = $jyear . '-' . $jmonth . '-0' . $end_day;

                            } elseif ($jmonth < 10 && $end_day < 10) {
                                $end_date = $jyear . '-0' . $jmonth . '-0' . $end_day;
                            } else {
                                $end_date = $jyear . '-' . $jmonth . '-' . $end_day;
                            }

                            if (\Auth::user()->user_level ==\App\Models\User::MANAGER || \Illuminate\Support\Facades\Auth::user()->user_level==\App\Models\User::ADMIN || \Illuminate\Support\Facades\Auth::user()->user_level==\App\Models\User::USER) {
                                if (isset($id) && $id > 0) {
                                    $data = \DB::table('letter')
                                        ->select('letter.id', 'letter.name', 'letter.last_name', 'letter.arch_no', 'letter.arch_date_register','letter.arch_letter_no','letter.arch_date','letter.arch_title')
                                        ->where('arch_type',$store_id)
                                        ->whereBetween('arch_date_register', [$start_date, $end_date])
                                        //->where('expens_reason_id', $reason)
                                        ->paginate($id);
                                } else {

                                    $data = \DB::table('letter')
                                        ->select('letter.id', 'letter.name', 'letter.last_name', 'letter.arch_no', 'letter.arch_date_register','letter.arch_letter_no','letter.arch_date','letter.arch_title')
                                        ->where('arch_type',$store_id)
                                        ->whereBetween('arch_date_register', [$start_date, $end_date])
                                        //->where('expens_reason_id', $reason)
                                        ->paginate(10);
                                }
                            }
                            // else {
                            //     if (isset($id) && $id > 0) {
                            //         $data = \DB::table('sale_factor')
                            //             ->join('store', 'sale_factor.store_id', '=', 'store.store_id')
                            //             ->select('sale_factor_id', 'sale_factor_code', 'recieption_price', 'total_price', 'sale_date')
                            //             ->where('store.agency_id', '=', \Auth::user()->agency_id)
                            //             ->whereBetween('sale_date', [$start_date, $end_date])
                            //             //->where('expens_reason_id', $reason)
                            //             ->paginate($id);
                            //     } else {

                            //         $data = \DB::table('sale_factor')
                            //             ->join('store', 'sale_factor.store_id', '=', 'store.store_id')
                            //             ->select('sale_factor_id', 'sale_factor_code', 'recieption_price', 'total_price', 'sale_date')
                            //             ->where('store.agency_id', '=', \Auth::user()->agency_id)
                            //             ->whereBetween('sale_date', [$start_date, $end_date])
                            //             //->where('expens_reason_id', $reason)
                            //             ->paginate(5);
                            //     }
                            // }


                            // $sum = \DB::table('sale_factor')
                            //     ->whereBetween('sale_date', [$start_date, $end_date])
                            //     //->where('expens_reason_id', $reason)
                            //     ->sum('total_price');
                        }


                    } elseif ($type === 'year') {
                    $getyear = $request->get('year_r');
                    $yaer_date = explode('/', $getyear);
                    $final_year = $yaer_date[0];
                    $startfrom = $final_year . '-01-01';
                    $end = $final_year . '-12-31';

                        if (isset($id) && $id > 0) {
                            $data = \DB::table('letter')
                                ->select('letter.id', 'letter.name', 'letter.last_name', 'letter.arch_no', 'letter.arch_date_register','letter.arch_letter_no','letter.arch_date','letter.arch_title')
                                ->where('letter.arch_type',$store_id)
                                ->whereBetween('letter.arch_date_register', [$startfrom, $end])
                                ->paginate($id);
                        } else {
                            $data = \DB::table('letter')
                                ->select('letter.id', 'letter.name', 'letter.last_name', 'letter.arch_no', 'letter.arch_date_register','letter.arch_letter_no','letter.arch_date','letter.arch_title')
                                ->where('letter.arch_type',$store_id)
                                ->whereBetween('letter.arch_date_register', [$startfrom, $end])
                                ->paginate(10);
                        }


                        // $sum = \DB::table('sale_factor')
                        //     ->where('sale_factor.store_id', $store_id)
                        //     ->whereBetween('sale_date', [$startfrom, $end])
                        //     ->sum('total_price');


                    } elseif ($type === 'bt_date') {

                        if ($request->get('start_date') != '') {
                            $start_date = $request->get('start_date');
                            $end_date = $request->get('end_date');

                            if (\Auth::user()->user_level ==\App\Models\User::MANAGER  || \Illuminate\Support\Facades\Auth::user()->user_level==\App\Models\User::ADMIN || \Illuminate\Support\Facades\Auth::user()->user_level==\App\Models\User::USER) {
                                if (isset($id) && $id > 0) {
                                    $data = \DB::table('letter')
                                        ->select('letter.id', 'letter.name', 'letter.last_name', 'letter.arch_no', 'letter.arch_date_register','letter.arch_letter_no','letter.arch_date','letter.arch_title')
                                        ->where('letter.arch_type',$store_id)
                                        ->whereBetween('arch_date_register', [$start_date, $end_date])
                                        ->paginate($id);
                                } else {
                                    $data = \DB::table('letter')
                                        ->select('letter.id', 'letter.name', 'letter.last_name', 'letter.arch_no', 'letter.arch_date_register','letter.arch_letter_no','letter.arch_date','letter.arch_title')
                                        ->where('letter.arch_type',$store_id)
                                        ->whereBetween('arch_date_register', [$start_date, $end_date])
                                        ->paginate(10);
                                }
                            }
                            // else {
                            //     if (isset($id) && $id > 0) {
                            //         $data = \DB::table('sale_factor')
                            //             ->join('store', 'sale_factor.store_id', '=', 'store.store_id')
                            //             ->select('sale_factor_id', 'sale_factor_code', 'recieption_price', 'total_price', 'sale_date')
                            //             ->where('store.agency_id', '=', \Auth::user()->agency_id)
                            //             ->whereBetween('sale_date', [$start_date, $end_date])
                            //             ->paginate($id);
                            //     } else {
                            //         $data = \DB::table('sale_factor')
                            //             ->join('store', 'sale_factor.store_id', '=', 'store.store_id')
                            //             ->select('sale_factor_id', 'sale_factor_code', 'recieption_price', 'total_price', 'sale_date')
                            //             ->where('store.agency_id', '=', \Auth::user()->agency_id)
                            //             ->whereBetween('sale_date', [$start_date, $end_date])
                            //             ->paginate(5);
                            //     }
                            // }

                            // $sum = \DB::table('sale_factor')
                            //     ->whereBetween('sale_date', [$start_date, $end_date])
                            //     ->sum('total_price');

                        }

                    }

                }
            }

            $request->session()->put('data', $data);
            // $request->session()->put('sum', $sum);


            return Response::JSON(array(
                'table_data' => $data,
                // "sum" => $sum,
//                'total_data' => $total_row,
                'pagination' =>(string)$data->links(),
            ));

        }

    }

    public function displayImage($filename)
    {
        $path = storage_public('images/' . $filename);



        if (!File::exists($path)) {

            abort(404);

        }



        $file = \Illuminate\Support\Facades\File::get($path);

        $type = \Illuminate\Support\Facades\File::mimeType($path);



        $response = Response::make($file, 200);

        $response->header("Content-Type", $type);



        return $response;
    }



}
