<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    private $userModel;
    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function delete($id)
    {
        $user = $this->userModel->findorfail($id);
        $user->delete();
        return redirect('home');
    }

    public function update($userId)
    {
        $user = $this->userModel->findorfail($userId);
        $user->blocked = !$user->blocked;
        $user->save();
        return redirect('home');
    }

    public function blocked()
    {
        return view('blocked');
    }
}
