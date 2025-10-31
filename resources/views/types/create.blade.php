<x-app-layout>
    <x-slot name="header">
        Add a Type
    </x-slot>

    <section>
        <h2>Need a new type?</h2>
        <p>Did Intamin create another new prototype?! Add a new Ride Type here!</p>
    </section>

    <section>
        <form action="{{ route('types.store') }}" method="post">
            @csrf
            
            <div class="form-item">
                <label for="name">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required>
                @error('name')
                <div class="error">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit">Create</button>
        </form>
    </section>
</x-app-layout>
