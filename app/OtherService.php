<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherService extends Model
{
    protected $table = 'other_service';
    protected  $guarded = [''];

    const STATUS_PUBLIC = 1;
    const STATUS_PRIVATE = 0;

}
