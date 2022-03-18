<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
    public function StudentView()
    {
        $Students= Student::with('my_course')->get();
        
      

        return view('student.student_view',compact('Students'));
    }

    public function StudentAdd()
    {
        return view('student.student_add');

    }

    public function StudentStore(Request $request)
    {
       
        $validatedData= $request->validate([
            'ref'=>'required|unique:students',
            'name'=>'required',
            'gender'=>'required',
            'nric'=>'required',
        ]);

           
        if ( Student::where('ref', '=', $request->ref)->first()) {
            $notification=array(
                'message'=>'Student ID already exist by another user ',
                'alert-type'=>'error'
            );
            return redirect()->back();
            
        }


        $data= new Student();
        $data->ref=$request->ref;
        $data->name=$request->name;
        $data->gender= $request->gender;
        $data->nric=$request->nric;
        $data->save();

        $notification=array(
            'message'=>'Successfully Added new Student '.$data->name,
            'alert-type'=>'success'
        );
        
        
        return redirect()->route('student_view')->with($notification);
    }

    public function StudentEdit($ref)
    {
        $student= Student::where('ref','=',$ref)->get();
        return view('student.student_edit',compact('student'));
    }

    public function StudentUpdate(Request $request)
    {
       //
        $validatedData= $request->validate([
            'ref'=>'required',
            'name'=>'required',
            'gender'=>'required',
            'nric'=>'required',
        ]);
        
        $data=Student::where('ref', '=', $request->ref)->where('id',"!=",$request->student_id) ->first();
       
        if ( Student::where('ref', '=', $request->ref)->where('id',"!=",$request->student_id) ->first()) {
            $notification=array(
                'message'=>'Student ID already exist by another user ',
                'alert-type'=>'error'
            );
            return redirect()->back();
            
        }
        
        
        $data= Student::find($request->student_id);
       
        $data->ref=$request->ref;
        $data->name=$request->name;
        $data->gender= $request->gender;
        $data->nric=$request->nric;
        $data->save();
        
          
        $notification=array(
            'message'=>'Updated Succesesfull ',
            'alert-type'=>'success'
        );
        
        
        return redirect()->route('student_view')->with($notification);


    }
    public function StudentDelete($ref)
    {
        $data= Student::where('ref','=',$ref)->first();
      
        $data->delete();

        $notification=array(
            'message'=>'Delete Succesesfull ',
            'alert-type'=>'success'
        );
        
        
        return redirect()->route('student_view')->with($notification);
    }
}
