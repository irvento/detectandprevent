<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-center bg-blue-600 p-4 rounded-lg shadow-lg">
            {{ __('Logs') }}
        </h2>
    </x-slot>

    <div class="p-6 bg-gray-900 rounded-lg shadow-lg">

        <table class="w-full border-collapse border border-gray-700">
            <colgroup>

            </colgroup>

            <thead class="bg-blue-700 text-white">
                <tr>
                    <th class="p-3 text-left border border-gray-600">IP Address</th>
                    <th class="p-3 text-left border border-gray-600">Device</th>
                    <th class="p-3 text-left border border-gray-600">Description</th>
                    <th class="p-3 text-left border border-gray-600">Date and Time</th>
                </tr>
            </thead>

            <tbody class="text-gray-300">
                @foreach($logs as $log)
                <tr class="hover:bg-blue-800 transition">
                    <td class="p-3 border border-gray-600">{{ $log->ip }}</td>
                    <td class="p-3 border border-gray-600">{{ $log->device }}</td>
                    <td class="p-3 border border-gray-600">{{ $log->Description }}</td>
                    <td class="p-3 border border-gray-600">{{ $log->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
