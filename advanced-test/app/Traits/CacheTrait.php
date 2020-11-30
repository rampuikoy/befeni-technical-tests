<?php
namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

trait CacheTrait
{
    public function getCacheKey($prefix, $key)
    {
        $prefix = strtoupper($prefix);
        $key = strtoupper($key);
        return $prefix . "." . $key;
    }

    public function getArrayKey($prefix, $arraykey)
    {
        $prefix = strtoupper($prefix);
        $getkey = $prefix . "."."WHERE";
        foreach($arraykey as $key=>$value){
            $getkey = $getkey.$key.".".$value.".";
        }
        return $getkey;
    }

    public function getTwoArrayKey($prefix, $array1, $array2)
    {
        $prefix = strtoupper($prefix);
        $getkey = $prefix . "."."WHERE";
        if(!is_null($array1)){
            foreach($array1 as $key=>$value){
                $getkey = $getkey.$key.".".$value.".";
            }
        }
        if(!is_null($array2)){
            foreach($array2 as $key=>$value){
                $getkey = $getkey.$key.".".$value.".";
            }
        }
        return $getkey;
    }


    public function getTime($time)
    {
        $gettime = Carbon::now()->addminutes($time);
        return $gettime;
    }

    public function getCurrentUrl()
    {
        $url = urldecode(URL::full());
        return $url;
    }
}
