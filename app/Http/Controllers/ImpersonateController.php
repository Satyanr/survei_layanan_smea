<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ImpersonateController extends Controller
{
    public function impersonate($encryptedUserId)
    {
        $userId = Crypt::decrypt($encryptedUserId);
        $user = User::findOrFail($userId);

        session()->put('original_user_id', auth()->id());

        auth()->login($user);

        return redirect('/admin');
    }

    public function stopImpersonating()
    {
        if (session()->has('original_user_id')) {
            $originalUserId = session()->get('original_user_id');

            auth()->logout();

            $user = User::find($originalUserId);

            auth()->login($user);

            session()->forget('original_user_id');
        }

        return redirect()->route('admin.pengguna');
    }
}
