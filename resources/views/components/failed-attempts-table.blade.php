
<table class="w-full border-collapse border border-gray-700 mb-8">
    <thead class="bg-gray-800 text-white">
        <tr>
            <th class="p-3 text-left border border-gray-600">ID</th>
            <th class="p-3 text-left border border-gray-600">User ID</th>
            <th class="p-3 text-left border border-gray-600">Description</th>
            <th class="p-3 text-left border border-gray-600">Created At</th>
            <th class="p-3 text-left border border-gray-600">IP</th>
            <th class="p-3 text-left border border-gray-600">Device</th>
        </tr>
    </thead>
    <tbody class="text-gray-300">
        @foreach($failedAttemptsRecords as $record)
            <tr class="hover:bg-gray-700 transition">
                <td class="p-3 border border-gray-600">{{ $record->id }}</td>
                <td class="p-3 border border-gray-600">{{ $record->user_id }}</td>
                <td class="p-3 border border-gray-600">{{ $record->Description }}</td>
                <td class="p-3 border border-gray-600">{{ $record->created_at }}</td>
                <td class="p-3 border border-gray-600">{{ $record->ip }}</td>
                <td class="p-3 border border-gray-600">{{ $record->device }}</td>
            </tr>
        @endforeach
    </tbody>
</table>