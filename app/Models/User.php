<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public const UPDATED_AT = null;

    protected $with = ['position:id,name'];

    protected $casts = [
        'created_at' => 'timestamp',
    ];

    public function getPhotoAttribute($value)
    {
        return env('APP_URL').env('PORT').env('IMAGES_PATH').$value;
    }

    public function position()
    {
        return $this->belongsTo(Positions::class);
    }
}
