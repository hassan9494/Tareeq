<?php

namespace App\Http\Controllers\Admin;

use App\Mail\SendMessageToUser;
use App\Models\Course;
use App\Models\CourseLesson;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

        public function index()
    {

        $courses=Course::orderBy('created_at','desc')->paginate(20);
        return view('admin.classes.index', compact('courses'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = User::where(['type'=>'student','approved'=>1])->get();
        $teachers = User::where(['type'=>'teacher','approved'=>1])->get();
        return view('admin.classes.create',compact('students','teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $course =  Course::Create($request->all());

        $days = $request->days; //define qty
        // dd($days);
        $courseDays = collect(request()->days)->filter(function ($days, $key) {
            return $days != null;
        });
        // dd($courseDays->count());

        foreach ($courseDays as $key => $value){
            $start = Carbon::create($request->start_from)->subDay();
            // $i= 0;
            for($i= 0 ;$i < $request->weeks ;$i++){
                $date =  Carbon::parse($start->addDay($i*7))->modify("next $key")->format('Y-m-d');

               $lesson =  CourseLesson::create(['course_id'=>$course->id,'date'=>$date,'time'=>$value,'day'=>$key]);
                $start = Carbon::create($request->start_from)->subDay();
            }
        }
        $student  = User::find($request->student_id);
        $teacher  = User::find($request->teacher_id);
        if(!$request->free){
            $student->classes =- $courseDays->count()*$request->weeks;
            $student->save();
        }

        //notfication here
        $email = auth::user()->email;

        Mail::to($student->email)->send(new SendMessageToUser());
        Mail::to($teacher->email)->send(new SendMessageToUser());
        return redirect()->route('admin.classes.index')->with('success','Class Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);
        return view('admin.classes.show',compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateLesson(Request $request, CourseLesson $lesson)
    {
        $request->validate([
            'day'=>'required|string',
            'date'=>'required|date|after_or_equal:today',
            'time'=>'required'
        ]);
        $lesson->update($request->all());
        return redirect()->back()->with('success','Done');
    }

    public function store_lesson(Request $request)
    {
       $course =  Course::find($request->course_id);
    //    dd($course);

        $days = $request->days; //define qty
        // dd($days);
        $courseDays = collect(request()->days)->filter(function ($days, $key) {
            return $days != null;
        });
        // dd($courseDays->count());

        foreach ($courseDays as $key => $value){
            $start = Carbon::create($request->start_from)->subDay();
            // $i= 0;
            for($i= 0 ;$i < $request->weeks ;$i++){
                $date =  Carbon::parse($start->addDay($i*7))->modify("next $key")->format('Y-m-d');

               $lesson =  CourseLesson::create(['course_id'=>$course->id,'date'=>$date,'time'=>$value,'day'=>$key]);
                $start = Carbon::create($request->start_from)->subDay();
            }
        }
        $student  = User::find($course->student_id);
        $teacher  = User::find($course->teacher_id);
        if(!$request->free){
            $student->classes =- $courseDays->count()*$request->weeks;
            $student->save();
        }

        return redirect()->route('admin.classes.show',$course->id)->with('success','Add Lessons Successfully');
    }



    public function changeStatus(CourseLesson $lesson,$status)
    {
//        dd($status);
        $lesson->status = $status;
        $lesson->save();
        $student  = User::find($lesson->course->student_id);
        if ($status == 'canceled' && !$lesson->course->free){
//            if ()
            $student->classes =- 1;
            $student->save();
        }
        return redirect()->back()->with('success','Done');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
