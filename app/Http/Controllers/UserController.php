<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\User;
use Validator;
use Illuminate;

/**
* 
*/
class UserController extends Controller
{

	public function postSignUp(Request $request){

		$this->validate($request, [
			'email' => 'email|unique:users',
			'name' => 'required|max:120',
			'surname' => 'required|max:120',
			'password' => 'required|min:8',
			'password_check' => 'required|min:8',
			]);

		$email = $request['email'];
		$name = $request['name'];
		$surname = $request['surname'];
		$password	= $request['password'];
		$password_check = $request['password_check'];

		if($password_check == $password){
			$user = new User();
			$user->email = $email;
			$user->name =$name;
			$user->surname=$surname;
			$user->password = bcrypt($password);
			$user->is_admin = false;
			$user->status = 0;
			$user->save();
			Auth::login($user);
			return redirect()->route('homepage');
		}
		return redirect()->route('home');
	}

	  public function postSignIn(Request $request){

	  	$this->validate($request, [
			'email' => 'required',
			'password' => 'required'
			]);

        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {

            return redirect()->route('homepage');
        }
       		return redirect()->back();
    }


    public function getLogout(){
    	Auth::logout(); 
    	return redirect()->route('home');
    }

 	public function getAccount(){
 		return view('account', ['user' => Auth::user()]);
 	}

 	public function postUpdateAccount(Request $request){
 		$this->validate($request, [
 			'name' => 'required|max:120'
 		]);

 		$user = Auth::user();
 		$user->name = $request['name'];
 		$user->update();
 		$file = $request->file('image');
 		$filename = $user->id .'.jpg';
 		if($file){
 			Storage::disk('local')->put($filename, File::get($file));
 		}
 		return redirect()->route('account');
 	}

 	public function getUserImage($filename){
 		$file = Storage::disk('local')->get($filename);
 		return new Response($file, 200);
 	}
}

