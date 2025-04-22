<?php


namespace App\helper;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Carbon;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Xenon\LaravelBDSms\Facades\SMS;

class ViewHelper
{
    protected static $loggedUser, $courseOrder, $examOrder,$examOrders = [], $subscriptionPackage, $subscriptionOrder, $status = 'false';

    public static function checkViewForApi ($data=[], $viewPath = null, $jsonErrorMessage = null, $redirectToUrl = false, $redirectUrl = null)
    {
        if (str()->contains(url()->current(), '/api/'))
        {
                if (empty($data))
                {
                    return response()->json(isset($jsonErrorMessage) ? $jsonErrorMessage : 'Something went wrong. Please try again.', 400);
                }
                return response()->json($data, 200);

        } else {
            if ($redirectToUrl)
            {
                return redirect(url('/'.$redirectUrl));
            }
            return view($viewPath, $data);
        }
    }

    public static function returEexceptionError ($message = null)
    {
        if (str()->contains(url()->current(), '/api/'))
        {
            return response()->json(['error' => $message], 400);
        } else {
            Toastr::error($message);
            return redirect()->back();
//            return back()->with('error', $message);
        }
    }
    public static function returnSuccessMessage ($message = null)
    {
        if (str()->contains(url()->current(), '/api/'))
        {
            return response()->json(['success' => $message], 200);
        } else {
            Toastr::success($message);
//            return back()->with('success', $message);
            return back();
        }
    }

    public static function authCheck()
    {
        if (str_contains(url()->current(), '/api/'))
        {
            return auth('sanctum')->check();
        } else {
            return auth()->check();
        }
    }

    public static function loggedUser()
    {
        if (str_contains(url()->current(), '/api/'))
        {
            $user = auth('sanctum')->user();
        } else {
            $user = auth()->user();
        }
        return  $user->load('area', 'orders');
    }

    public static function sendNotification($notificationArray = ['title' => 'Hello from E-Bazar!','body' => 'This is a test notification.'])
    {
        $firebase = (new Factory)->withServiceAccount(public_path('firebase_credentials.json'));
        $messaging = $firebase->createMessaging();

        $message = CloudMessage::fromArray([
            'notification' => $notificationArray,
            'topic' => 'global'
        ]);

        $messaging->send($message);
    }

    public static function sendSmsToUsers($numberString = '01646688970', $message = 'Hello from E-Bazar')
    {
        try {
            SMS::shoot($numberString, $message);
            return 'success';
        } catch (\Exception $exception)
        {
            return $exception->getMessage();
        }
    }
}
