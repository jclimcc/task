<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //
    public function CouseView($ref)
    {
        $studentinfo= Student::where('ref','=',$ref)->with('my_course') ->get();
        $totalmark=0;
        $average=0;
        if(sizeof($studentinfo[0]->my_course)>=1)
        {
            foreach($studentinfo[0]->my_course as $key => $course )
            {
                $totalmark=$course->mark+$totalmark; 
            }
            $average=( $totalmark/(sizeof($studentinfo[0]->my_course)*100) ) * 100;
        }
        return view('student.result.course_view',compact('studentinfo','average'));

    }
    public function CourseAdd($ref)
    {
        $studentinfo= Student::where('ref','=',$ref)->get();
      
        return view('student.result.course_add',compact('studentinfo'));

    }

    public function CourseStore(Request $request,$ref)
    {

        $validatedData= $request->validate([
            'course'=>'required',
            'mark'=>'required|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
        ]);
        $student= Student::find($request->student_id);      
        $student->my_course()->create([
            'course_name'=>$request->course, 
            'mark'=>$request->mark]);

        $notification=array(
            'message'=>'Mark Successfully Added ',
            'alert-type'=>'success'
        );
        return redirect()->route('result.course_view',$ref)->with($notification);
    }

    public function CourseEdit($ref,$course)
    {
        $studentinfo= Student::where('ref','=',$ref)->with(['my_course'=> function($q) use($course) {
         
            $q->where('id', '=', $course); // '=' is optional
        }])->get();
        return view('student.result.course_edit',compact('studentinfo'));
    }

    public function CourseUpdate(Request $request, $ref,$course)
    {
        $validatedData= $request->validate([
            'course'=>'required',
            'mark'=>'required|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
        ]);
       
        $student=Course::find($course)->update([
            'course_name'=>$request->course, 
            'mark'=>$request->mark]);

        $notification=array(
            'message'=>'Edited Course Result Successfully ',
            'alert-type'=>'success'
        );
        return redirect()->route('result.course_view',$ref)->with($notification);
    }
    public function CourseDelete($ref,$course)
    {
        $data= Course::find($course);
        $data->delete();

        $notification=array(
            'message'=>'Delete Succesesfull ',
            'alert-type'=>'success'
        );
        
        
        return redirect()->route('result.course_view',$ref)->with($notification);
    }
}
