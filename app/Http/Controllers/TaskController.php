<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;


class TaskController extends Controller
{
    public function paginaPrincipal () {
        $tasks = Task::where('concluido', false)->orderBy('prioridade', 'asc')->get();

        //$completedTasks = DB::table('tasks')->where('concluido', true)->orderBy('prioridade', 'asc')->get();
        $completedTasks = Task::where('concluido', true)
                            ->orderBy('prioridade', 'asc')
                            ->get();

        $deletedTasks = Task::onlyTrashed()->orderBy('prioridade', 'asc')->get();

        return view('inserir', [
            'tasks' => $tasks,
            'completedTasks' => $completedTasks,
            'deletedTasks' => $deletedTasks,
        ]);
    }
    
    public function store (Request $request) {
        $task = new Task;

        $task->titulo = $request->titulo;
        $task->observacoes = $request->observacoes;
        $task->prioridade = $request->prioridade;
        $task->concluido = $request->has('concluido') ? $request->concluido : false;
        
        $dateTime = new DateTime();
        $task->data_conclusao = $request->has('concluido') ? $dateTime : null;

        $task->save();

        return redirect('/');
    }

    public function atualizar (Request $request) {
        $data = $request->all();

        $data["concluido"] = $request->has('concluido') ? $request->concluido : false;

        $dateTime = new DateTime();
        $data["data_conclusao"] = $request->has('concluido') ? $dateTime : null;

        Task::findOrFail($request->id)->update($data);

        return redirect()->back();
    }

    public function concluir ($id) {
        Task::where('id', $id)->update(['concluido' => true, 'data_conclusao' => new DateTime]);

        return redirect()->back();
    }

    public function desconcluir ($id) {
        Task::where('id', $id)->update(['concluido' => false, 'data_conclusao' => null]);

        return redirect()->back();
    }

    public function deletar ($id) {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->back();
    }

    public function destruir ($id) {
        $task = Task::withTrashed()->findOrFail($id);
        $task->forceDelete();

        return redirect()->back();
    }

    public function restaurar ($id) {
        $task = Task::withTrashed()->findOrFail($id);
        $task->restore();

        return redirect()->back();
    }
}
