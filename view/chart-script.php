<?php //var_dump($trendPoints); ?>

<script src="js/amcharts.avjs" type="text/javascript"></script>
<script type="text/javascript">
    var chart;
    var graph;

    // months in JS are zero-based, 0 means January
    var chartData = [
    <?php foreach ($weights as $date => $weight) { ?>
        <?php if (!empty($weight['weight'])) { ?>
            {
                'year':new Date(<?php echo str_replace('-', ', ', $weight['js-date']) ?>),
                'value':'<?php echo $weight['weight'] ?>',
                <?php if (isset($weight['color'])) { ?>
                'color':"<?php echo $weight['color'] ?>"
                <?php } ?>
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
        categoryAxis.dateFormats = [
            {period:'fff', format:'JJ:NN:SS'},
            {period:'ss', format:'JJ:NN:SS'},
            {period:'mm', format:'JJ:NN'},
            {period:'hh', format:'JJ:NN'},
            {period:'DD', format:'MMM DD EEE'},
            {period:'WW', format:'MMM DD EEE'},
            {period:'MM', format:'MMM'},
            {period:'YYYY', format:'YYYY'}
        ];
        categoryAxis.boldPeriodBeginning = true;

        // value
        var valueAxis = new AmCharts.ValueAxis();
        valueAxis.axisAlpha = 0;
        valueAxis.inside = true;
        chart.addValueAxis(valueAxis);

        AmCharts.dayNames = ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четвег', 'Пятница', 'Суббота'];
        AmCharts.shortDayNames = ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'];

        // GRAPH
        graph = new AmCharts.AmGraph();
        graph.type = "smoothedLine"; // this line makes the graph smoothed line.
//        graph.type = "line"; // this line makes the graph smoothed line.
        graph.lineColor = "#b0655d";
        graph.bullet = "round";
        graph.bulletSize = <?php echo $bulletSize ?>;
        graph.lineThickness = 3;
        graph.valueField = "value";

        // not working!
        graph.lineColorField = "color";
        graph.fillColorsField = "color";
//        graph.descriptionField = 'lineColor';

        // working
//        graph.fillColors = 'green';
        graph.fillAlphas = "0.4";
        chart.addGraph(graph);

    <?php if (is_array($trendPoints)) { ?>

        trendLine = new AmCharts.TrendLine();
        var trendLine = new AmCharts.TrendLine();
        trendLine.initialDate = new Date(<?php echo $trendPoints[0][0]?>); // 12 is hour - to start trend line in the middle of the day
        trendLine.initialValue = <?php echo $trendPoints[0][1]?>;

        trendLine.finalDate = new Date(<?php echo $trendPoints[1][0]?>);
        trendLine.finalValue = <?php echo $trendPoints[1][1]?>;

        trendLine.lineColor = "green";
        trendLine.lineThickness = '4px';

        chart.addTrendLine(trendLine);

        <?php } ?>

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
        chart.zoomToDates(new Date(2012, 0), new Date(<?php echo date("Y") + 1 ?>, 0));
    }
</script>