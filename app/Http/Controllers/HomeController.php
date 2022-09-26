<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseLesson;
use App\Models\VideoLinkes;
use App\Models\Voucher;

use App\TeacherAccount;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use MediaUploader;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user=Auth::user();
        if ($user->type == 'student'){
            $lessons = CourseLesson::where('status','expected')->where('date','>=',today())->whereHas('course', function($q){$q->where('student_id', auth()->user()->id);})->orderBy('date')->get();
        }else{
            $lessons = CourseLesson::where('status','expected')->where('date','>=',today())->whereHas('course', function($q){$q->where('teacher_id', auth()->user()->id);})->orderBy('date')->get();
        }
//        dd($courses);
        return view('home',compact('lessons','user'));
    }
    public function myAccount(){
        $user=Auth::user();
        $videoUrl = VideoLinkes::where('user_id', $user->id)->get();
        return view('frontend.user.myAccount',compact('user' ,'videoUrl'));

    }
    public function myClasses(){
        $user=Auth::user();
        if ($user->type == 'student'){
            $courses = Course::where('student_id',$user->id)->get();
        }else{
            $courses = Course::where('teacher_id',$user->id)->get();
        }
        return view('frontend.user.myClasses',compact('user','courses'));
    }
    public function showClass(Course $course){
        $user=Auth::user();
        if ($course->student_id !== $user->id && $course->teacher_id !== $user->id){
            return redirect()->back();
        }
        return view('frontend.user.showClass',compact('user','course'));
    }
    public function accounting(){
        $user=Auth::user();
        // if ($user->type == 'student'){
        //     $courses = Course::where('student_id',$user->id)->get();
        // }else{
        //     $courses = Course::where('teacher_id',$user->id)->get();
        // }
        if ($user->type == 'teacher'){
            $vouchers = $user->teacherAccounts;
        }else{
            $vouchers= Voucher::where('user_id',$user->id)->orderBy('created_at','desc')->get();
        }



        return view('frontend.user.accounting',compact('user','vouchers'));
    }
    public function completeClass(CourseLesson $lesson,Request $request){
        $user=Auth::user();
        if ( $lesson->course->teacher_id !== $user->id){
            return redirect()->back();
        }
        $lesson->status = "completed";
        $lesson->comment = $request->comment;
        $lesson->save();
        $lesson->course->teacher->remaining += $lesson->course->session_time *( $lesson->course->teacher->hourly_price/60);
        $lesson->course->teacher->save();
        $teacherAccount  = new TeacherAccount();
//        $teacherAccount->type = "income";
        $teacherAccount->amount = $lesson->course->session_time *( $lesson->course->teacher->hourly_price/60);
        $teacherAccount->to = $lesson->course->teacher->name;
        $teacherAccount->paid_for = "lesson ". $lesson->course->product->name;
        $teacherAccount->user_id = $lesson->course->teacher->id;
        $teacherAccount->lesson_id = $lesson->id;
        $teacherAccount->note = "The Lesson Is Completed";
        $teacherAccount->save();

        return redirect()->back()->with('success','Lesson Completed Successfully');
    }

    public function absentClass(CourseLesson $lesson,Request $request){
        $user=Auth::user();
        if ( $lesson->course->teacher_id !== $user->id){
            return redirect()->back();
        }
        $lesson->status = "Absent Student";
        $lesson->comment = $request->comment;
        $lesson->save();
        $lesson->course->teacher->remaining += $lesson->course->session_time *( $lesson->course->teacher->hourly_price/60);
        $lesson->course->teacher->save();
        $teacherAccount  = new TeacherAccount();
//        $teacherAccount->type = "income";
        $teacherAccount->amount = $lesson->course->session_time *( $lesson->course->teacher->hourly_price/60);
        $teacherAccount->to = $lesson->course->teacher->name;
        $teacherAccount->paid_for = "lesson ". $lesson->course->product->name;
        $teacherAccount->user_id = $lesson->course->teacher->id;
        $teacherAccount->lesson_id = $lesson->id;
        $teacherAccount->note = "The student is absent from the lesson";
        $teacherAccount->save();
        return redirect()->back()->with('success','Lesson Completed Successfully But Student Absent');
    }


    public function approveClass(Course $course,$status){
        $user=Auth::user();
        if ($course->teacher_id !== $user->id){
            return redirect()->back();
        }
        $course->teacher_approve = $status;
        if ($status == 0){
            $course->student->classes += $course->lessons->where('status','!=' ,'canceled')->count();
            $course->student->save();
        }
        $course->save();
        return redirect()->back()->with('success','Done');

    }
    public function update(Request $request)
    {

        // dd($request);
        //validation
        $request->validate([
            'img'=>'image|mimes:jpg,png,jpeg,svg|max:3048',
            'name'=>'required',
            'email'=>'required',
            'password' => 'nullable|max:25|min:6|confirmed',
            'phone'=>'nullable',
            'zoom'=>'url|nullable',
            'video'=>'url|nullable',
            'qualifications'=>'nullable',
            'oldPassword'=>'string|nullable',
            'newPassword'=>'nullable|string|confirmed'

        ]);
        $user = \auth()->user();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->zoom = $request->get('zoom');
        $user->video = $request->get('video');
        $user->qualifications = $request->get('qualifications');
        $user->country = $request->get('country');
        $user->teachCourses()->sync($request->courses);
        if ($request->oldPassword) {
            if (Hash::check($request->oldPassword,$user->password)){
                $user->password = Hash::make($request->newPassword);
            }else{
                return redirect()->back()->with('error','invalid old Password ');
            }
        }
        $user->save();

        if($request->file('img')):
            $media = MediaUploader::fromSource($request->file('img'))->upload();
            $user->attachMedia($media, 'userAvatar');
        endif;

        if($user->type == 'teacher'):
            $oldlink= VideoLinkes::where('user_id' ,$user->id)->get();
            foreach($oldlink as $vlOld): $vlOld->delete(); endforeach;
            $itemLoop = $request->input('url_count');
            for ($i = 1; $i <= $itemLoop; $i++) :
                $urlRequest = $this->editVieoYoutube($request->input('video_url_'.$i));
                if($urlRequest != null):
                    $videoUrl = new VideoLinkes();
                    $videoUrl->user_id = $user->id;
                    $videoUrl->video = $urlRequest;
                    $videoUrl->save() ;
                endif;
            endfor;
        endif;

        return redirect()->back()->with('success', "Profile Updated successfully");
    }
    public function editVieoYoutube($video)
    {
        $url = str_replace('watch?v=', 'embed/', $video);
        return $url;

    }
}
