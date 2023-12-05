<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
        'video_title', 'video_link', 'video_desc','video_slug','video_images'
    ];

    protected $primaryKey = 'video_id';
    protected $table = 'tbl_videos';
}
