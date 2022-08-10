<?php


function countLetter($type){

    $letter=\Illuminate\Support\Facades\DB::table('letter');

    if(isset($type)){

        switch ($type){

            case $type:
                return $letter->where('arch_type',$type)->count('arch_type');
        }
    }
}

function theBiggestLetter(){

    $letter=\Illuminate\Support\Facades\DB::table('letter');

    $letters=array(
        countLetter('صادره'),
        countLetter('وارده'),
        countLetter('استعلام'),
        countLetter('پیشنهاد'),
    );
    return max($letters);
}
function getUserName($id){

if(isset($id)){

    $username=    \Illuminate\Support\Facades\DB::table('users')->select('name','last_name')->where('id',$id)
        ->first();

    return  $username->name . ' ' . $username->last_name;
}




return  '';

}
