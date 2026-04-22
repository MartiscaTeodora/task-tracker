@include('layouts.navigation')

<x-app-layout>
    <br>
    <h1 class="text-4xl flex underline dark:decoration-wavy decoration-double decoration-orange-600/70 decoration-2 underline-offset-4 dark:decoration-teal-600/50 justify-center p-6">Proiectele tale:</h1>

@if($c_projects->count() > 0 )  
<div  class="w-3/4 text-bold text-lg gap-4  m-auto pl-4"><h2>Proiecte de echipa:</h2></div>
    <div class="md:grid grid-cols-2 xl:grid-cols-4  w-3/4 text-bold gap-4  m-auto">
    @foreach($c_projects as $project)
        
        <div id="{{$project->id}}" class="dark:text-teal-500 text-orange-600 bg-white overflow-auto dark:bg-gray-800 relative h-52 border-solid border-2 rounded p-4 m-4 overscroll-contain">
           
            <div class="font-bold w-full block uppercase mb-3">
                 <form action="projects/{{$project->id}}" method="post" class="mb-1 w-11/12 ">
                    @csrf
                    @method('delete') 
                    {{$project->name}}
                   
                    <button aria-label="Delete" input="submit" class="float-right select-none p-1 dark:bg-red-500/70 dark:text-white text-center text-sm rounded-full text-red-900 border-red-950 border px-3   hover:bg-red-300 inline-block">
                        ✗
                    </button> 
                    
                </form> 

            </div>
               <!--  <div  class="font-bold w-full block uppercase mb-3 "></div> -->
            <div class="">
                <ul class=" max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400 ">
                    
                    @foreach($project->tasks as $task) 
                       
                        <li class="flex items-center">
                            @if($task->status==1)
                                <div class="line-through inline-block">
                            @else
                                <div class="inline-block">
                            @endif
                                    <svg class="w-3.5 h-3.5 me-2 text-gray-500 dark:text-gray-400 flex-shrink-0 inline-block" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                    </svg>
                                    <a href="{{'overview'}}#{{$task->id}}"> 
                                        {{$task->name}}
                                    </a>
                                </div>

                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="inline text-sm sticky pb-4 top-full">Colaboratori: </div>
            @foreach($project->users as $us)
                
                <div class="inline text-xs text-gray-800 dark:text-gray-100 sticky pb-4  top-full ">{{$us->name}}  </div>
            @endforeach
            <div class="text-end text-xs text-stone-700 pt-2 dark:text-stone-400 sticky  top-full ">{{$project->deadline}}</div>
        </div>
            
    @endforeach
    </div>
    @endif


@if($projects->count() > 0 )  

    <div class="md:grid grid-cols-2 xl:grid-cols-4  w-3/4 text-bold gap-4  m-auto">
        @foreach($projects as $project)
            
            <div id="{{$project->id}}" class="dark:text-teal-500 text-teal-600 bg-white dark:bg-gray-900 overflow-auto relative h-52 border-solid border-2 rounded p-4 m-4 overscroll-contain">
               
                <div class="font-bold w-full block uppercase mb-3">
                    <form action="projects/{{$project->id}}" method="post" class="mb-1 w-11/12 ">
                        @csrf
                        @method('delete') 
                        
                        {{$project->name}}
                        <button aria-label="Delete" input="submit" class="float-right select-none p-1 dark:bg-red-500/70 dark:text-white text-center text-sm rounded-full text-red-900 border-red-950 border px-3   hover:bg-red-300 inline-block">✗</button> 
                        
                    </form>

                </div>
                <div class="">
                    <ul class=" max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400 ">
                        
                        @foreach($project->tasks as $task) 
                           
                            <li class="flex items-center">
                                @if($task->status==1)
                                    <div class="line-through inline-block">
                                @else
                                    <div class="inline-block">
                                @endif
                                    <svg class="w-3.5 h-3.5 me-2 text-gray-500 dark:text-gray-400 flex-shrink-0 inline-block" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                    </svg>
                                    <a href="{{'overview'}}#{{$task->id}}"> {{$task->name}}</a>
                                    </div>

                            </li>
                        @endforeach
                    </ul>
                </div>

            
                <div class="text-end text-xs text-stone-700 dark:text-stone-400 sticky pt-2  top-full ">{{$project->deadline}}</div>
            </div>
                
        @endforeach
    </div>
@else
    <p>Se pare ca nu ai proiecte, momentan. Hai sa faci!</p>

    <a href="{{url('/createPr')}}" >
            <button type="button" class=" flex items-center text-center justify-center  mt-4 shadow bg-purple-600 hover:bg-purple-900 appearance-none border rounded-xl max-w-fit py-3 px-5 text-white focus:outline-none focus:shadow-outline font-extrabold text-2xl">
                + 
            </button>
        </a>

@endif
</x-app-layout>
</body>

</html>
