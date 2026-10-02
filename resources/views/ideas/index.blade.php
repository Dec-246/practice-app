<x-layout title="About Us">


<!-- SUBMITTING AND FETCHING IDEAS IN FRONTEND WITH SESSIONS == NO DATABASE -->
<!-- on condition that we have ideas, if there are some then render html block-->

{{-- @if (count($ideas))
    <div class="mt-6 text-white">
        <h2 class="font-bold">Your Ideas</h2>

        <ul class="mt-6">
            @foreach ($ideas as $idea)
                <li class="text-sm">{{ $idea }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

<!-- SUBMITTING AND FETCHING IDEAS IN BACKEND AND LOADING TO FRONTEND -->
 <!-- getting count of ideas -->
 @if ($ideas->count())
    <div class="mt-6 text-white">
        <h2 class="font-bold">Your Ideas</h2>

        <ul class="mt-6 grid grid-cols-2 gap-x-6 gap-y-4">
            @foreach ($ideas as $idea)

            <x-idea-card href="/ideas/{{ $idea->id }}">
                {{ $idea->description }}
            </x-idea-card>

            {{-- this reps one row from DB --}}
                <!-- <a href="/ideas/{{ $idea->id }}" class="text-sm">{{ $idea->description }}</a> -->
            @endforeach
        </ul>
    </div>
    @else
        <p>No ideas yet. </p>
    @endif

    <p class="mt-6"><a href="/ideas/create" class="underline">Create a new idea!</a></p>

</x-layout>
