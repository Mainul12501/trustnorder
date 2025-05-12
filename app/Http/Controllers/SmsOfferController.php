<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\SmsOffer;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Xenon\LaravelBDSms\Facades\SMS;

class SmsOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('backend.sms-offer.index', ['offers' => SmsOffer::latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('backend.sms-offer.create', ['isShown' => false]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'common_message'  => 'required',
        ]);
        try {
            DB::transaction(function () use ($request){
                SmsOffer::createOrUpdateSmsOffer($request);
            });
            Toastr::success('Offer created successfully.');
            return back();
        } catch (\Exception $exception)
        {
            Toastr::error($exception->getMessage());
            return back()/*->with('error', $exception->getMessage())*/;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SmsOffer $smsOffer)
    {
        return view('backend.sms-offer.create', ['offer' => $smsOffer, 'isShown' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SmsOffer $smsOffer, Request $request)
    {
        return view('backend.sms-offer.create', ['offer' => $smsOffer, 'isShown' => false ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'common_message'  => 'required',
        ]);

        try {
            DB::transaction(function () use ($request, $id){
                SmsOffer::createOrUpdateSmsOffer($request, $id);
            });
            Toastr::success('Offer updated successfully.');
            return redirect(route('sms-offers.index'));
        } catch (\Exception $exception)
        {
            Toastr::error($exception->getMessage());
            return back()->with('error', $exception->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SmsOffer $smsOffer)
    {
//        GasStationEmployee::find($id)->delete();

        $smsOffer->delete();
        return back()->with('success', 'Offer deleted successfully.');
    }

    public function sendOfferToUsers(SmsOffer $smsOffer, Request $request)
    {

        try {
            $numberString = '';
            $mobileNumbers = User::where(['role' => 'user'])->get(['mobile']);
            foreach ($mobileNumbers as $number)
            {
//                $numberString .= $number->mobile.',';
                SMS::shoot($number->mobile, $smsOffer->common_message);
            }
//            SMS::shoot($numberString, $smsOffer->common_message);
            Toastr::success('Offer send to all users successfully.');
            return back();
        } catch (\Exception $exception)
        {
            Toastr::error($exception->getMessage());
            return back();
        }
        Toastr::error('Something went wrong. Please try again');
        return back();
    }
}
