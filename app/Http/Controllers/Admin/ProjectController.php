<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * @var Project
     */
    private $projectsModel;

    /**
     * @param Project $projectsModel
     */
    public function __construct(Project $projectsModel)
    {
        $this->projectsModel = $projectsModel;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $projects = $this->projectsModel->all();

        return view('home', ['projects' => $projects]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        $project = $this->projectsModel->findorfail($id);
        $project->delete();
        return redirect('home');
    }

    /**
     * @param $id
     * @param $status
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id, $status = null)
    {
        $project = $this->projectsModel->findorfail($id);
        $tasks = $project->tasks;
        if ($status === 'active') {
            $tasks = $tasks->whereIn('status', ['pending', 'in development', 'on testing', 'on verification']);
        } elseif ($status === 'completed') {
            $tasks = $tasks->whereIn('status', 'completed');
        }

        if (request()->ajax()) {
            return ['projectId' => $id, 'tasksStatus' => $status];
        }
        return view('project', ['project' => $project, 'tasks' => $tasks, 'tasksStatus' => $status]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * @param $projectId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($projectId)
    {
        $project = $this->projectsModel->findorfail($projectId);
        $data = request()->validate([
            'title' => 'string',
            'description' => '',
        ]);

        $project->update($data);

        return redirect()->route('home');
    }
}
