<x-app-layout>
    <x-slot name="header">
        Ride Rate
    </x-slot>
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ab aliquid aperiam aspernatur atque blanditiis
    consequuntur deserunt dolores et harum id, in itaque laboriosam optio quaerat, quasi quos sed veniam!

    @foreach($rides as $ride)
        <h1>{{ $ride->name }}</h1>
    @endforeach
</x-app-layout>
