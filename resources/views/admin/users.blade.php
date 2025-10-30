<x-app-layout>
    @vite('resources/js/admin-index.js')
    <x-slot name="header">
        Admin Dashboard
    </x-slot>

    <section>
        <h2>Users</h2>
        <p>View all Users that are currently on Ride Rate. <a href="{{ route('admin') }}">Back to Overview</a></p>
        <div class="table-wrapper">
            <table class="admin-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Experiences</th>
                    <th>Created</th>
                    <th>Updated</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            <div class="experience-user">
                                <img src="{{ url($user->image_url) }}" alt="Profile Picture">
                                {{ $user->name }}
                            </div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->experiences()->count() }}</td>
                        <td>{{ $user->created_at->format('d-m-Y') }}</td>
                        <td>{{ $user->updated_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
            {{ $users->links('pagination::simple-riderate-users') }}
        @endif
    </section>
</x-app-layout>
