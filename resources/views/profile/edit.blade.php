<x-app-layout>
    <x-slot name="script">
        ''
    </x-slot>
    <x-slot name="header">
        Profile
    </x-slot>

    @include('profile.partials.update-profile-information-form')

    @include('profile.partials.update-password-form')

    <section>
        <h2>Logout</h2>
        <p>Use the button below to logout.</p>
        <form action="{{ route('logout') }}" method="post" style="align-items: center">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </section>
</x-app-layout>
