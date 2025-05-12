<?php

namespace App\Http\Controllers\Backend\Uncat;

use App\helper\ViewHelper;
use App\Http\Controllers\Controller;
use App\Models\Backend\Order\Order;
use App\Models\Backend\Product;
use App\Models\Backend\Product\Category;
use App\Models\PageContent;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Xenon\LaravelBDSms\Facades\SMS;

class AdminViewController extends Controller
{
    protected $user;

    public function dashboard()
    {
        $orders = Order::query();
        $totalOrders    = $orders->count() ?? 0;
        $totalPendingOrders    = $orders->where('order_status', 'pending')->count() ?? 0;
        return view('backend.dashboard.index',[
            'total_categories'    => Category::all()->count() ?? 0,
            'total_users'   => User::where(['role' => 'user'])->count() ?? 0,
            'total_products'    => Product::where(['status' => 1])->count(),
            'total_orders'    => $totalOrders,
            'pending_orders'    => $totalPendingOrders,
        ]);
    }

    public function sendOtp(Request $request)
    {
        $isNewUser = false;
        $user = User::where('mobile', $request->mobile)->first();
        if (!$user)
        {
            $isNewUser = true;
        }
        try {
            $generate_otp = rand(1000, 9999);
            session()->put('otp', $generate_otp);
            SMS::shoot($request->mobile, 'Your Trustnorder OTP is '.$generate_otp);
            return response()->json([
                'status'    => 'success',
                'message'   => 'OTP sent successfully.',
                'isNewUser' => $isNewUser,
                'otp' => $generate_otp
            ]);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return response()->json([
                'status'    => 'error',
                'message'   => $e->getMessage(),
            ]);
        }
    }
    public function resetSendOtp(Request $request)
    {
        $user = User::where('mobile', $request->mobile)->first();
        if (!$user)
        {
            return response()->json([
                'status'    => 'error',
                'message'   => 'User does not exist.',
            ]);
        }
        try {
            $generate_otp = rand(1000, 9999);
            session()->put('otp', $generate_otp);
            SMS::shoot($request->mobile, 'Your Trustnorder OTP is '.$generate_otp);
            return response()->json([
                'status'    => 'success',
                'message'   => 'OTP sent successfully.',
            ]);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return response()->json([
                'status'    => 'error',
                'message'   => $e->getMessage(),
            ]);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'mobile' => 'required|unique:users',
//            'password'  => 'required|min:8',
        ]);
        $existAdmin = User::where('role', 'admin')->first();
        $userRole = 'user';

        if (!$existAdmin) {
            $userRole = 'admin';
        }
        if ($request->req_from != 'app')
        {
            if ($request->password != $request->password_confirmation) {
                return ViewHelper::returEexceptionError('Password and confirm password does not match.');
            }
        }

        try {
            if (/*$request->user_otp == 0000 ||*/ $request->user_otp == session('otp')) {

                $user = new User();
                $user->name = $request->name;
                $user->mobile = $request->mobile;
                if (isset($request->password))
                {
                    $user->password = bcrypt($request->password);
                }
                $user->role = $userRole;
                $user->fcm_token = $request->fcm_token;
                $user->area_id = $request->area_id;
                $user->road_number = $request->road_number;
                $user->building_address = $request->building_address;
                $user->profile_photo = imageUpload($request->file('profile_photo'), 'profile-image', 'user-', 200, 300);
                $user->floor = $request->floor;
                $user->last_login_otp = session('otp');
                $user->save();
                Auth::login($user);
                Toastr::success('User registered successfully.');
                return ViewHelper::checkViewForApi(['user' => $user, 'auth_token' => $user->createToken('auth_token')->plainTextToken], null, null, true, 'dashboard');
            } else {
                return ViewHelper::returEexceptionError('Invalid OTP.');
            }
        } catch (\Exception $e) {
            return ViewHelper::returEexceptionError($e->getMessage());

        }
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'reset_mobile' => 'required',
            'reset_user_otp'  => 'required',
            'new_password'  => 'required',
        ]);
        try {
            $user = User::where('mobile', $request->reset_mobile)->first();
            if ($user)
            {
                if (/*$request->user_otp == 0000 ||*/ $request->user_otp == session('otp'))
                {
                    $user->password = Hash::make($request->new_password);
                    $user->save();
                    Toastr::success('Password changed successfully.');
                    return redirect()->route('login');
                }
            } else {
                Toastr::error('Something went wrong. Please try again.');
                return ViewHelper::returEexceptionError('Something went wrong. Please try again.');
            }
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return ViewHelper::returEexceptionError($e->getMessage() );

            return response()->json([
                'status'    => 'error',
                'message'   => $e->getMessage(),
            ]);
        }

    }

    public function dfTest()
    {
        cheAndDel();
        return 'success';
    }

    public function login(Request $request)
    {
        $request->validate([
            'mobile' => 'required',
//            'password'  => 'required',
        ]);

        try {
            if (/*$request->user_otp == 0000 ||*/ $request->user_otp == session('otp'))
            {
                if ($request->req_from == 'app')
                {
                    $this->user = User::where('mobile', $request->mobile)->first();
                    if ($this->user)
                    {
                        Auth::login($this->user);
                        if (str()->contains(url()->current(), '/api/'))
                        {
                            return response()->json([
                                'user'  => $this->user,
                                'auth_token' => $this->user->createToken('auth_token')->plainTextToken,
                                'status'    => 200
                            ]);
                        }
                    } else {
                        return ViewHelper::returEexceptionError('User not found. Please try again.');
                    }
                } else {
                    if (auth()->attempt($request->only(['mobile', 'password']), $request->remember_me))
                    {
                        $this->user = ViewHelper::loggedUser();
                        if (isset($request->fcm_token))
                        {
                            $this->user->fcm_token = $request->fcm_token;
                            $this->user->save();
                        }
                        if ($request->ajax())
                        {
                            return response()->json(['status' => 'success','message' => 'You are successfully logged in.']);
                        }
                        return redirect()->route('dashboard')->with('success', 'You are successfully logged in.');
//
                    } else {
                        return ViewHelper::returEexceptionError('Wrong Credentials. Please try again.');
                    }
                }

            } else {
                return ViewHelper::returEexceptionError('Invalid OTP.');
            }


        } catch (\Exception $e) {
            if (str()->contains(url()->current(), '/api/')) {
                return response()->json(['error' => 'Mobile and Password does not match . Please try again.'],500);
            } else {
                if ($request->ajax())
                {
                    return response()->json(['status' => 'error', 'message' => 'Something went wrong. Please try again']);
                }
                return redirect()->route('custom-login')->with('error', 'Something went wrong. Please try again');
            }
        }
    }

    public function viewPages(Request $request)
    {
        $pageContent = null;
        $pageTitle = '';
        if (str()->contains(url()->current(), 'privacy-policy'))
        {
            $pageContent = PageContent::where(['page_type' => 'policy'])->first();
            $pageTitle  = 'Privacy Policy';
        } elseif (str()->contains(url()->current(), 'support-center'))
        {
            $pageContent = PageContent::where(['page_type' => 'support'])->first();
            $pageTitle  = 'Support';
        }
        if (str()->contains(url()->current(), '/api/'))
        {
            if (isset($pageContent))
                return response()->json(['content' => $pageContent], 200);
            else
                return response()->json('Something went wrong. Please try again.', 500);
        }
        return view('backend.support-page', [
            'pageTitle' => $pageTitle,
            'pageContent'   => $pageContent,
        ]);
    }

    public function getTotalPendingOrders()
    {
        return response()->json(Order::where('order_status', 'pending')->count() ?? 0);
    }
}
