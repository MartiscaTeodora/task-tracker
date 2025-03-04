
@include('layouts.navigation')
<x-app-layout>

<!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot> -->


<!-- Page Heading -->
<!-- @if (isset($header))
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>
@endif -->

    <h1 class="text-4xl flex underline  dark:decoration-wavy decoration-2 decoration-double underline-offset-4 decoration-amber-600/70 dark:decoration-teal-600/50 justify-center p-8">Taskurile tale:</h1>
  
    
    @if($c_tasks->count() > 0 )  
    <div  class="w-5/12 text-bold text-lg gap-4  text-center m-auto ml-0 pl-6 le"></div>

    <div class="  p-6 m-auto w-11/12 md:w-8/12 lg:w-7/12 pb-8">
        <h2 class="pl-2">Task-uri de echipa:</h2>
        @foreach ($c_tasks as $task)
        
            <div id="{{$task->id}}" class="p-2  border bg-teal-50 dark:bg-slate-800 rounded content-center w-full flex items-center m-1 min-h-28">
                
                <form action="overview/{{$task->id}}" method="post" class="mb-1 w-11/12 dark:text-slate-400">
                    @csrf
                    @if($task->status==0)
                        @method('patch')
                        <div class="p-2 ">
                        <button input="submit" aria-label="Check completed" class="font-semibold dark:bg-slate-200 select-none text-lg text-green-900 border-emerald-950 border px-2 mr-1 hover:bg-green-200 rounded-full inline-block">✓</button> 
                    @else
                    @method('delete') 
                        <div class="text-zinc-700 p-2"> 
                        <button aria-label="Delete" input="submit" class="font-semibold select-none text-lg dark:bg-slate-200 text-red-900 border-red-950 border px-2 mr-1 hover:bg-red-200 inline-block">X</button> 
                        
                    @endif

                        <div class="inline-block dark:text-slate-400">
                            {{$task->name}}
                        </div>
                        <div class="inline-block  relative  opacity-55 float-right dark:text-slate-400">
                            
                            

                        Proiect:
                                    <div class="text-orange-700 dark:text-emerald-100 inline-block"><a href="{{'projects'}}#{{$task->project?->id}}">  {{$task->project?->name}}</a></div>
                           

                        </div>

                    </div>

                    <div class=" flow-root  pt-2 ps-3 text-pretty font-light pb-2   text-teal-700 dark:text-teal-500 ">
                        
                        @if($task->deadline)
                        
                            @if (\Carbon\Carbon::parse($task->deadline)->isPast() && ! $task->isCompleted()) 
                                <div class="text-sm">
                                    termen depasit
                                </div>
                            <div class="underline decoration-dotted decoration-teal-600"> 
                                
                            @elseif (!\Carbon\Carbon::parse($task->deadline)->gte(\Carbon\Carbon::parse($task->updated_at)) && $task->isCompleted())
                                <div class="text-sm">
                                    terminat dupa deadline
                                </div>
                                <div class="float-left inline underline decoration-dotted decoration-teal-600">
                            @else
                                <div class="float-left inline">
                            @endif
                            
                            Deadline: {{$task->deadline}}</div>
                            
                        @endif
                        @if($task->status!=0)
                            
                            <div class="float-right inline text-teal-700 dark:text-teal-500">Terminat la {{$task->updated_at}}</div>

                        @endif
                    
                    </div>
                    
                </form>
            </div>
        
        @endforeach

    </div>
    @endif

    @if($tasks->count() > 0 )  
 
    <div class="  p-6 m-auto w-11/12 md:w-8/12 lg:w-7/12 pb-8">
        
        @foreach ($tasks as $task)
            
                <div id="{{$task->id}}" class="p-2  border bg-white dark:bg-gray-800 rounded content-center w-full flex items-center m-1 min-h-28">
                    
                    <form action="overview/{{$task->id}}" method="post" class="mb-1 w-11/12 dark:text-slate-400">
                        @csrf
                        @if(!$task->isCompleted())
                            @method('patch')
                            <div class="p-2 ">
                            <button input="submit" aria-label="Check completed" class="font-semibold dark:bg-slate-200 select-none text-lg text-green-900 border-emerald-950 border px-2 mr-1 hover:bg-green-200 rounded-full inline-block">✓</button> 
                            
                        @else
                            @method('delete') 
                            <div class="text-zinc-700 p-2"> 
                            <button aria-label="Delete" input="submit" class="font-semibold select-none text-lg dark:bg-slate-200 text-red-900 border-red-950 border px-2 mr-1 hover:bg-red-200 inline-block">X</button> 
                                
                            
                        @endif

                            <div class="inline-block dark:text-slate-400">
                                {{$task->name}}
                            </div>
                            <div class="inline-block  relative  opacity-55 float-right dark:text-slate-400">
                                
                                @if($task->project)

                                    Proiect:
                                        <div class="text-orange-700 dark:text-emerald-100 inline-block"><a href="{{'projects'}}#{{$task->project?->id}}">  {{$task->project?->name}}</a></div>
                                
                                @else 
                                <div>nu are proiect</div>        @endif

                            </div>

                        </div>

                        <div class=" flow-root  pt-2 ps-3 text-pretty font-light pb-2   text-teal-700 dark:text-teal-500 ">
                            
                            @if($task->deadline)
                            
                                @if (\Carbon\Carbon::parse($task->deadline)->isPast() && ! $task->isCompleted()) 
                                    <div class="text-sm">
                                        termen depasit
                                    </div>
                                <div class="underline decoration-dotted decoration-teal-600"> 
                                    
                                @elseif (!\Carbon\Carbon::parse($task->deadline)->gte(\Carbon\Carbon::parse($task->updated_at)) && $task->isCompleted())
                                    <div class="text-sm">
                                        terminat dupa deadline
                                    </div>
                                    <div class="float-left inline underline decoration-dotted decoration-teal-600">
                                @else
                                    <div class="float-left inline">
                                @endif
                                
                                Deadline: {{$task->deadline}}</div>
                                
                            @endif
                            @if($task->isCompleted())
                                
                                <div class="float-right inline text-teal-700 dark:text-teal-500">Terminat la {{$task->updated_at}}</div>

                            @endif
                        
                        </div>
                        
                    </form>
                </div>
            
        @endforeach

    </div>
    @else
   <p>Nu ai niciun task inca</p>
    <!--redirect catre new task-->

    <a href="{{url('/create')}}" >
        <button type="button" class=" flex items-center text-center justify-center  mt-4 shadow bg-teal-600 hover:bg-teal-900 appearance-none border rounded-xl max-w-fit py-3 px-5 text-white focus:outline-none focus:shadow-outline font-extrabold text-2xl">
            +
        </button>
    </a>
    @endif
    </x-app-layout>
</body>
</html>
