<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CateWeb extends Model
{
    protected $table = 'cate_web';
    protected $guarded = [''];

    const STATUS_PUBLIC = 1;
    const STATUS_PRIVATE = 0;

}
