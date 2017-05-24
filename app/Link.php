<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\LinkCreated;

class Link extends Model
{
    protected $fillable = [
        'url', 'cover', 'title', 'description',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $events = [
        'created' => LinkCreated::class,
    ];

    public function tweets()
    {
        return $this->hasMany('App\Tweet', 'link_id');
    }
}
