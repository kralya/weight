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
            {period:'DD', format:' EEE, DD MMM'},
            {period:'WW', format:'EEE, DD MMM'},
            {period:'MM', format:'MMM'},
            {period:'YYYY', format:'YYYY'}
        ];
        categoryAxis.boldPeriodBeginning = true;

        // value
        var valueAxis = new AmCharts.ValueAxis();
        valueAxis.inside = true;
        valueAxis.position = 'left';
        chart.addValueAxis(valueAxis);

        var yAxis = new AmCharts.ValueAxis();
        yAxis.position = 'right';
        chart.addValueAxis(yAxis);


        AmCharts.dayNames = ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четвег', 'Пятница', 'Суббота'];
        AmCharts.shortDayNames = ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'];
//        AmCharts.monthNames = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь',
//            'Октябрь', 'Ноябрь', 'Декабрь'];


        // GRAPH
        graph = new AmCharts.AmGraph();
        graph.type = "smoothedLine"; // this line makes the graph smoothed line.
//        graph.type = "line"; // this line makes the graph smoothed line.
        graph.lineColor = "#b0655d";
        graph.bullet = "round";
        graph.bulletSize = <?php echo $bulletSize ?>;
        graph.lineThickness = 3;
        graph.valueField = "value";
        graph.fillAlphas = "0.4";
        graph.valueAxis = yAxis;
        chart.addGraph(graph);

        // HACK for second value axis to be displayed (it has to be attached to a graph). So second graph exactly copies first..
        graph2 = new AmCharts.AmGraph();
        graph2.type = "smoothedLine"; // this line makes the graph smoothed line.
        graph2.lineColor = "#b0655d";
        graph2.bullet = "round";
        graph2.showBalloon = false;
        graph2.bulletSize = 1;
        graph2.lineThickness = 3;
        graph2.valueField = "value";
        graph2.fillAlphas = "0.4";
        graph2.valueAxis = valueAxis;
        chart.addGraph(graph2);

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