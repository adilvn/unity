<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{

    // Donator
    public function createDonator(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'store_name' => 'required',
            'store_location' => 'required',
            'pcode' => 'required',
            'country' => 'required',
            'user_type' => 'required|not_in:0',
            'password' => ['required', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()],
            'cpassword' => 'required|same:password'
        ]);

        $u_type = 0;
        if ($request->user_type == 1) {
            # code...
            $u_type = 2;
        } else {
            $u_type = 3;
        }

        if (User::where('email', '=', $request->email)->exists() || User::where('username', '=', "unity@" . $request->username)->exists()) {
            # code...
            $request->session()->flash('donator-register-error', 'User already exists with this Username or Email');
            return back()->withInput();
        } else {
            # code...
            $user = User::create([
                'username' => "unity@" . str_replace(' ', '', $request->username),
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'phone' => $request->phone,
                'store_name' => $request->store_name,
                'store_location' => $request->store_location,
                'pcode' => $request->pcode,
                'country' => $request->country,
                'user_type' => $u_type,
                'status' => 1,
                'password' => Hash::make($request->password)
            ]);
            if ($user) {
                # code...
                $request->session()->flash('donator-register-success', 'Welcome to Donator Dashboard');
                Auth::attempt(['email' => $request->email, 'password' => $request->password]);
                if (Auth::user()->user_type == 2) {
                    # code...
                    return redirect()->route('home');
                }
                if (Auth::user()->user_type == 3) {
                    # code...
                    return redirect()->route('donator-profile');
                }
            } else {
                # code...
                $request->session()->flash('donator-register-error', 'Something Went Wrong, Please Try Again');
                return redirect()->back();
            }
        }
    }


    public function updateDonator(Request $request)
    {
        # code...
        $request->validate([
            'avatar_img' => 'image|max:2048|mimes:jpg,png,jpeg,gif,svg',
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'store_name' => 'required',
            'store_location' => 'required',
            'pcode' => 'required',
            'country' => 'required',
        ]);

        $user = User::find(Auth::user()->id);
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->store_name = $request->store_name;
        $user->store_location = $request->store_location;
        $user->pcode = $request->pcode;
        $user->country = $request->country;

        if ($request->file('avatar_img')) {
            $file = $request->file('avatar_img');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $imgname = uniqid() . $filename;
            $destinationPath = public_path('/images/profile_images');
            $file->move($destinationPath, $imgname);
            if (null != Auth::user()->profile_pic) {
                $image_path = "user_profile_images/" . Auth::user()->profile_pic;  // Value is not URL but directory file path
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }
            $user->profile_pic = $imgname;
        }

        if (Auth::user()->email == $request->email) {
            # code...
            $user->save();
            $request->session()->flash('donator-update-success', 'Profile Updated Successfully');
            return redirect()->route('donator-profile');
        } else {
            if (User::where('email', '=', $request->email)->exists()) {
                # code...
                $request->session()->flash('donator-update-error', 'Donator already exists with this Email');
                return back()->withInput();
            } else {
                $user->save();
                $request->session()->flash('donator-update-success', 'Profile Updated Successfully');
                return redirect()->route('donator-profile');
            }
        }
    }

    public function updateDonatorImg(Request $request)
    {
        # code...
        $request->validate([
            'avatar_img' => 'image|max:2048|mimes:jpg,png,jpeg,gif,svg',
        ]);
        $user = User::find(Auth::user()->id);
        if ($request->file('avatar_img')) {
            $file = $request->file('avatar_img');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $imgname = uniqid() . $filename;
            $destinationPath = public_path('/images/profile_images');
            $file->move($destinationPath, $imgname);
            if (null != Auth::user()->profile_pic) {
                $image_path = "user_profile_images/" . Auth::user()->profile_pic;  // Value is not URL but directory file path
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }
            $user->profile_pic = $imgname;
        }
        $user->save();
        $request->session()->flash('donator-update-success', 'Profile Updated Successfully');
        return redirect()->route('donator-profile');
    }

    public function showDonators()
    {
        $users = User::where('user_type', 3)->get();
        return view('admin.content.donators', compact('users'));
    }

    public function updateDonatorStatus($id)
    {
        $user = User::find($id);
        if (!is_null($user)) {
            if ($user->status == 0) {
                $user->status = 1;
                $user->save();
                return redirect()->route('show-donators');
            } else if ($user->status == 1) {
                $user->status = 0;
                $user->save();
                return redirect()->route('show-donators');
            }
        } else {
            return redirect()->route('show-donators');
        }
    }

    public function deleteDonator(Request $request, $id)
    {
        $user = User::find($id);
        $user->delete();
        $request->session()->flash('donator-delete', 'Donator has been deleted!');
        return redirect()->back();
    }


    // Business
    public function createBusiness(Request $request)
    {
        $request->validate([
            'busername' => 'required',
            'bfname' => 'required',
            'blname' => 'required',
            'bemail' => 'required|email',
            'bphone' => 'required',
            'bstore_name' => 'required',
            'bstore_location' => 'required',
            'bpcode' => 'required',
            'bcountry' => 'required',
            'bpassword' => ['required', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()],
            'bcpassword' => 'required|same:bpassword'
        ]);

        if (User::where('email', '=', $request->bemail)->exists() || User::where('username', '=', "unity@" . $request->busername)->exists()) {
            # code...
            $request->session()->flash('business-register-error', 'Business already exists with this Username or Email');
            return back()->withInput();
        } else {
            # code...
            $user = User::create([
                'username' => "unity@" . str_replace(' ', '', $request->busername),
                'fname' => $request->bfname,
                'lname' => $request->blname,
                'email' => $request->bemail,
                'phone' => $request->bphone,
                'store_name' => $request->bstore_name,
                'store_location' => $request->bstore_location,
                'pcode' => $request->bpcode,
                'country' => $request->bcountry,
                'user_type' => 4,
                'password' => Hash::make($request->bpassword),
                'status' => 0,
            ]);
            if ($user) {
                # code...
                $request->session()->flash('business-register-success', 'Welcome to Business Dashboard');
                Auth::attempt(['email' => $request->bemail, 'password' => $request->bpassword]);
                return redirect()->route('business-profile-check');
            } else {
                # code...
                $request->session()->flash('business-register-error', 'Something Went Wrong, Please Try Again');
                return redirect()->back()->withInput();
            }
        }
    }

    public function updateBusiness(Request $request)
    {
        # code...
        $request->validate([
            'avatar_img' => 'image|max:2048|mimes:jpg,png,jpeg,gif,svg',
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'store_name' => 'required',
            'store_location' => 'required',
            'pcode' => 'required',
            'country' => 'required',
        ]);

        $user = User::find(Auth::user()->id);
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->store_name = $request->store_name;
        $user->store_location = $request->store_location;
        $user->pcode = $request->pcode;
        $user->country = $request->country;

        if ($request->file('avatar_img')) {
            $file = $request->file('avatar_img');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $imgname = uniqid() . $filename;
            $destinationPath = public_path('/images/profile_images');
            $file->move($destinationPath, $imgname);
            if (null != Auth::user()->profile_pic) {
                $image_path = "user_profile_images/" . Auth::user()->profile_pic;  // Value is not URL but directory file path
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }
            $user->profile_pic = $imgname;
        }

        if (Auth::user()->email == $request->email) {
            # code...
            $user->save();
            $request->session()->flash('business-update-success', 'Profile Updated Successfully');
            return redirect()->route('business-profile');
        } else {
            if (User::where('email', '=', $request->email)->exists()) {
                # code...
                $request->session()->flash('business-update-error', 'Business already exists with this Email');
                return back()->withInput();
            } else {
                $user->save();
                $request->session()->flash('business-update-success', 'Profile Updated Successfully');
                return redirect()->route('business-profile');
            }
        }
    }

    public function businessPayment()
    {
        # code...
        return view('business.content.payment-details');
    }

    public function showBusinesses()
    {
        $users = User::where('user_type', 4)->get();
        return view('admin.content.businesses', compact('users'));
    }

    public function updateBusinessesStatus($id)
    {
        $user = User::find($id);
        if (!is_null($user)) {
            if ($user->status == 0) {
                $user->status = 1;
                $user->save();
                return redirect()->route('show-businesses');
            } else if ($user->status == 1) {
                $user->status = 0;
                $user->save();
                return redirect()->route('show-businesses');
            }
        } else {
            return redirect()->route('show-businesses');
        }
    }

    public function deleteBusinesses(Request $request, $id)
    {
        $user = User::find($id);
        $user->delete();
        $request->session()->flash('businesses-delete', 'Business User has been deleted!');
        return redirect()->back();
    }




    //Admin
    public function loginSuperAdmin(Request $request)
    {
        # code...
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials, $request->remember)) {
            if (Auth::user()->user_type == 0 || Auth::user()->user_type == 1) {
                # code...
                if (Auth::user()->status == 1) {
                    # code...
                    $request->session()->flash('admin-logged-in', 'Welcome Back To Unity Dashboard');
                    return redirect()->intended(route('admin-dashboard'));
                } else {
                    # code...
                    $request->session()->flash('admin-login-error', 'This Account Has Been Disabled');
                    Auth::logout();
                    return redirect()->back();
                }
            } else {
                $request->session()->flash('admin-login-error', 'This Account Has Not Admin Role');
                Auth::logout();
                return redirect()->back();
            }
        } else {
            $request->session()->flash('admin-login-error', 'Given Credentials Are Not Valid');
            return redirect()->back();
        }
    }

    public function createAdmin()
    {
        return view('admin.content.createAdmin');
    }

    public function storeAdmin(Request $request)
    {
        $request->validate(
            [
                'username' => 'required|unique:users,username',
                'fname' => 'required',
                'lname' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => ['required', Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()],
            ],
            [
                'username.required' => 'Username is required*',
                'fname.required' => 'First Name is required*',
                'lname.required' => 'Last Name is required*',
                'email.required' => 'Email is required*',
                'password.required' => 'Password is required*',
            ]
        );

        $user = User::create([
            'username' => $request->username,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 1,
            'status' => 1,
        ]);
        $request->session()->flash('success', 'Admin created successfully!');
        return redirect()->back();
        // return response()->json(['success' => 'Created successfully!']);
    }


    public function getAdmins()
    {
        # code...
        $users = User::where('user_type', 1)->get();
        return view('admin.content.admins', compact('users'));
    }

    public function updateAdminStatus($id)
    {
        # code...
        $user =  User::find($id);
        if (!is_null($user)) {
            if ($user->status == 0) {
                $user->status = 1;
                $user->save();
                return redirect()->route('get-admins');
            } else
            if ($user->status == 1) {
                $user->status = 0;
                $user->save();
                return redirect()->route('get-admins');
            } else {
                return redirect()->route('get-admins');
            }
        } else {
            return redirect()->route('get-admins');
        }
    }

    public function editAdmin(Request $request, $id)
    {
        $user = User::find($id);
        return view('admin.content.createAdmin', compact('user'));
    }

    public function updateAdmin(Request $request, $id)
    {
        $user = User::find($id);
        $user->username = $request->username;
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->password = Hash::make($request->fname);
        $user->update();
        return redirect()->back()->with('success', 'Updated Successfully!');
    }

    public function deleteAdmin(Request $request, $id)
    {
        $user = User::find($id);
        $user->delete();
        $request->session()->flash('admin-delete', 'Admin has been deleted!');
        return redirect()->route('get-admins');
    }

    public function visitorLogin(Request $request)
    {
        # code...
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials, $request->remember)) {
            if (Auth::user()->user_type == 2 || Auth::user()->user_type == 3 || Auth::user()->user_type == 4) {
                # code...
                if (Auth::user()->status == 1) {
                    # code...
                    if (Auth::user()->user_type == 2) {
                        $request->session()->flash('visitor-register-success', 'Welcome To Unity Dashboard');
                        return redirect()->route('home');
                    }
                    if (Auth::user()->user_type == 3) {
                        $request->session()->flash('donator-register-success', 'Welcome To Unity Dashboard');
                        $carts = Cart::where('mac', strtok(exec('getmac'), ' '))->where('user_id', -1)->get();
                        foreach ($carts as $cart) {
                            $cart->user_id = Auth::user()->id;
                            $cart->save();
                            # code...
                        }
                        return redirect()->route('donator-profile');
                    }
                    if (Auth::user()->user_type == 4) {
                        $request->session()->flash('business-register-success', 'Welcome To Unity Dashboard');
                        return redirect()->route('business-profile');
                    }
                } else {
                    # code...
                    $request->session()->flash('user-login-error', 'This Account Has Not Been Verified');
                    Auth::logout();
                    return redirect()->back();
                }
            } else {
                $request->session()->flash('user-login-error', 'Given Credentials Are Not Valid');
                Auth::logout();
                return redirect()->back();
            }
        } else {
            $request->session()->flash('admin-login-error', 'Given Credentials Are Not Valid');
            return redirect()->back();
        }
    }
    public function visitorLogout()
    {
        Auth::logout();
        return redirect(route('home'));
    }

    public function userLogout()
    {
        # code...
        Auth::logout();
        return redirect(route('home'));
    }
}
