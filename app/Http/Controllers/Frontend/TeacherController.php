<?php

namespace App\Http\Controllers\Frontend;

use App\Models\TeacherAppointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class TeacherController extends Controller
{
    public function index(){

        $teachers = User::Where([ 'type'=>'teacher', 'showHome'=>1 ])->get();
        return view('frontend.'.setting('theme.site').'.teachers' , compact('teachers'));
    }


    public function appointments(){
        $user = auth()->user();
        $appointment = $user->teacherAppointment;
//        dd($appointment);
        return view('frontend.user.appointment',compact('user','appointment'));
    }
    public function updateAppointments(Request $request){
        $user = auth()->user();
        $request->merge(['user_id'=>$user->id]);
        $request->offsetUnset('_token');
        if ($user->teacherAppointment){
            $appointment = TeacherAppointment::find($user->teacherAppointment->id);
            $appointment->update($request->all());
        }else{
            TeacherAppointment::Create($request->all());
        }
        // dd($request->all());
        return redirect()->back()->with('success','Done');
    }
}
