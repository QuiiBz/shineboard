<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paste extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['slug', 'user', 'language', 'title', 'code'];
}
