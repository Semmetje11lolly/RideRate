<x-app-layout>
    <x-slot name="header">
        {{ $ride->name }}
    </x-slot>
    <p>{{ $ride->type->name}}</p>
    <p>{{ $ride->description}}</p>
</x-app-layout>
