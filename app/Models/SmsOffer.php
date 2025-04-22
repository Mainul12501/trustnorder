<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsOffer extends Model
{
    protected $fillable = [
        'common_message',
        'target_user',
        'status',
    ];

    public static function createOrUpdateSmsOffer($request, $offerId = null)
    {
        return SmsOffer::updateOrCreate(['id' => $offerId], [
            'common_message'    => $request->common_message,
            'target_user'    => $request->target_user ?? 'user',
            'status' => $request->status == 'on' ? 1 : 0,
        ]);
    }
}
