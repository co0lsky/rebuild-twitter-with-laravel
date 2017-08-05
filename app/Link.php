<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'url', 'cover', 'title', 'description',
    ];

    public function tweets()
    {
        return $this->hasMany('App\Tweet', 'link_id');
    }
}
