
@include('layouts.navigation')
<x-app-layout>
<h1 class="text-4xl flex underline decoration-double decoration-amber-600/70 dark:decoration-wavy decoration-2 underline-offset-4 dark:decoration-teal-600/50 justify-center mt-6 p-6">Aici faci un proiect nou</h1>
    
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

        <form id="projectForm" action="{{ url('createPr') }}" method="post" class="p-6  justify-center items-center grid-cols-1 ">
            @csrf
            
            <label for="numeTask" name="numeTask">Project:</label>
            <input type="text" id="numeProiect" name="numeProiect" class="border-2 w-full pb-2 mb-2 text-slate-600">
            <br>

            <label for="deadline" name="deadline">Deadline:</label>
            <input type="datetime-local" id="deadline" name="deadline" class="border-2 w-full pb-2 mb-2 text-zinc-600" >

            <label for="colabortori" name="colabortori">Colaboratori:</label>
            <input type="text" id="colabortori" name="colabortori" class="border-2 w-full pb-2 mb-2 text-zinc-600" >


            <div class="flex items-center justify-center">
                <button type="submit" value="Submit" class="mt-4 bg- shadow bg-orange-600 hover:bg-orange-900 dark:bg-teal-600 dark:hover:bg-teal-800 dark:border-none appearance-none border rounded-xl max-w-fit py-2 px-4 text-white leading-tight focus:outline-none focus:shadow-outline"> Add</button>
            </div>

        </form> 
    </div>
</x-app-layout>