<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * @var Project
     */
    private $projectsModel;

    /**
     * @var User
     */
    private $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Project $projectsModel, User $user)
    {
        $this->middleware('auth');
        $this->projectsModel = $projectsModel;
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $users = User::where('id', '!=', $user->id)->get();
            $projects = Project::all();
        } else {
            $projects = $user->projects;
        }

        return view('home', [
            'projects' => $projects,
            'users' => isset($users) ? $users : null,
            'userRole' => $user->role
        ]);
    }
}
