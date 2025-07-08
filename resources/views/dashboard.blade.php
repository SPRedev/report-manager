<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Dashboard</h2>
    </x-slot>

  <div class="bg-white shadow rounded-lg p-4 w-full max-w-sm">
    <h3 class="text-lg font-semibold text-gray-800 mb-3">📊 Predom Status Overview</h3>

    <div class="relative h-64 w-64"> <!-- fixed size for smaller chart -->
        <canvas id="predomStatusChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const data = {
        labels: @json(array_keys($statusCounts)),
        datasets: [{
            label: 'Status Count',
            data: @json(array_values($statusCounts)),
            backgroundColor: [
                '#34D399', // approved - green
                '#FBBF24', // pending - yellow
                '#F87171', // rejected - red
                '#9CA3AF'  // unknown - gray
            ],
            hoverOffset: 4
        }]
    };

    const config = {
        type: 'doughnut',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: false
                }
            }
        }
    };

    new Chart(
        document.getElementById('predomStatusChart'),
        config
    );
</script>

</x-app-layout>
