<script src="js/amcharts.avjs" type="text/javascript"></script>
<script type="text/javascript">
    var chart;
    var graph;

    // months in JS are zero-based, 0 means January
    var chartData = [
    <?php foreach ($weights as $date => $weight) { ?>
        <?php if (!empty($weight['weight'])) { ?>
            {
                year:new Date(<?php echo str_replace('-', ', ', $weight['js-date']) ?>),
                value: <?php echo $weight['weight'] ?>
            },
            <?php } ?>
        <?php } ?>
    ];

    AmCharts.ready(function () {
        // SERIAL CHART
        chart = new AmCharts.AmSerialChart();
        chart.pathToImages = "/img/";
        chart.dataProvider = chartData;
        chart.marginLeft = 10;
        chart.categoryField = "year";
        chart.zoomOutButton = {
            backgroundColor:'#000000',
            backgroundAlpha:0.15
        };

        // listen for "dataUpdated" event (fired when chart is inited) and call zoomChart method when it happens
        chart.addListener("dataUpdated", zoomChart);

        // AXES
        // category
        var categoryAxis = chart.categoryAxis;
        categoryAxis.parseDates = true; // as our data is date-based, we set parseDates to true
        categoryAxis.minPeriod = "DD"; // our data is yearly, so we set minPeriod to YYYY
        categoryAxis.gridAlpha = 0;
        categoryAxis.dateFormats = [{period:'fff',format:'JJ:NN:SS'},{period:'ss',format:'JJ:NN:SS'},{period:'mm',format:'JJ:NN'},{period:'hh',format:'JJ:NN'},{period:'DD',format:'MMM DD EEEE'},{period:'WW',format:'MMM DD EEE'},{period:'MM',format:'MMM'},{period:'YYYY',format:'YYYY'}];
        categoryAxis.boldPeriodBeginning = true;
        categoryAxis.parseDates = true;

        // value
        var valueAxis = new AmCharts.ValueAxis();
        valueAxis.axisAlpha = 0;
        valueAxis.inside = true;
        chart.addValueAxis(valueAxis);

        AmCharts.dayNames = ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четвег', 'Пятница', 'Суббота'];

        // GRAPH
        graph = new AmCharts.AmGraph();
        graph.type = "smoothedLine"; // this line makes the graph smoothed line.
        graph.lineColor = "#d1655d";
        graph.negativeLineColor = "#637bb6"; // this line makes the graph to change color when it drops below 0
        graph.bullet = "round";
        graph.bulletSize = 5;
        graph.lineThickness = 2;
        graph.valueField = "value";
        chart.addGraph(graph);


        // CURSOR
        var chartCursor = new AmCharts.ChartCursor();
        chartCursor.cursorAlpha = 0;
        chartCursor.cursorPosition = "mouse";
        chartCursor.categoryBalloonDateFormat = "DD";
        chart.addChartCursor(chartCursor);

        // SCROLLBAR
        var chartScrollbar = new AmCharts.ChartScrollbar();
        chartScrollbar.graph = graph;
        chartScrollbar.backgroundColor = "#DDDDDD";
        chartScrollbar.scrollbarHeight = 30;
        chartScrollbar.selectedBackgroundColor = "#FFFFFF";
        chart.addChartScrollbar(chartScrollbar);

        // WRITE
        chart.write("chartdiv");
    });

    // this method is called when chart is first inited as we listen for "dataUpdated" event
    function zoomChart() {
        // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
        chart.zoomToDates(new Date(2012, 0), new Date(<?php echo date("Y")+1 ?>, 0));
    }
</script>