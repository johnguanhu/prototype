<script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/flot/jquery.flot.js"></script>
<script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/flot/jquery.flot.time.js"></script>
<script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/flot/jquery.flot.pie.js"></script>
<script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/flot/jquery.flot.categories.js"></script>
<script type="text/javascript" src="<?php print _MEDIA_URL ?>bower_components/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>


<script type="text/javascript">
    
    // Line Chart
    (function() {
        var chart = $("#flotLineChart");
        var data1 = {
            data: [
                [1, 3],
                [2, 4],
                [3, 3],
                [4, 6],
                [5, 5],
                [6, 7],
                [7, 8],
            ],
            label: "Home",                
        };
        var data2 = {
            data: [                
                [7, 8],
                [8, 6],
                [9, 7],
                [10, 7]
            ],
            label: "Away",
            lines: { show: true, fill: true ,lineWidth: 1}
        };
        var data3 = {
            data: [                
                [7, 8]
            ],
            label: "Injury",
            points: { show: true, radius: 4,lineWidth: 2}
        };
        var options = {
            series: {
                lines: {
                    show: true,
                    lineWidth: 1,
                    fill: true,
                    fillColor: {
                        colors: [{
                            opacity: 0.1
                        }, {
                            opacity: 0.13
                        }]
                    }
                },
                points: {
                    show: true,
                    lineWidth: 1,
                    radius: 3
                },
                shadowSize: 0,
                stack: true
            },
            grid: {
                hoverable: true,
                clickable: true,
                tickColor: "#f9f9f9",
                borderWidth: 0
            },
            legend: {
                // show: false
                backgroundOpacity: 0,
                labelBoxBorderColor: "#fff"
            },
            colors: [ "#009688","#888888","#000"],
            xaxis: {
                ticks: [
                    [1, "A | CHI"],
                    [2, "H | NYK"],
                    [3, "H | DAL"],
                    [4, "H | HOU"],
                    [5, "A | LAC"],
                    [6, "A | MIN"],
                    [7, "A | SAS"],
                    [8, "H |  CHA"],
                    [9, "A | LAL"],
                    [10, "H | IND"]
                ],
                font: {
                    family: "Roboto,sans-serif",
                    color: "#ccc"
                }
            },
            yaxis: {
                ticks: 7,
                tickDecimals: 0,
                font: {
                    color: "#ccc"
                }
            }
        };

        function initFlot() {
            $.plot(chart, [data1, data2, data3], options);
            chart.find('.legend table').css('width', 'auto')
                .find('td').css('padding', 5);
        }
        initFlot();
        $(window).on('resize', initFlot);

        function showTooltip(x, y, contents) {
            $('<div id="tooltip">' + contents + '</div>').css({
                position: 'absolute',
                display: 'none',
                top: y - 40,
                left: x - 55,
                color: "#fff",
                padding: '5px 10px',
                'border-radius': '3px',
                'background-color': 'rgba(0,0,0,0.6)'
            }).appendTo("body").fadeIn(200);
        }

        var previousPoint = null;
        chart.bind("plothover", function(event, pos, item) {
            if (item) {
                console.log(item);
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;

                    $("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(0),
                        y = item.datapoint[1].toFixed(0);

                    var month = item.series.xaxis.ticks[item.dataIndex].label;
                    var tool_text = '';
                    if(item.series.label=="Key Player Injured"){
                        tool_text += "Kevin Durant Injured";
                    }else{
                        tool_text += "AWY vs. Team X (W 112-100) " + y;                        
                    }
                    showTooltip(item.pageX, item.pageY, tool_text);
                }
            } else {
                $("#tooltip").remove();
                previousPoint = null;
            }
        });
    }());
    
    (function () {
        d3.json('<?php print _MEDIA_URL ?>cumulativeLineData.json', function (data) {
            nv.addGraph(function () {
                var chart = nv.models.cumulativeLineChart()
                        .x(function (d) {
                            return d[0]
                        })
                        .y(function (d) {
                            return d[1] / 100
                        }) //adjusting, 100% is 1.00, not 100 as it is in the data
                        .color(d3.scale.category10().range())
                        .useInteractiveGuideline(true)
                        ;

                chart.xAxis
                        .tickValues([1078030800000,1122782400000,1167541200000,1251691200000])
                        .tickFormat(function (d) {
                            return d3.time.format('%x')(new Date(d))
                        });

                chart.yAxis
                        .tickFormat(d3.format(',.1%'));

                d3.select('#chart1').append('svg')
                        .datum(data)
                        .call(chart);

                //TODO: Figure out a good way to do this automatically
                nv.utils.windowResize(chart.update);

                return chart;
            });
        });

    }());




    /*
     * Pie Chart
     */
    (function () {
        //Donut chart example
        nv.addGraph(function () {
            var chart = nv.models.pieChart()
                    .x(function (d) {
                        return d.label
                    })
                    .y(function (d) {
                        return d.value
                    })
                    .showLabels(true) //Display pie labels
                    .labelThreshold(.05) //Configure the minimum slice size for labels to show up
                    .labelType("percent") //Configure what type of data to show in the label. Can be "key", "value" or "percent"
                    .donut(true) //Turn on Donut mode. Makes pie chart look tasty!
                    .donutRatio(0.35) //Configure how big you want the donut hole size to be.
                    ;

            d3.select('#chart2').append('svg')
                    .datum(exampleData())
                    .transition().duration(350)
                    .call(chart);

            return chart;
        });

        //Pie chart example data. Note how there is only a single array of key-value pairs.
        function exampleData() {
            return [{
                    "label": "Free Throws",
                    "value": 0.2
                }, {
                    "label": "Twos",
                    "value": 0.45
                }, {
                    "label": "Threes",
                    "value": 0.35
                }];
        }
    }());
</script>