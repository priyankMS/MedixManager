<?php

namespace App\Services;

use App\Models\User;

class UserService
{

    public function getAll($request, $pagination = true)
    {
        $search = (isset($request->search) && !blank($request->search)) ? $request->search : null;

        $data = User::where(function ($query) use ($search) {
            $query->where('firstname', 'Like', '%' . $search . '%')
                ->orWhere('lastname', 'Like', '%' . $search . '%');
        })->orderBy('id', 'desc');
        if ($pagination) {
            $data->paginate('10');
        } else {
            $data->get();
        }
        return $data;
    }

    public function create($data){
        return User::create($data);
    }
}
