<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function projects()
    {
        $user=Auth::user();
        
        
         $projectId=DB::table('projects')
                    
                    ->leftJoin('project_user','projects.id','=','project_user.project_id')
                    ->where('projects.user_id',auth()->user()->id)
                    ->where('project_user.user_id','=',null)
                    ->distinct()
                    ->pluck('projects.id')
                    ->toArray(); 
        $projects=Project::findMany($projectId); 
      
        $c_projects=auth()->user()->c_projects;

         return view('tasks.projects')->with(compact(['projects','c_projects']));
    }

    public function createPr()
    {
      return view('tasks.createPr');
    }

    public function storePr(Request $request)
    { 
        $request->validate([
            'numeProiect' => 'required|max:255',
            'deadline'=>'nullable|after_or_equal:today',
            
        ]);
        $project= new Project;

        $project->name = $request->input('numeProiect');
        $project->user_id=auth()->user()->id;
        $project->deadline=$request->input('deadline');
        
        $project->save();


        $aux=$request->input('colabortori');
        
        if($aux){

            $project->users()->save(auth()->user());
            //imparte campul colaboratori dupa spatii
            $colaboratori= explode(" ",$aux); 
            foreach($colaboratori as &$mail) {
                //dump($mail);✓
                //ion e userul corespunzator unui mail
                $ion=User::where('email',$mail)->first();
                //dd($ion);

                //if u; asta ar pute poate sa fie un validate, ca daca nu sunt mailuri inregistrate sa arunce o eroare
                //momentan daca nu-s bune, doar le ignora
                if($ion){
                    $project->users()->save($ion);
                } 
                          
                
            }
            //dd("gata");✓
        }

       return redirect('/projects');
    }

    public function deletePr($id)
    {
        
        $project=Project::where('id',$id )->first();
       
        if($project->col() && in_array(Auth::user()->id , $project->users->pluck('id')->toArray() )) {
           
            $project->delete();
            return redirect('/projects');
            
        }
        elseif($project->user_id==Auth::user()->id) {
            $project->delete();
            return redirect('/projects');
        }
        
        
       
       
        return redirect('/projects');

    }

}
