<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\helper;
use App\Models\Stud;
use App\Models\ActivityLog;

use Auth;

class StudentController extends Controller
{
    public function index(){
        $students=Stud::orderBy('id','DESC')->get();
        return view('students',compact('students'));
    }
    public function store(Request $request){
        $id_val=$request->post('id_val');
        if(isset($id_val)){
            $student=Stud::where("id",$id_val)->update([
                "firstname"=>$request->post("firstname"),
                "lastname"=>$request->post("lastname"),
                "email"=>$request->post("email"),
                "phone"=>$request->post("phone"),
                "age"=>$request->post("age"),
                "gender"=>$request->post("gender"),
                "reporting_teacher"=>$request->post("reporting_teacher")


            ]);
            request()->session()->flash('message', 'edited succesfully');

            return redirect()->route('edit',$id_val);

        }else{
        $student=new Stud();
        $student->firstname=$request->firstname;
        $student->lastname=$request->lastname;
        $student->email=$request->email;
        $student->phone=$request->phone;
        $student->age=$request->age;
        $student->gender=$request->gender;
        $student->reporting_teacher=$request->reporting_teacher;
        $student->save();
        return response()->json($student);

        }


    }
    public function edit($id){
        $students=Stud::where("id",$id)->first();
        return view('edit',compact('students'));

    }
    public function delete(Request $request){
        $id=$request->id;
        Stud::where("id",$id)->delete();
        request()->session()->flash('delete', 'deleted succesfully');

            return redirect()->route('dashboard');


    }
}
