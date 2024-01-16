<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * @var Project
     */
    private $projectsModel;
    public function __construct(Project $projectsModel)
    {
        $this->projectsModel = $projectsModel;
    }

    public function index()
    {
        $projects = $this->projectsModel->all();

        return view('home', ['projects' => $projects]);
    }

    public function delete($id)
    {
        $project = $this->projectsModel->findorfail($id);
        $project->delete();
        return redirect('home');
    }

    public function show($id)
    {
        $project = $this->projectsModel->findorfail($id);
        $tasks = $project->tasks;
        return view('project', ['project' => $project, 'tasks' => $tasks]);
    }

    public function store()
    {
        $data = request()->validate([
           'title' => 'string',
           'description' => '',
        ]);

        $data['user_id'] = auth()->user()->id;
        $this->projectsModel->create($data);

        return redirect()->route('home');
    }

    public function update($projectId)
    {
        $project = $this->projectsModel->findorfail($projectId);
        $data = request()->validate([
           'title' => 'string',
           'description' => '',
        ]);

        $data['user_id'] = auth()->user()->id;
        $project->update($data);

        return redirect()->route('home');
    }
}
