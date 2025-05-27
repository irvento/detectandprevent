
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-center bg-blue-600 p-4 rounded-lg shadow-lg">
            {{ __('Daily Report & Security Assessment') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Daily Summary Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 mb-8">
                <h3 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-center bg-green-600 p-4 rounded-lg shadow-lg mb-4">
                    Summary for {{ \Carbon\Carbon::today()->toFormattedDateString() }}
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 bg-gray-200 dark:bg-gray-700 rounded-lg">
                        <p class="text-gray-700 dark:text-gray-300">Registered Users Today:</p>
                        <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $usersTodayCount }}</p>
                    </div>
                    <div class="p-4 bg-gray-200 dark:bg-gray-700 rounded-lg">
                        <p class="text-gray-700 dark:text-gray-300">Failed Login Attempts Today:</p>
                        <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $failedAttemptsTodayCount }}</p>
                    </div>
                    <div class="p-4 bg-gray-200 dark:bg-gray-700 rounded-lg">
                        <p class="text-gray-700 dark:text-gray-300">Successful Login Events Today:</p>
                        <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $loginCountToday }}</p>
                    </div>
                    <div class="p-4 bg-gray-200 dark:bg-gray-700 rounded-lg">
                        <p class="text-gray-700 dark:text-gray-300">Incidents Reported Today:</p>
                        <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $incidentsTodayCount }}</p>
                    </div>
                </div>
            </div>
            <!-- Security Assessment Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-center bg-green-600 p-4 rounded-lg shadow-lg mb-4">
                    Security Assessment (Last Minute)
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 bg-gray-200 dark:bg-gray-700 rounded-lg">
                        <p class="text-gray-700 dark:text-gray-300">
                            Failed Login Attempts (Last Minute):
                        </p>
                        <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $failedRecentAttempts }}</p>
                        @if($isBruteforce)
                            <p class="mt-2 text-red-600 font-bold">Possible Brute Force Attack Detected!</p>
                        @else
                            <p class="mt-2 text-green-600 font-bold">No brute force attack detected.</p>
                        @endif
                    </div>
                    <div class="p-4 bg-gray-200 dark:bg-gray-700 rounded-lg">
                        <p class="text-gray-700 dark:text-gray-300">
                            Distinct Users Recently Logged In (Last Minute):
                        </p>
                        <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $distinctRecentUsers }}</p>
                        @if($isPossibleDdos)
                            <p class="mt-2 text-red-600 font-bold">Possible DDoS activity detected!</p>
                        @else
                            <p class="mt-2 text-green-600 font-bold">No DDoS activity detected.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>