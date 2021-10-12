<?php

namespace Departments\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class DepartmentManager extends Model
{
    protected $table = 'department_mangers';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
