<?php

namespace App\Repositories;

use App\Http\Requests\Authentification\AuthRequest;
use App\Http\Requests\AuthRequest as RequestsAuthRequest;
use App\Interfaces\AuthInterfaces;
use App\Models\User;
use App\Traits\HttpResponseTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthRepositories implements AuthInterfaces
{

    use HttpResponseTraits;
    protected $userModel;

    public function __construct(User $userModel)
    {
        return $this->userModel = $userModel;
    }
    public function login(RequestsAuthRequest $request)
    {
        // Mendapatkan waktu saat ini dalam zona waktu Indonesia Tengah
        $now = now()->setTimezone('Asia/Makassar');

        $allowedStartTime = $now->copy()->setTime(16, 0, 0);
        $allowedEndTime = $now->copy()->setTime(24, 0, 0);

        if (!$now->isBetween($allowedStartTime, $allowedEndTime)) {
            return response()
                ->json(['message' => 'Login hanya diizinkan dari jam 8 pagi sampai jam 4 sore WITA.'], 403);
        }

        if (!Auth::attempt($request->only('username', 'password'))) {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $user = $this->userModel::where('username', $request['username'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->success([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }



    public function logout(Request $request)
    {
        try {
            $request->user('web')->tokens()->delete();

            Auth::guard('web')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return $this->success();
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400, $th, class_basename($this), __FUNCTION__);
        }
    }
}
