<?php

namespace App\Http\Controllers\Admin;
use App\CategoryProduct;
use App\Country;
use App\Http\Controllers\Controller;
use App\Admin;
use App\Models\Course;
use App\Models\VideoLinkes;
use App\Models\Voucher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use MediaUploader;
use Plank\Mediable\MediaUploader as MediableMediaUploader;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{


    public function index()
    {
        $users = Admin::all()->except(1);
        return view('admin.users.index', compact('users'));
    }
    /* teacher== alluser and student */
   public function allUsers(){
        $users=User::Where('type','teacher')->withTrashed()->get();
        return view('admin.teacher.index',compact('users'));
   }
    public function allstudent(){
        $users=User::Where('type','student')->withTrashed()->get();
        return view('admin.student.index',compact('users'));
    }
    public function showStudent(User $user)
    {
        $courses = Course::where('student_id',$user->id)->orderBy('created_at','desc')->get();
    //    dd($courses);
        $vouchers= Voucher::where('user_id',$user->id)->orderBy('created_at','desc')->get();
        return view('admin.student.show',compact('user','courses','vouchers'));
    }

    public function editStudent(User $user){
        $json_contry = file_get_contents('conteries.json');
        $countries = json_decode($json_contry);
        //        $json_contry = file_get_contents('conteries.json');
//        $countries = Country::all();
        return view('admin.student.edit',compact('user', 'countries'));
    }

    public function updateStudent(Request $request, User $user){
        // dd($request);

        $request->validate([
            'img'=>'image|mimes:jpg,png,jpeg,svg|max:3048|nullable',
            'name' => 'required|max:255',
            'email'=>'required',
            'phone'=>'nullable',
            'qualifications'=>'nullable',
        ]);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->age = $request->get('age');
        $user->academic_year = $request->get('academic_year');
        $user->gender = $request->get('gender');
        $user->country = $request->get('country');
        $user->facebook = $request->get('facebook');
        $user->whatsApp = $request->get('whatsApp');
        $user->timezone = $request->get('timezone');
        $user->canceled_per_month = $request->get('canceled_per_month');
        $user->this_month_canceled = $request->get('this_month_canceled');
        $user->hours_befor_canceled = $request->get('hours_befor_canceled');
        // $user->qualifications = $request->get('qualifications');
        $user->teachCourses()->sync($request->courses);
        $user->save();

        if($request->file('img')):
            $media = MediaUploader::fromSource($request->file('img'))->upload();
            $user->attachMedia($media, 'userAvatar');
        endif;

        return redirect()->route('admin.teachers')->with('success', "User $user->name updated successfully");
    }


    public function showTeacher(User $user)
    {
        $courses = Course::where('teacher_id',$user->id)->orderBy('created_at','desc')->get();
//        dd($courses);
        $vouchers= Voucher::where('user_id',$user->id)->orderBy('created_at','desc')->get();
        $appointment =$user->teacherAppointment;
//        dd($appointment);
        return view('admin.teacher.show',compact('user','courses','vouchers','appointment'));
    }
    public function payToTeacher(User $user)
    {
       if ($user->remaining >0 ){
           $voucher = Voucher::Create([
               'type'=>'expense',
               'amount'=>$user->remaining,
               'paid_for' => 'Pay To Teacher',
               'user_id' => $user->id
           ]);
           $user->remaining = 0;
       }
        $user->save();
        return redirect()->back()->with('success','Done');
    }
    public function show(User $user)
    {
        if ($user->showHome){

            $user->showHome = 0;
        }else{

            $user->showHome = 1;
        }
        $user->save();
        return redirect()->back()->with('success','Done');
    }
    public function editUser(User $user){

        $videoUrl = VideoLinkes::where('user_id', $user->id)->get();
////        $json_contry = file_get_contents('conteries.json');
//        $countries = Country::all();
        $json_contry = file_get_contents('conteries.json');
        $countries = json_decode($json_contry);
        return view('admin.teacher.edit',compact('user' ,'videoUrl', 'countries'));
    }

    public function updateTeacher(Request $request, User $user){
//         dd($request);
        $request->validate([
            'img'=>'image|mimes:jpg,png,jpeg,svg|max:3048|nullable',
            'name' => 'required|max:255',
            'email'=>'required',
            'zoom' => 'required|url',
            'video' => 'nullable|url',
            'teamLink' => 'nullable|url',
            'hourly_price' => 'required',
            'phone'=>'nullable',
            'qualifications'=>'nullable',
        ]);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->zoom = $request->get('zoom');
        $user->teamLink = $request->get('teamLink');
        $user->video = $request->get('video');
        $user->phone = $request->get('phone');
        $user->gender = $request->get('gender');
        $user->country = $request->get('country');
        $user->facebook = $request->get('facebook');
        $user->whatsApp = $request->get('whatsApp');
        $user->timezone = $request->get('timezone');
        $user->qualifications = $request->get('qualifications');
        $user->hourly_price = $request->get('hourly_price');
        $user->canceled_per_month = $request->get('canceled_per_month');
        $user->this_month_canceled = $request->get('this_month_canceled');
        $user->hours_befor_canceled = $request->get('hours_befor_canceled');
        $user->teachCourses()->sync($request->courses);
//        dd($user);
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

        return redirect()->route('admin.teachers')->with('success', "User $user->name updated successfully");
    }
    public function editVieoYoutube($video)
    {
        $url = str_replace('watch?v=', 'embed/', $video);
        return $url;
    }


    /*end teacher and student */
    public function create()
    {
        $roles = Role::where('guard_name', 'admin')->get();

        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'password' => 'required|max:25|min:6|confirmed',
            'email' => 'required|email|max:255|unique:admins',
            'role' => 'required',
        ]);
        // dd($request);
        // $password = str_random();

        $user = new Admin();

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->syncRoles($request->get('role'));

        $user->save();
        Alert::success('User '.$user->name .' Created successfully');
        return redirect('admin/users/all');
    }

    public function edit(Admin $user)
    {
        $roles = Role::where('guard_name', 'admin')->get();
        return view('admin.users.edit', compact('roles', 'user'));
    }

    public function update(Request $request, Admin $user)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'roles' => 'required',
            'password' => 'nullable|max:25|min:6|confirmed',
        ]);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if($request->password){
            $user->password =Hash::make( $request->get('password'));
        }
        $user->syncRoles($request->get('roles'));

        $user->save();

        return redirect()->route('admin.users.all')->with('success', "User $user->name updated successfully");
    }

    public function destroy(Admin $user)
    {
        if($user->account_id){
            Alert::error(' Can`t delete User '.$user->name .' ');
        }else{
            $user->delete();
            Alert::success('User '.$user->name .' deleted successfully');
        }
        return redirect('admin/users/all');
    }
    public function review(User $user)
    {
        $user->approved = 1;
        $user->save();
        return redirect()->back()->with('success','Done');
    }
    public function deleteUser(User $user)
    {
        $user->forceDelete();
        return redirect()->back()->with('success','Done');
    }
    // public function shiftDelete(User $user)
    // {
    //     // dd($user);
    //     // $userD = user::withTrashed()->findOrFail($user);
    //     // $userD->forceDelete();
    //     return redirect()->back()->with('success','Done');
    // }

    public function recoverUser($user)
    {
        User::withTrashed()->find($user)->restore();

        return redirect()->back()->with('success','Done');
    }

    public function resetThisMonthCanceld(){
        $users = User::all();
        foreach ($users as $user){
            $user->this_month_canceled = 0;
            $user->save();
        }
    }
}
