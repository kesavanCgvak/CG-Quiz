/*
 *  Document   : compCharts.js
 *  Author     : pixelcave
 *  Description: Custom javascript code used in Charts page
 */

var CompCharts = function () {

    // Get random number function from a given range
    var getRandomInt = function (min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    };

    return {
        init: function () {
            /* Mini Line Charts with jquery.sparkline plugin, for more examples you can check out http://omnipotent.net/jquery.sparkline/#s-about */
            // Randomize easy pie charts values
            var random;

            $('.toggle-pies').click(function () {
                $('.pie-chart').each(function () {
                    random = getRandomInt(1, 100);
                    $(this).data('easyPieChart').update(random);
                });
            });

            /*
             * Flot Charts Jquery plugin is used for charts
             *
             * For more examples or getting extra plugins you can check http://www.flotcharts.org/
             * Plugins included in this template: pie, resize, stack, time
             */

            // Get the elements where we will attach the charts
            var chartClassic = $('#chart-classic');
            var chartStacked = $('#chart-stacked');
            var chartPie = $('#chart-pie');
            var chartBars = $('#chart-bars');
            var chartLive = $('#chart-live');
            var chartMixed = $('#chart-mixed');

            // Data for the charts
            var dataEarnings = [[1, 1900], [2, 2300], [3, 3200], [4, 2500], [5, 4200], [6, 3100], [7, 3600], [8, 2500], [9, 4600], [10, 3700], [11, 4200], [12, 5200]];
            var dataSales = [[1, 850], [2, 750], [3, 1500], [4, 900], [5, 1500], [6, 1150], [7, 1500], [8, 900], [9, 1800], [10, 1700], [11, 1900], [12, 2550]];
            var dataTickets = [[1, 130], [2, 330], [3, 220], [4, 350], [5, 150], [6, 275], [7, 280], [8, 380], [9, 120], [10, 330], [11, 190], [12, 410]];

            var dataSalesBefore = [[1, 200], [4, 350], [7, 700], [10, 950], [13, 800], [16, 1050], [19, 1200], [22, 750], [25, 980], [28, 1300], [31, 1350], [34, 1200]];
            var dataSalesAfter = [[2, 450], [5, 700], [8, 980], [11, 1200], [14, 1350], [17, 1200], [20, 1530], [23, 1750], [26, 1300], [29, 1620], [32, 1750], [35, 1750]];

            var dataMonths = [[1, 'Jan'], [2, 'Feb'], [3, 'Mar'], [4, 'Apr'], [5, 'May'], [6, 'Jun'], [7, 'Jul'], [8, 'Aug'], [9, 'Sep'], [10, 'Oct'], [11, 'Nov'], [12, 'Dec']];
            var dataMonthsBars = [[2, 'Jan'], [5, 'Feb'], [8, 'Mar'], [11, 'Apr'], [14, 'May'], [17, 'Jun'], [20, 'Jul'], [23, 'Aug'], [26, 'Sep'], [29, 'Oct'], [32, 'Nov'], [35, 'Dec']];

            // Bars Chart
            $.plot(chartBars,
                    [
                        {
                            label: 'Sales Before',
                            data: dataSalesBefore,
                            bars: {show: true, lineWidth: 0, fillColor: {colors: [{opacity: .6}, {opacity: .6}]}}
                        },
                        {
                            label: 'Sales After',
                            data: dataSalesAfter,
                            bars: {show: true, lineWidth: 0, fillColor: {colors: [{opacity: .6}, {opacity: .6}]}}
                        }
                    ],
                    {
                        colors: ['#5ccdde', '#454e59'],
                        legend: {show: true, position: 'nw', backgroundOpacity: 0},
                        grid: {borderWidth: 0},
                        yaxis: {ticks: 3, tickColor: '#f5f5f5'},
                        xaxis: {ticks: dataMonthsBars, tickColor: '#f5f5f5'}
                    }
            );

        }
    };
}();