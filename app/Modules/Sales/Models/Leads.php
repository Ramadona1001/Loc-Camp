<?php

namespace Sales\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Leads extends Model
{
    protected $table = 'leads';


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
