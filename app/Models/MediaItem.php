<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function userMediaProgress()
    {
        return $this->hasOne(UserMediaProgress::class, 'media_id', 'id')->where('user_id', auth()->id());
    }
}
