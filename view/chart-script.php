    <script src="js/amcharts.js" type="text/javascript"></script>
    <script type="text/javascript">
        var chart;
        var graph;

        // months in JS are zero-based, 0 means January
        var chartData = [
        <?php foreach ($weights as $date => $weight) { ?>
            <?php if (!empty($weight)) { ?>
                {
                    year:new Date(<?php echo str_replace('-', ', ', $date) ?>),
                    value: <?php echo $weight ?>
                },
                <?php } ?>
            <?php } ?>

        ];

        AmCharts.ready(function () {
            // SERIAL CHART
            chart = new AmCharts.AmSerialChart();
            chart.pathToImages = "../amcharts/images/";
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

            // value
            var valueAxis = new AmCharts.ValueAxis();
            valueAxis.axisAlpha = 0;
            valueAxis.inside = true;
            chart.addValueAxis(valueAxis);

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
            chart.zoomToDates(new Date(2012, 0), new Date(2012, 12));
        }
    </script>