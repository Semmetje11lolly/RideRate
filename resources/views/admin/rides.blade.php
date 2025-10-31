<x-app-layout>
    @vite('resources/js/admin-index.js')
    <x-slot name="header">
        Admin Dashboard
    </x-slot>
    @if (session('success'))
        <div class="alert success">
            {{ session('success') }}
        </div>
    @endif

    <section>
        <h2>Rides</h2>
        <p>View all Rides that are currently on Ride Rate. <a href="{{ route('admin') }}">Back to Overview</a></p>
        <div class="table-wrapper">
            <table class="admin-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Experiences</th>
                    <th>Visibility</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($rides as $ride)
                    <tr>
                        <td>{{ $ride->id }}</td>
                        <td>{{ $ride->name }}</td>
                        <td>{{ $ride->type->name }}</td>
                        <td>{{ $ride->experiences()->count() }}</td>
                        <td>
                            <button data-url="{{ route('rides.toggle-visibility', $ride) }}"
                                    class="toggle-visibility-btn {{ $ride->public ? 'visible' : 'hidden' }}">
                                {!! $ride->public ? 'Visible <i class="fa-solid fa-eye"></i>' : 'Hidden <i class="fa-solid fa-eye-slash"></i>' !!}
                            </button>
                        </td>
                        <td>{{ $ride->created_at->format('d-m-Y') }}</td>
                        <td>{{ $ride->updated_at->format('d-m-Y') }}</td>
                        <td>
                            <div class="form-item-horizontal">
                                <a href="{{ route('rides.edit', $ride) }}" class="button-primary"><i
                                        class="fa-solid fa-pen" style="margin: 0"></i></a>
                                <a href="{{ route('rides.show', $ride) }}" class="button-primary"><i
                                        class="fa-solid fa-arrow-up-right-from-square" style="margin: 0"></i></a>
                                <form action="{{ route('rides.destroy', $ride) }}" method="post"
                                      onsubmit="return confirm('Are you sure you want to delete {{ $ride->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background-color: var(--color-error)">
                                        <i class="fa-solid fa-trash" style="margin: 0"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @if($rides->hasPages())
            {{ $rides->links('pagination::simple-riderate-rides') }}
        @endif
    </section>
</x-app-layout>
