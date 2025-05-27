
<div class="failed-graph-container" style="max-width: 500px; margin: 0 auto;">
    <canvas id="failedChart"></canvas>
</div>
<!-- Include Chart.js from a CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Use the passed data for labels and data points
    const failedLabels = {!! json_encode($failedGraphLabels ?? ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday']) !!};
    const failedDataPoints = {!! json_encode($failedGraphData ?? [0,0,0,0,0,0,0]) !!};
    const failedData = {
         labels: failedLabels,
         datasets: [{
            label: 'Failed Attempts',
            data: failedDataPoints,
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(255, 159, 64, 0.6)',
                'rgba(201, 203, 207, 0.6)'
            ],
            borderWidth: 1,
         }]
    };
    new Chart(document.getElementById('failedChart').getContext('2d'), {
        type: 'doughnut', 
        data: failedData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });
</script>