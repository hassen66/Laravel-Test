<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * Find a user by field value
     *
     * @param [String] $field
     * @param [String] $value
     * @return \App\Models\User
     */
    public function findByField($field, $value)
    {
        return User::with('companies')->whereHas('companies',function($query) use($field,$value){
            $query->whereHas('country',function($q) use($field,$value){
                $q->where($field,$value);
            });
        })->get();
    }
	
}