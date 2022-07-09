<?php
namespace App;
use Auth;
use App\Models\ActivityLog;
use App\Models\Stud;
use App\Models\Student;

class Helper
{
    public static function get_student_name($id){
        $name=Stud::where("id",$id)->first();

        if(isset($name)){
            return $name->firstname;

        }else{
            return false;

        }
    }

}
?>
