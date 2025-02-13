<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class=" ">
    <table class="table align-middle text-white mx-300">
        <thead>
            <tr>
                <th>Description</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>{{ $log->Description }}</td>
                <td>{{ $log->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>
