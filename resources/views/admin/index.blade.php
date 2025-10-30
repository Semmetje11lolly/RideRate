<x-app-layout>
    @vite('resources/js/admin-index.js')
    <x-slot name="header">
        Admin Dashboard
    </x-slot>

    <section>
        <h2>Where do you wanna go?</h2>
        <p>The Admin Dashboard is split up in four sections. Choose which section you want to view.</p>
        <div class="table-wrapper">
            <table class="admin-table">
                <tbody>
                <tr>
                    <td style="width: 25%; justify-items: center">
                        <a style="display: block; width: 85%" href="{{ route('admin.experiences') }}"
                           class="button-primary">Experiences</a>
                    </td>
                    <td style="width: 25%; justify-items: center">
                        <a style="display: block; width: 85%" href="{{ route('admin.rides') }}"
                           class="button-primary">Rides</a>
                    </td>
                    <td style="width: 25%; justify-items: center">
                        <a style="display: block; width: 85%" href="{{ route('admin.types') }}"
                           class="button-primary">Types</a>
                    </td>
                    <td style="width: 25%; justify-items: center">
                        <a style="display: block; width: 85%" href="{{ route('admin.users') }}"
                           class="button-primary">Users</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>
</x-app-layout>
