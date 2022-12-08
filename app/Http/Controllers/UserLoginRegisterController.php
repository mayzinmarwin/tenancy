<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserLoginRegisterController extends Controller
{
    public function register(Request $request) {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->photo='';
        $user->save();
    }
    public function login(Request $request){
        $user = User::where('email','=', $request->email)->firstOrFail();
        if($user){
            // if(Hash::check($request->password,$user->password)){
                    $request->session()->put('loggedInUser',$user->id);


            // }

        }

    }
    public function profile(Request $request){
        $data=['userInfo'=> User::where('id',session('loggedInUser'))->firstOrFail()];
        return view('tenantprofile',$data);
    }
    public function profileImage(Request $request){

        $user_id = $request->user_id;
        $user =User:: find($user_id);

        if($request->file('photo')){
            $request->file('photo')->store("","google");
            $files = \Storage::disk("google")->allFiles();
            $firstFileName = $files[0];
            $details = \Storage::disk('google')->getMetadata($firstFileName);
            $img_url = \Storage::disk('google')->url($firstFileName);
            if($user->photo){
                \Storage::disk('google')->delete('1NZkZWo5Bt5u8WZMg4Uhc9qgdduWCxPEs/' . $user->photo );
            }
        }

         User::where('id',$user_id)->first();
         $user->photo =$img_url;
         $user->save();
    }
    public function update(Request $request ){

        $user = User::where('id', $request->id)->firstOrFail();
        $user->name = $request->name;
        $user->email =$request->email;
        $user->save();
    }
}
