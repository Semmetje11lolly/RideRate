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
        <h2>Types</h2>
        <p>View all Types that are currently on Ride Rate. <a href="{{ route('admin') }}">Back to Overview</a></p>
        <div class="table-wrapper">
            <table class="admin-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Rides</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th><a href="{{ route('types.create') }}">Create new Type</a></th>
                </tr>
                </thead>
                <tbody>
                @foreach($types as $type)
                    <tr>
                        <td>{{ $type->id }}</td>
                        <td>{{ $type->name }}</td>
                        <td>{{ $type->rides()->count() }}</td>
                        <td>{{ $type->created_at->format('d-m-Y') }}</td>
                        <td>{{ $type->updated_at->format('d-m-Y') }}</td>
                        <td>
                            <div class="form-item-horizontal">
                                <a href="{{ route('types.edit', $type) }}" class="button-primary"><i
                                        class="fa-solid fa-pen" style="margin: 0"></i></a>
                                <a href="{{ route('rides.index', ['type' => $type->id]) }}" class="button-primary"><i
                                        class="fa-solid fa-arrow-up-right-from-square" style="margin: 0"></i></a>
                                <form action="{{ route('types.destroy', $type) }}" method="post"
                                      onsubmit="return confirm('Are you sure you want to delete {{ $type->name }}?')">
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
    </section>
</x-app-layout>
