<?php
namespace App;
use Auth;
use App\Models\ActivityLog;




class Helper
{
    public static function activity_log($id,$message){
        ActivityLog::create([
            "user_id"=>$id,
            "message"=>$message
        ]);
        return true;
    }

}
?>