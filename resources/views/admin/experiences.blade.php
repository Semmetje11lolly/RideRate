<x-app-layout>
    @vite('resources/js/admin-index.js')
    <x-slot name="header">
        Admin Dashboard
    </x-slot>

    <section>
        <h2>Experiences</h2>
        <p>View all Experiences that are currently on Ride Rate. <a href="{{ route('admin') }}">Back to Overview</a></p>
        <div class="table-wrapper">
            <table class="admin-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Ride</th>
                    <th>User</th>
                    <th>Rating</th>
                    <th>Visibility</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($experiences as $experience)
                    <tr>
                        <td>{{ $experience->id }}</td>
                        <td>{{ $experience->ride->name }}</td>
                        <td>{{ $experience->user->name }}</td>
                        <td>
                            <div class="experience-stars"
                                 style="color: var(--color-black)">
                                @for($i = 0; $i < $experience->average_rating; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                                @for($i = 0; $i < 5 - $experience->average_rating; $i++)
                                    <i class="fa-regular fa-star"></i>
                                @endfor
                            </div>
                        </td>
                        <td>
                            <button data-url="{{ route('experiences.toggle-visibility', $experience) }}"
                                    class="toggle-visibility-btn {{ $experience->public ? 'visible' : 'hidden' }}">
                                {!! $experience->public ? 'Visible <i class="fa-solid fa-eye"></i>' : 'Hidden <i class="fa-solid fa-eye-slash"></i>' !!}
                            </button>
                        </td>
                        <td>{{ $experience->created_at->format('d-m-Y') }}</td>
                        <td>{{ $experience->updated_at->format('d-m-Y') }}</td>
                        <td>
                            <a href="{{ route('experiences.edit', $experience) }}" class="button-primary">Edit <i
                                    class="fa-solid fa-pen"></i></a>
                            <a href="{{ route('experiences.show', $experience) }}" class="button-primary">View <i
                                    class="fa-solid fa-eye"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @if($experiences->hasPages())
            {{ $experiences->links('pagination::simple-riderate-experiences') }}
        @endif
    </section>
</x-app-layout>
