<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class);
    }
    protected $fillable = ['title', 'slug', 'shortcontent',  'longcontent', 'photo', 'post_status', 'post_outstand', 'view'];
}
