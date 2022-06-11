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


            ]);
            $message=Auth::user()->name. " edited data";
        helper::activity_log(Auth::user()->id,$message);
            request()->session()->flash('message', 'edited succesfully');

            return redirect()->route('edit',$id_val);

        }else{
        $student=new Stud();
        $student->firstname=$request->firstname;
        $student->lastname=$request->lastname;
        $student->email=$request->email;
        $student->phone=$request->phone;
        $student->save();
        $message=Auth::user()->name. " created data";
        helper::activity_log(Auth::user()->id,$message);
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
        $message=Auth::user()->name. " deleted data";
        helper::activity_log(Auth::user()->id,$message);
        request()->session()->flash('delete', 'deleted succesfully');

            return redirect()->route('dashboard');


    }
    public function list(){
        $results=ActivityLog::orderBy("id","DESC")->get();
        return $results;
    } 
}
