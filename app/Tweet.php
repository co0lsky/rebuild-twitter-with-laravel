<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    // variable must is fill
    protected $fillable = [
      'user_id', 'body',
    ];

    // methods for custom change format datetime like timeline in twitter
    public function getCreatedAtAttribute($value) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->diffForHumans();
    }

    // methods for view author from tweet in timeline
    public function author()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
