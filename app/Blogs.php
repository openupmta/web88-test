<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    protected $table = 'blogs';
    protected $guarded = [''];

    const STATUS_PUBLIC = 1;
    const STATUS_PRAVITE = 0;

}
