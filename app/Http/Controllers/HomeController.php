<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

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

        $projects = $user->projects;

        return view('home', ['projects' => $projects]);
    }
}
