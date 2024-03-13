<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMediaProgress extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function mediaItem()
    {
        return $this->belongsTo(MediaItem::class, 'media_id');
    }
}
