<?php
namespace SimpleFinance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleFinance\Http\Requests;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function edit() {
        return view('user/edit');
    }

    public function update(Request $request) {
        $user = Auth::user();

        $this->validate($request, [
            'email' => 'required|email|max:255',
            'name' => 'required',
            'password' => 'required_with:newpassword'
        ]);

        if($request->newpassword) {
            if (Hash::check($request->password, Auth::user()->password)) {
                $user->password = Hash::make($request->newpassword);
            }
        }

        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();

        return redirect('user')->with('status', 'User updated!');
    }
}
