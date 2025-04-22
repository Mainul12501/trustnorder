<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'district_id',
        'district_name',
        'area_name',
        'description',
        'status',
    ];

    public static function createOrUpdateArea($request, $areaId = null)
    {
       return Area::updateOrCreate(['id' => $areaId], [
           'district_id'    => $request->district_id,
           'district_name'  => $request->district_name,
           'area_name'  => $request->area_name,
           'description'  => $request->description,
           'status' => $request->status == 'on' ? 1 : 0,
       ]);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
