
<x-app-layout>
    @php
        // Provide default values if not passed from the controller.
        $trafficLabels = $trafficLabels ?? ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $trafficData = $trafficData ?? [0, 0, 0, 0, 0, 0, 0];
        $failedGraphLabels = $failedGraphLabels ?? ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $failedGraphData = $failedGraphData ?? [0, 0, 0, 0, 0, 0, 0];
        $failedAttemptsRecords = $failedAttemptsRecords ?? collect([]);
    @endphp
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-4">
                <!-- Traffic Graph (Line Chart) -->
                <div class="mt-8">
                    <h2 class="ms-3 text-xl font-semibold text-gray-900 dark:text-white">
                        User Traffic (This Week)
                    </h2>
                    <x-traffic-graph :labels="$trafficLabels" :data="$trafficData" />
                </div>
                <!-- Failed Attempts Graph (Doughnut Chart) -->
                <div class="mt-8">
                    <h2 class="ms-3 text-xl font-semibold text-gray-900 dark:text-white">
                        Failed Login Attempts (This Week)
                    </h2>
                    <x-failed-attempts-graph :failedGraphLabels="$failedGraphLabels" :failedGraphData="$failedGraphData" />
                </div>
                <!-- Failed Attempts Table -->
                <div class="mt-8">
                    <h2 class="ms-3 text-xl font-semibold text-gray-900 dark:text-white">
                        Failed Attempts Details
                    </h2>
                    <x-failed-attempts-table :failedAttemptsRecords="$failedAttemptsRecords" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>