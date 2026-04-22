<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class TaskController extends Controller
{   

    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function overview() 
    {

        $user=Auth::user();
        $tasks = $user->tasks
        ->sortByDesc('id')
        ->sortBy('deadline')// apar primele cele fara deadline, dupa cele din trecut, dupa cele din viitor in ordine, dupa celefacute deja
        ->sortBy('status');

        //dd($tasks);
        $c_tasks_TID=DB::table('projects')
                    
                    ->join('project_user','projects.id','=','project_user.project_id')
                    ->join('tasks','projects.id','=','tasks.project_id')
                    ->where( 'project_user.user_id','=',auth()->user()->id)
                    ->pluck('tasks.id')->toArray();
                //dd($c_tasks_TID);
            
           $c_tasks=Task::findMany($c_tasks_TID);
           //dd($c_tasks->first()->project->users);
            //dd($tasks);
          return view('tasks.overview')->with(compact(['tasks','c_tasks']));
    }
    
    public function create() 
    {   $user=Auth::user();
        $s_projects=$user->projects;
        //dd($projects);
        $projects=$s_projects->concat($user->c_projects)->unique();
      return view('tasks.create')->with(compact(['projects']));
    }
  

    public function store(Request $request)
    { 
        $request->validate([
            'numeTask' => 'required|max:255',
            'deadline'=>'nullable|after_or_equal:today',
            
        ]);

        $task= new Task;

        $task->name = $request->input('numeTask');
        $task->user_id=auth()->user()->id;
       
        $aux=$request->input('nume_pr');
        if($aux) { 
           $projectId=false;
            if(auth()->user()->c_projects && auth()->user()->c_projects->where('name', $aux)->first()!=null)//;
            {
                $projectId =auth()->user()->c_projects->where('name', $aux)->first()->id;
            }
            elseif(auth()->user()->projects->where('name',$aux)->first()!=null) {
                $projectId =auth()->user()->projects->where('name', $aux)->first()->id;

            }               
            //daca exista pr cu numele asta bun, daca nu, adauga
            if($projectId) {
                $task->project_id=$projectId; 
            } else {
                $project=new Project;
                $project->name=$aux;
                $project->user_id=auth()->user()->id;
                $project->save();
                $task->project_id=Project::latest()->first()->id;

            }
        }

        if($request->input('deadline')) {
            $task->deadline=$request->input('deadline');
        }
        else {
            $task->deadline=$task->project->deadline;
        }
        $task->save();
        return redirect('/overview');
    }

    
    //schima statusul unui task din programata in gata
    public function update($id) 
    {
        $task=Task::where('id',$id)->first();//->where( 'user_id',Auth::user()->id)->first();
        if($task->colab() && in_array(Auth::user()->id , $task->project->users->toArray() ))
           { $task->status=1;
            $task->save();
           }
        elseif($task->user_id=Auth::user()->id){
            $task->status=1;
            $task->save();

        }
        // return dd($task);
       return redirect('/overview');

    }

    public function delete($id) 
    {
        
        $task=Task::where('id',$id)->first();
        if($task->colab() && in_array(Auth::user()->id , $task->project->users->toArray() )) {
           
            $task->delete();
        }
        elseif($task->user_id=Auth::user()->id) {

            $task->delete();
        }
        
        return redirect('/overview');

    }

}
