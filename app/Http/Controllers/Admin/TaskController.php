<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * @var Task
     */
    private $taskModel;

    /**
     * @param Task $taskModel
     */
    public function __construct(Task $taskModel)
    {
        $this->taskModel = $taskModel;
    }

    /**
     * @param $id
     * @param $projectId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($taskId, $projectId)
    {
        $task  = $this->taskModel->findorfail($taskId);
        $task->delete();
        return redirect(route('project.show', $projectId));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $project = $this->taskModel->findorfail($id);
        $tasks = $project->tasks;
        return view('project', ['project' => $project, 'tasks' => $tasks]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($projectId)
    {
        $data = request()->validate([
            'title' => 'string',
            'description' => 'string',
            'status' => 'string',
        ]);

        $data['project_id'] = $projectId;
        $this->taskModel->create($data);

        return redirect()->route('project.show', $projectId);
    }

    /**
     * @param $projectId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($taskId, $projectId, $tasksStatus = null)
    {
        $task = $this->taskModel->findorfail($taskId);
        $data = request()->validate([
            'title' => 'string',
            'description' => 'string',
            'status' => 'string',
        ]);

        $task->update($data);

        return redirect()->route('project.show', [$projectId, $tasksStatus]);
    }
}
