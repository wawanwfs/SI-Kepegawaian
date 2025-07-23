$(function() {
    // Card Animation
    $('.card').hover(
        function() {
            $(this).addClass('shadow-lg').css('cursor', 'pointer');
        },
        function() {
            $(this).removeClass('shadow-lg');
        }
    );

    // Kehadiran Chart
    var kehadiranChartCanvas = $("#kehadiranChart").get(0).getContext("2d");
    if (kehadiranChartCanvas) {
        var kehadiranData = JSON.parse($('#kehadiranChart').attr('data-kehadiran'));

        var kehadiranChart = new Chart(kehadiranChartCanvas, {
            type: 'line',
            data: {
                labels: kehadiranData.labels,
                datasets: [{
                    label: 'Kehadiran (%)',
                    data: kehadiranData.data,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    }


    // Status Chart
    var statusChartCanvas = $("#statusChart").get(0).getContext("2d");
    if (statusChartCanvas) {
        var statusData = {
            labels: [
                'Karyawan Tetap',
                'Karyawan Kontrak'
            ],
            datasets: [{
                data: [$('#statusChart').attr('data-tetap'), $('#statusChart').attr('data-kontrak')],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        };

        var statusChart = new Chart(statusChartCanvas, {
            type: 'pie',
            data: statusData,
        });
    }


    // Karyawan Table
    $('#karyawanTable').DataTable();

    // Cuti Table
    $('#cutiTable').DataTable();

    // Penilaian Kinerja Table
    $('#penilaianKinerjaTable').DataTable();
});
