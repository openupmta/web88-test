<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class web_users extends Authenticatable
{
    protected $table='web_users';

    protected $primaryKey=['users_id','web_id'];

    protected $fillable = [
        'users_id', 'web_id', 'title','content'
    ];

    public function users()
    {
        return $this->belongsTo('App\Model\users','users_id');
    }

    public function web()
    {
        return $this->belongsTo('App\Model\web','web_id');
    }

}
