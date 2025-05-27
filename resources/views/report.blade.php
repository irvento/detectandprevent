
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-center bg-blue-600 p-4 rounded-lg shadow-lg">
            {{ __('Daily Report & Security Assessment') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Print Button & Preview Toggle -->
            <div class="mb-4 text-right flex justify-end space-x-2">
                <button onclick="window.print()" class="bg-blue-600 text-white py-2 px-4 rounded shadow">
                    Print Report
                </button>
                <button id="togglePreviewBtn" class="bg-green-600 text-white py-2 px-4 rounded shadow">
                    Toggle A4 Report
                </button>
            </div>
            <!-- Report Preview (invisible by default; toggled to A4 when activated) -->
            <div id="reportContent" class="hidden bg-white p-6 rounded-lg shadow-lg" style="resize: both; overflow: auto;">
                <!-- Report Title -->
                <h3 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-center bg-green-600 p-4 rounded-lg shadow-lg mb-4">
                    Website Security & Status Report
                </h3>
                <!-- Report Info -->
                <div class="mb-6">
                    <p class="text-md text-gray-700">
                        Date: {{ \Carbon\Carbon::today()->toFormattedDateString() }}
                    </p>
                    <p class="text-md text-gray-700">
                        Prepared by: TralaleroDevs
                    </p>
                </div>
                <!-- Overall Operations -->
                <div class="mb-6">
                    <h4 class="font-semibold text-xl mb-2">Overall Website Operations:</h4>
                    <p class="text-gray-700">
                        The website is currently <span class="font-bold text-green-600">operational</span> with a stable user base and normal login activity. All systems are within expected parameters.
                    </p>
                </div>
            </div>
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
    <!-- JavaScript for toggling A4 preview (visible only when toggled) -->
    <script>
        document.getElementById('togglePreviewBtn').addEventListener('click', function() {
            const report = document.getElementById('reportContent');
            if (report.classList.contains('hidden')) {
                // Show the report with A4 dimensions
                report.classList.remove('hidden');
                report.classList.add('a4-view');
            } else {
                // Hide the report
                report.classList.add('hidden');
                report.classList.remove('a4-view');
            }
        });
    </script>
    <!-- Inline CSS for clear preview and A4 dimensions -->
    <style>
        /* A4 dimensions when toggled */
        .a4-view {
            width: 210mm;
            height: 297mm;
            margin: 0 auto;
            overflow: auto;
        }
        /* Clear preview appearance (if needed, adjust as desired) */
        .print-preview {
            background-color: #fff !important;
            color: #000 !important;
            box-shadow: none !important;
            border: 1px solid #ccc !important;
        }
    </style>
</x-app-layout>