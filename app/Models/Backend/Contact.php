<?php

namespace App\Models\Backend;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'isShown',
        'status',
    ];

    protected $searchableFields = ['*'];

    public static function createContact($request)
    {
        static::create($request->all());
    }
}
