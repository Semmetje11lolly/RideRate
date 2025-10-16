<x-app-layout>
    <x-slot name="header">
        Add a Ride
    </x-slot>
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ab aliquid aperiam aspernatur atque blanditiis
    consequuntur deserunt dolores et harum id, in itaque laboriosam optio quaerat, quasi quos sed veniam!

    <form action="{{ route('rides.store') }}" method="POST">
        @csrf

        <label for="name">Name</label>
        <input id="name" name="name" type="text" value="{{ old('name') }}">
        @error('name')
        {{ $message }}
        @enderror

        <label for="description">Description</label>
        <input id="description" name="description" type="text" value="{{ old('description') }}">

        <label for="type_id">Type</label>
        <select id="type_id" name="type_id">
            @foreach($types as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
        </select>

        <input type="submit" name="submit" value="Create">
    </form>
</x-app-layout>
