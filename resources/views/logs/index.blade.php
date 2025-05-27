{{-- filepath: resources/views/logs/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-center bg-blue-600 p-4 rounded-lg shadow-lg">
            {{ __('Logs') }}
        </h2>
    </x-slot>

    <div class="p-6 bg-gray-900 rounded-lg shadow-lg mb-8">
        <table class="w-full border-collapse border border-gray-700 mb-8">
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
<br><br><br><br>
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-center bg-red-600 p-4 rounded-lg shadow-lg mb-4">
            {{ __('Error Logs') }}
        </h2>
        <table class="w-full border-collapse border border-gray-700">
            <thead class="bg-red-700 text-white">
                <tr>
                    <th class="p-3 text-left border border-gray-600">Level</th>
                    <th class="p-3 text-left border border-gray-600">Message</th>
                    <th class="p-3 text-left border border-gray-600">Context</th>
                    <th class="p-3 text-left border border-gray-600">Date and Time</th>
                </tr>
            </thead>
            <tbody class="text-gray-300">
                @foreach($errorLogs as $log)
                <tr class="hover:bg-red-800 transition">
                    <td class="p-3 border border-gray-600">{{ $log->level }}</td>
                    <td class="p-3 border border-gray-600">{{ $log->message }}</td>
                    <td class="p-3 border border-gray-600"><pre class="whitespace-pre-line">{{ $log->context }}</pre></td>
                    <td class="p-3 border border-gray-600">{{ $log->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>