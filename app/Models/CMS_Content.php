<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CMS_Content extends Model
{
    use HasFactory;
    protected $guarded = [];

    // accessor of image attribute
    public function getImageUrlAttribute($value) {
        return $value ? asset('storage/'.$value) : null;
    }
}
