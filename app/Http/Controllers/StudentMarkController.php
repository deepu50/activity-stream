<?php

namespace App\Http\Controllers;

use App\Models\Stud;
use App\Models\StudentMarks;
use Illuminate\Http\Request;

class StudentMarkController extends Controller
{
    public function index(){
        $results=StudentMarks::get();
        $students=Stud::get();
        return view('student-marks.marks',compact('results','students'));
    }
    public function store(Request $request){
        $id_val=$request->post('id_val');
        if(isset($id_val)){
            $student=StudentMarks::where("id",$id_val)->update([
                "student_id"=>$request->post("student_id"),
                "term"=>$request->post("term"),
                "history"=>$request->post("history"),
                "maths"=>$request->post("maths"),
                "science"=>$request->post("science"),


            ]);
            request()->session()->flash('message', 'edited succesfully');

            return redirect()->route('edit-marks',$id_val);

        }else{
        $student=new StudentMarks();
        $student->student_id=$request->student_id;
        $student->term=$request->term;
        $student->history=$request->history;
        $student->maths=$request->maths;
        $student->science=$request->science;
        $student->save();
        return response()->json($student);

        }
    }
    public function edit($id){
        $students=StudentMarks::where("id",$id)->first();
        $stude=Stud::get();
        return view('student-marks.edit',compact('students','stude'));

    }
    public function delete(Request $request){
        $id=$request->id;
        StudentMarks::where("id",$id)->delete();
        request()->session()->flash('delete', 'deleted succesfully');

            return redirect()->route('student_marks');


    }
}
