<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class History
 * @package App
 */
class History extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contact',
        'type',
        'followUp',
        'links',
    ];
}
