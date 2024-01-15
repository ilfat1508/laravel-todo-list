<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * @var Task
     */
    private $taskModel;

    public function __construct(Task $taskModel)
    {
        $this->taskModel = $taskModel;
    }

    public function delete($id, $project)
    {
        $task  = $this->taskModel->findorfail($id);
        $task->delete();
        return redirect('project.show');
    }

    public function show($id)
    {
        $project = $this->taskModel->findorfail($id);
        $tasks = $project->tasks;
        return view('project', ['project' => $project, 'tasks' => $tasks]);
    }

    public function store($id)
    {
        $data = request()->validate([
            'title' => 'string',
            'description' => 'string',
            'status' => 'string',
        ]);

        $data['project_id'] = $id;
        $this->taskModel->create($data);

        return redirect()->route('project.show', $id);
    }
}
