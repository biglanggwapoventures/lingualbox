$(document).ready(function () {
    var ctx = $("#myChart");
    var lineData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'HIRED',
            backgroundColor: "rgba(75,192,192,0.4)",
            borderColor: "rgba(75,192,192,1)",
            data: ctx.data('hired')
        }, {
            label: 'FAILED',
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255,99,132,1)',
            data: ctx.data('failed')
        }, {
            label: 'REGISTERED',
            backgroundColor: 'rgba(255,255,0, 0.2)',
            borderColor: 'rgba(255,255,0, 1)',
            data: ctx.data('registered')
        }]
    }
    var myChart = new Chart(ctx, {
        type: 'line',

        data: lineData,
        options: {
            scales: {
                xAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
})