{{-- filepath: resources/views/logs/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-center bg-blue-600 p-4 rounded-lg shadow-lg">
            {{ __('Logs') }}
        </h2>
    </x-slot>

    <div class="p-6 bg-gray-900 rounded-lg shadow-lg mb-8">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-center bg-green-600 p-4 rounded-lg shadow-lg mb-4">
    {{ __('Login/Logout Logs') }}
</h2>
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
        <div class="mt-4">
            {{ $logs->links('pagination::tailwind') }}
        </div>
        <br><br>

    
        <br><br>
                {{-- Commit Logs Table --}}
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-center bg-green-600 p-4 rounded-lg shadow-lg mb-4">
                    {{ __('Commit Logs') }}
                </h2>
                @if($commitLogs && count($commitLogs) > 0)
                    <table class="w-full border-collapse border border-gray-700 mb-8">
                        <thead class="bg-green-700 text-white">
                            <tr>
                                <th class="p-3 text-left border border-gray-600">Commit Message</th>
                                <th class="p-3 text-left border border-gray-600">Commit Hash</th>
                                <th class="p-3 text-left border border-gray-600">Author</th>
                                <th class="p-3 text-left border border-gray-600">Date</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-300">
                            @foreach($commitLogs as $commit)
                                <tr class="hover:bg-green-800 transition">
                                    <td class="p-3 border border-gray-600">{{ $commit['commit']['message'] }}</td>
                                    <td class="p-3 border border-gray-600">
                                        <a href="{{ $commit['html_url'] }}" class="text-blue-400 hover:text-blue-300" target="_blank">
                                            {{ substr($commit['sha'], 0, 7) }}
                                        </a>
                                    </td>
                                    <td class="p-3 border border-gray-600">{{ $commit['commit']['author']['name'] }}</td>
                                    <td class="p-3 border border-gray-600">
                                        {{ \Carbon\Carbon::parse($commit['commit']['author']['date'])->toDayDateTimeString() }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center text-gray-600">No commit logs available.</p>
                @endif
<br><br><br><br>
                <div class="p-6 bg-gray-900 rounded-lg shadow-lg mb-8">
                        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-center bg-green-600 p-4 rounded-lg shadow-lg mb-4">
                    {{ __('Incident Logs') }}
                </h2>
        <table class="w-full border-collapse border border-gray-700 mb-8">
            <thead class="bg-yellow-700 text-white">
                <tr>
                    <th class="p-3 text-left border border-gray-600">Type</th>
                    <th class="p-3 text-left border border-gray-600">Description</th>
                    <th class="p-3 text-left border border-gray-600">User</th>
                    <th class="p-3 text-left border border-gray-600">IP</th>
                    <th class="p-3 text-left border border-gray-600">Status</th>
                    <th class="p-3 text-left border border-gray-600">Date</th>
                </tr>
            </thead>
            <tbody class="text-gray-300">
                @foreach($incidents as $incident)
                <tr>
                    <td class="p-3 border border-gray-600">{{ $incident->type }}</td>
                    <td class="p-3 border border-gray-600">{{ $incident->description }}</td>
                    <td class="p-3 border border-gray-600">{{ $incident->user_id }}</td>
                    <td class="p-3 border border-gray-600">{{ $incident->ip }}</td>
                    <td class="p-3 border border-gray-600">{{ $incident->status }}</td>
                    <td class="p-3 border border-gray-600">{{ $incident->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $incidents->links('pagination::tailwind') }}
        </div>
    </div>
    <br><br>
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
        <div class="mt-4">
            {{ $errorLogs->links('pagination::tailwind') }}
        </div>
    </div>
    <div class="p-6 bg-gray-900 rounded-lg shadow-lg mb-8">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-center bg-blue-600 p-4 rounded-lg shadow-lg mb-4">
            {{ __('User Management') }}
        </h2>
        <table class="w-full border-collapse border border-gray-700 mb-8">
            <thead class="bg-blue-700 text-white">
                <tr>
                    <th class="p-3 text-left border border-gray-600">Name</th>
                    <th class="p-3 text-left border border-gray-600">Email</th>
                    <th class="p-3 text-left border border-gray-600">Role</th>
                    <th class="p-3 text-left border border-gray-600">Status</th>
                    <th class="p-3 text-left border border-gray-600">Suspended Until</th>
                    <th class="p-3 text-left border border-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-300">
                @forelse($users as $user)
                    <tr class="hover:bg-blue-800 transition">
                        <td class="p-3 border border-gray-600">{{ $user->name }}</td>
                        <td class="p-3 border border-gray-600">{{ $user->email }}</td>
                        <td class="p-3 border border-gray-600">
                            <span class="px-2 py-1 {{ $user->role === 'admin' ? 'bg-purple-500' : 'bg-gray-500' }} text-white rounded-full text-sm">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="p-3 border border-gray-600">
                            @if($user->is_suspended)
                                <span class="px-2 py-1 bg-red-500 text-white rounded-full text-sm">Suspended</span>
                            @else
                                <span class="px-2 py-1 bg-green-500 text-white rounded-full text-sm">Active</span>
                            @endif
                        </td>
                        <td class="p-3 border border-gray-600">
                            {{ $user->suspended_until ? $user->suspended_until->format('Y-m-d H:i:s') : 'N/A' }}
                        </td>
                        <td class="p-3 border border-gray-600">
                            @if($user->is_suspended)
                                <form action="{{ route('logs.reactivate-user', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                        Reactivate
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('logs.suspend-user', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Suspend
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-3 border border-gray-600 text-center text-gray-400">
                            No users found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $users->links('pagination::tailwind') }}
        </div>
    </div>
</x-app-layout>