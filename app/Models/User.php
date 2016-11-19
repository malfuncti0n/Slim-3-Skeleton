<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'email',
        'name',
        'password',
        'token',
        'verified',
        'groupid'
    ];

    public function setPassword($password){
        $this->update([
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);
    }
    public function setVerified($id, $code){
        $this->where('id', $id)->where('token', $code)->update([
            'verified' => '1',
        ]);
    }
    public function users(){
        return $this->orderBy('id','asc')->get();
    }

    public function deleteUsers($id){
        $this->whereIn('id', $id)->delete();
    }
}