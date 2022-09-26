<?php

namespace App\Http\Controllers;

use App\Admin;
use App\LessonChangesDate;
use App\Mail\SendLessonCanceled;
use App\Models\Course;
use App\Models\CourseLesson;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Course $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Course $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Course $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    public function changeStatus(CourseLesson $lesson, $status)
    {
//        dd($lesson);
//        $lesson->status = $status;
//        $lesson->save();
        $now = Carbon::now();
        $date_lesson = date('Y-m-d H:i:s',strtotime("$lesson->date $lesson->time" ));
//        dd($now->diffInSeconds($date_lesson));
        $student = User::find($lesson->course->student_id);
        $teacher = User::find($lesson->course->teacher_id);
        if ($status == 'canceled' && !$lesson->course->free) {
            if ($teacher->canceled_per_month > 0 && $teacher->canceled_per_month > $teacher->this_month_canceled) {
                if ($now->diffInSeconds($date_lesson) > $teacher->hours_befor_canceled * 60 * 60){
                    $teacher->this_month_canceled += 1;
                    $teacher->save();
                    $lesson->status = $status;
                    $lesson->teacher_canceled = 1;
                    $lesson->save();
                    $admins = Admin::all();
                    $adminsMail = [];
                    foreach ($admins as $admin) {
                        array_push($adminsMail, $admin->email);
                    }
                    Mail::to($student->email)->bcc($adminsMail)->send(new SendLessonCanceled($lesson));
                }else{
                    return redirect()->back()->with('error', 'You can Not canceled this lesson because the lesson started in less than '.$teacher->hours_befor_canceled.' hours');
                }
//                $student->classes = -1;
//                $student->save();

            }else{
                return redirect()->back()->with('error', 'You can Not canceled this lesson please contact admin');
            }

        }else{
            $lesson->status = $status;
            $lesson->teacher_canceled = 1;
            $lesson->save();
//            return redirect()->back()->with('error', 'You can Not canceled this lesson please contact admin');
        }
        return redirect()->back()->with('success', 'Done');
    }


    public function studentChangeStatus(CourseLesson $lesson, $status)
    {
//        dd($lesson);
//        $lesson->status = $status;
//        $lesson->save();
        $now = Carbon::now();
        $date_lesson = date('Y-m-d H:i:s',strtotime("$lesson->date $lesson->time" ));
//        dd($now->diffInSeconds($date_lesson));
        $student = User::find($lesson->course->student_id);
        $teacher = User::find($lesson->course->teacher_id);
        if ($status == 'canceled' && !$lesson->course->free) {
            if ($student->canceled_per_month > 0 && $student->canceled_per_month > $student->this_month_canceled) {
                if ($now->diffInSeconds($date_lesson) > $student->hours_befor_canceled * 60 * 60){
                    $student->this_month_canceled += 1;
                    $student->save();
                    $lesson->status = $status;
                    $lesson->student_canceled = 1;
                    $lesson->save();
                    $admins = Admin::all();
                    $adminsMail = [];
                    foreach ($admins as $admin) {
                        array_push($adminsMail, $admin->email);
                    }
                    Mail::to($teacher->email)->bcc($adminsMail)->send(new SendLessonCanceled($lesson));
                }else{
                    return redirect()->back()->with('error', 'You can Not canceled this lesson because the lesson started in less than '.$student->hours_befor_canceled.' hours');
                }
//                $student->classes = -1;
//                $student->save();

            }else{
                return redirect()->back()->with('error', 'You can Not canceled this lesson please contact admin');
            }

        }else{
            $lesson->status = $status;
            $lesson->teacher_canceled = 1;
            $lesson->save();
//            return redirect()->back()->with('error', 'You can Not canceled this lesson please contact admin');
        }
        return redirect()->back()->with('success', 'Done');
    }

    public function changeDates(CourseLesson $lesson)
    {
        $thislesson = $lesson;

        return view('frontend.user.changeDate',compact('thislesson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CourseLesson $lesson
     * @return \Illuminate\Http\Response
     */
    public function updateDates(Request $request, CourseLesson $lesson)
    {
//        dd($request);
        $lessonChanges = new LessonChangesDate();
        $lessonChanges->lesson_id = $lesson->id;
        $lessonChanges->date = $request->get('date');
        $lessonChanges->time = $request->get('time');
        $lessonChanges->comment = $request->get('comment');
        $lessonChanges->status = 'changeDateOfLesson';

        $lessonChanges->save();

        return redirect()->route('home')->with('success', 'Done');
    }

    public function approveChangeDates(CourseLesson $lesson)
    {
//        dd($lesson);
        $changeDate = $lesson->lessonChangeDate()->where('status','changeDateOfLesson')->first();
//dd($changeDate);
        $lesson->date = $changeDate->date;
        $lesson->time = $changeDate->time;

        $changeDate->status = "Approved Chaneges";

        $lesson->save();
        $changeDate->save();

        return redirect()->route('home')->with('success', 'Done');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Course $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
