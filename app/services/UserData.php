<?php

namespace App\Services;
use App\Models\User;
class UserData{


    public function create($data){
        $user= User::create($data);
        return $user;
    }
    
    public function update($data, $id){
        $user = User::findOrfail($id);
        $user->update($data);
        return $user;
    }
     
    

}