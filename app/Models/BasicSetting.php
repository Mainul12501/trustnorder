<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BasicSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_title',
        'site_description',
        'meta_title',
        'meta_description',
        'favicon',
        'logo',
        'phone',
        'address',
        'email',
        'corporate_office',
        'fb',
        'insta',
        'whatsapp',
        'linkedin',
        'skype',
        'site_moto',
        'seo_header',
        'seo_footer',
        'status',
        'delivery_charge',
    ];


    protected $table = 'basic_settings';

    public static function createOrUpdateBasicSettings($request, $id = null)
    {
        if (isset($id))
            $basicSetting   = BasicSetting::find($id);
        else
            $basicSetting = new BasicSetting();


        $basicSetting->site_title   = $request->site_title;
        $basicSetting->site_description = $request->site_description;
        $basicSetting->meta_title   = $request->meta_title;
        $basicSetting->meta_description = $request->meta_description;
        $basicSetting->favicon  = fileUpload($request->file('favicon'), 'site-images', 'favicon-', isset($id) ? static::find($id)->favicon : null);
        $basicSetting->logo = fileUpload($request->file('logo'), 'site-images', 'favicon-', isset($id) ? static::find($id)->logo : null);
        $basicSetting->phone    = $request->phone;
        $basicSetting->address  = $request->address;
        $basicSetting->email    = $request->email;
        $basicSetting->corporate_office = $request->corporate_office;
        $basicSetting->fb   = $request->fb;
        $basicSetting->insta    = $request->insta;
        $basicSetting->whatsapp = $request->whatsapp;
        $basicSetting->linkedin = $request->linkedin;
        $basicSetting->skype    = $request->skype;
        $basicSetting->site_moto    = $request->site_moto;
        $basicSetting->seo_header   = $request->seo_header;
        $basicSetting->seo_footer   = $request->seo_footer;
        $basicSetting->delivery_charge   = $request->delivery_charge;
        $basicSetting->status   = 1;
        $basicSetting->save();
        return $basicSetting;
    }
}
