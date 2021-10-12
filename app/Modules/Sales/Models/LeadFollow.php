<?php

namespace Sales\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class LeadFollow extends Model
{
    protected $table = 'leads_follows';


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lead()
    {
        return $this->belongsTo(Leads::class, 'lead_id');
    }
}
