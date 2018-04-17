<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //

	public function index($id){
		$user = User::find($id);
		return view('profile', [
			'user'=>$user,
		]);
	}

	public function edit($id){
		$user = User::find($id);
		return $user;
	}

	public function update(Request $request, $id){
		if (Auth::user()->id === $id) {
			$arr = [
				'first_name' => $request->first_name,
				'last_name' => $request->last_name,
				'phone' => $request->phone,
				'email' => $request->email,
				'address' => $request->address,
				'gender' => $request->gender,
			];
			User::where('id', $id)->update($arr);
			$user = User::find($id);
			return $user;
		}
	}

	public function changepassword(Request $request, $id){
		if (Auth::user()->id === $id) {
			$old_password = $request->old_password;
			$new_password = $request->new_password;
			$new_password1 = $request->new_password1;
			if (Hash::check($old_password, Auth::user()->password)) {
				if ($new_password === $new_password1) {
					$pass = Hash::make($new_password);
					User::where('id', $id)->update([
						'password' => $pass
					]);
					return $user = User::find($id);
				}
			}
		}
	}

	public function avatar(Request $request, $id){
		if (Auth::user()->id === $id) {
			$avatar = $request->avatar;
			$arr =['avatar'=>$avatar];
			User::where('id',$id)->update($arr);
			$user = User::find($id);
			return $user;
		}
	}

	public function destroy($id){
		if (Auth::user()->id === 2 && $id!= 2) {
			User::where('id', $id)->delete();
			return 'true';
		}
	}


}
