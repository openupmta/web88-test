<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Web extends Model
{
    protected $table = 'web';
    protected  $guarded = [''];

    const STATUS_PUBLIC = 1;
    const STATUS_PRIVATE = 0;

    public function category()
    {
        return $this->belongsTo(CateWeb::class,'cate_id');
    }
}
