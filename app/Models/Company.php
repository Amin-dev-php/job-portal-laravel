<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'cname', 'user_id', 'slug', 'address', 'phone', 'website', 'logo', 'cover_photo', 'slogan', 'description'
    ];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
