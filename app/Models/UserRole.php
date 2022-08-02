<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    /*
    |----------------------------------------------------------------------------------
    | User Relationship  To User Role
    |----------------------------------------------------------------------------------
    */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /*
    |----------------------------------------------------------------------------------
    | Role Relationship  To User Role
    |----------------------------------------------------------------------------------
    */
    public function role(){
        return $this->belongsTo(Role::class);
    }
    
    /*
    |----------------------------------------------------------------------------------
    | Hidden ID
    |----------------------------------------------------------------------------------
    */
    protected $hidden =[
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'user_id',
        'role_id'
    ];
}
