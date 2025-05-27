
<div class="traffic-graph-container" style="max-width: 600px; margin: 0 auto;">
    <canvas id="trafficChart"></canvas>
</div>
<!-- Include Chart.js from a CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Use default data if not passed
    const labels = {!! isset($labels) ? json_encode($labels) : json_encode(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']) !!};
    const dataPoints = {!! isset($data) ? json_encode($data) : json_encode([12, 19, 3, 5, 2, 3, 10]) !!};
    const trafficData = {
        labels: labels,
        datasets: [{
            label: 'User Traffic',
            data: dataPoints,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
            tension: 0.4,
            fill: true,
        }]
    };
    const config = {
        type: 'line',
        data: trafficData,
        options: {
            responsive: true,
            maintainAspectRatio: false,  // Allows you to control the height separately
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };
    // Set a fixed height for the container by modifying the canvas height via CSS
    // You can also directly set height attribute in the canvas element: <canvas id="trafficChart" height="250"></canvas>
    document.getElementById('trafficChart').style.height = '250px';
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('trafficChart').getContext('2d');
        new Chart(ctx, config);
    });
</script>