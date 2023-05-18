<?php 
namespace App\Http\Helper;

class ResponseBuilder{

    public static function result($status=null,$info=null,$data=null){
        return [
            "success"=>$status,
            "infomation"=>$info,
            "data"=>$data,
        ];
    }



}

?>