<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserByCountryName($search)
    {
        if(!$search){
            abort(404);
        }

        $user = $this->userRepository->findByField('name',$search);
        if(count($user)){
            return $user;
        }
        else{
            return response()->json([
                'result' => 'no-result',
            ]);
        }
    }
}
