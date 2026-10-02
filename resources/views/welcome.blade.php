<x-layout >
    <h1>Home--</h1>

    <!-- echoing out the greeting -->
     {{--
        if i was to do  {{ $greeting }}, (with $person in a php tag)
    --}}  
        <!-- this would leave for cross-Site Scripting (XSS) and allow for malicious web attacks. -->
        <!-- blade already has built in protection aginst this but we can also use 'htmlspecialchars' in a php tag for prtoection in php tags -->
    
        <!-- using blade comments -->
       {{--
            <p> 
                {{ $greeting }}, {{ $person }}! 
            </p>

       --}} 


       <!-- ----- BLADE DIRECTIVES ------- -->
    {{--
        dumping to page (@dump)
    --}}
        

     <!-- dd = die then dump -- this kills the execution so the header doesnt show afterwards -->
      <!-- Listing the tasks below -->
    <!-- @dump($tasks) -->

    <!-- Telling the user if we have tasks and the total number of tasks in the list -->
     {{-- 
    The if and endif below are the Blade directives that replace the php tag equivalents.
--}}

{{--
    @if (count($tasks))
        <p> Yes, we have some tasks. How many? <?= count($tasks) ?> tasks, in fact!</p>
    @endif

    <!-- for every task, print the value -->
    @forelse($tasks as $task)
        <li>{{ $task }}</li>
    @empty
        <p>No tasks available.</p>
    @endforelse

    <!--  if cannot count tasks-->
    @unless (count($tasks))
        <p> No tasks available</p>
    @endunless

    <h1>Tasks</h1>
--}}    

<!-- ----- FORM HANDLING ------- -->




</x-layout>