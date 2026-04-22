@include('layouts.navigation')
<x-app-layout>

    <h1 class="text-4xl flex underline decoration-double decoration-amber-600/70 dark:decoration-wavy decoration-2 underline-offset-4 dark:decoration-teal-600/50 justify-center mt-6 p-6">Aici faci un task nou</h1>
        @if ($errors->any())
           
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-white dark:bg-gray-800 dark:text-red-400 border-2 border-red-700 w-1/2 m-auto" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <div class=" max-w-xs border shadow flex items-center p-3 w-3/4 m-auto rounded-tl-lg rounded-br-lg bg-white dark:bg-gray-700">

            <form id="taskForm" action="{{ url              ('create') }}" method="post" class="rounded p-6 justify-center items-center grid-cols-1">
                @csrf
                
                <p class="font-semibold">Ce iti propui sa faci?</p>
                <br>

                <label for="numeTask" name="numeTask" class="">Task:</label>
                <input type="text" id="numeTask" name="numeTask" class="border-2 w-full pb-2 mb-2 text-slate-600">
                <br>
                
                <label for="deadline" name="deadline">Deadline:</label>
                <input type="datetime-local" id="deadline" name="deadline" class="border-2 w-full pb-2 mb-2 text-slate-600">
                <br>
                <label for="nume_pr" name="nume_pr">Proiect: </label>
<!--                   <input type="text" id="nume_pr" name="nume_pr" class="border-2 w-full pb-2 mb-2 text-slate-600">
 -->                         
                       <select id="nume_pr" name="nume_pr" class="border-2 w-full pb-2 mb-2 text-slate-600">
                        <option value="" id="nume_pr">alege proiectul, sau nu</option>
                        @foreach($projects as $project)
                        
                            <option value="{{$project->name}}" id="nume_pr" class="h-4"> 
                               
                                {{$project->name}}
                            </option> 
                        @endforeach
                        
                     </select> 
                 

                <div class="flex items-center justify-center">
                    <button type="submit" value="Submit" class="mt-4  bg-orange-600 hover:bg-orange-900 dark:bg-teal-600 dark:hover:bg-teal-800 appearance-none border dark:border-none shadow-lg shadow-slate-100 rounded-xl max-w-fit py-2 px-4 text-white leading-tight focus:outline-none focus:shadow-outline"> Add</button>
                </div>

            </form> 
        </div>

<br>
</x-app-layout>
</body>

</html>
