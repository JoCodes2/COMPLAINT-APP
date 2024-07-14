<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentification\AuthRequest;
use App\Http\Requests\AuthRequest as RequestsAuthRequest;
use App\Repositories\AuthRepositories;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authRepo;

    public function __construct(AuthRepositories $authRepo)
    {
        return $this->authRepo = $authRepo;
    }

    public function login(RequestsAuthRequest $request)
    {
        return $this->authRepo->login($request);
    }

    public function logout(Request $request)
    {
        return $this->authRepo->logout($request);
    }
}
