<?php

namespace App\Repository\Personal;


use App\Http\Requests\Personal\Real\ParamsRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UserRepository
{

    public function updateMyEmail(string $email)
    {

        return auth()->user()->update([
            'email' => $email, 'email_verified_at' => null
        ]);

    }

    public function changeMyPassword(string $password)
    {
        return auth()->user()->update([
            'password' => bcrypt($password)
        ]);
    }

    public function updateAvatar(UploadedFile $avatar)
    {

        if (auth()->user()->avatar) {

            Storage::disk('public')->delete(auth()->user()->avatar);

        }

        auth()->user()->update([

            'avatar' => $avatar->store('avatar')

        ]);
    }
}