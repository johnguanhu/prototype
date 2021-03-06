<script type="text/javascript">
    (function () {
        nv.addGraph(function () {
            var chart = nv.models.lineChart()
                    .margin({
                        right: 10
                    })
                    .useInteractiveGuideline(true) //We want nice looking tooltips and a guideline!
                    .showLegend(true) //Show the legend, allowing users to turn on/off line series.
                    .showYAxis(true) //Show the y-axis
                    .showXAxis(true) //Show the x-axis
                    ;

            chart.xAxis //Chart x-axis settings
                    .axisLabel('Time (ms)')
                    .tickFormat(d3.format(',r'));

            chart.yAxis //Chart y-axis settings
                    .axisLabel('Voltage (v)')
                    .tickFormat(d3.format('.02f'));

            /* Done setting the chart up? Time to render it!*/
            var myData = sinAndCos(); //You need data...

            d3.select('#chart1').append('svg') //Select the <svg> element you want to render the chart in.   
                    .datum(myData) //Populate the <svg> element with chart data...
                    .call(chart); //Finally, render the chart!

            //Update the chart when window resizes.
            nv.utils.windowResize(function () {
                chart.update()
            });
            return chart;
        });

        function sinAndCos() {
            var sin = [],
                    sin2 = [],
                    cos = [];

            //Data is represented as an array of {x,y} pairs.
            for (var i = 0; i < 100; i++) {
                sin.push({
                    x: i,
                    y: Math.sin(i / 10)
                });
                sin2.push({
                    x: i,
                    y: Math.sin(i / 10) * 0.25 + 0.5
                });
                cos.push({
                    x: i,
                    y: .5 * Math.cos(i / 10)
                });
            }

            //Line chart data should be sent as an array of series objects.
            return [{
                    values: sin, //values - represents the array of {x,y} data points
                    key: 'Sine Wave', //key  - the name of the series.
                    color: '#ff7f0e' //color - optional: choose your own line color.
                }, {
                    values: cos,
                    key: 'Cosine Wave',
                    color: '#2ca02c'
                }, {
                    values: sin2,
                    key: 'Another sine wave',
                    color: '#7777ff',
                    area: true //area - set to true if you want this line to turn into a filled area chart.
                }];
        }
    }());



    /*
     * Stacked Area Chart
     */
    (function () {
        /*Data sample:
         { 
         "key" : "North America" , 
         "values" : [ [ 1025409600000 , 23.041422681023] , [ 1028088000000 , 19.854291255832],
         [ 1030766400000 , 21.02286281168], 
         [ 1033358400000 , 22.093608385173],
         [ 1036040400000 , 25.108079299458],
         [ 1038632400000 , 26.982389242348]
         ...
         
         */
        d3.json('<?php print _MEDIA_URL ?>assets/_con/nvd3/stackedAreaData.json', function (data) {
            nv.addGraph(function () {
                var chart = nv.models.stackedAreaChart()
                        .margin({
                            right: 40,
                            left: 40
                        })
                        .x(function (d) {
                            return d[0]
                        }) //We can modify the data accessor functions...
                        .y(function (d) {
                            return d[1]
                        }) //...in case your data is formatted differently.
                        .useInteractiveGuideline(true) //Tooltips which show all data points. Very nice!
                        .rightAlignYAxis(true) //Let's move the y-axis to the right side.
                        .showControls(true) //Allow user to choose 'Stacked', 'Stream', 'Expanded' mode.
                        .clipEdge(true);

                //Format x-axis labels with custom function.
                chart.xAxis
                        .tickFormat(function (d) {
                            return d3.time.format('%x')(new Date(d))
                        });

                chart.yAxis
                        .tickFormat(d3.format(',.2f'));

                d3.select('#chart2').append('svg')
                        .datum(data)
                        .call(chart);

                nv.utils.windowResize(chart.update);

                return chart;
            });
        })
    }());



    /*
     * Discrete Bar Chart
     */
    (function () {
        nv.addGraph(function () {
            var chart = nv.models.discreteBarChart()
                    .margin({
                        right: 10,
                        left: 40
                    })
                    .x(function (d) {
                        return d.label
                    }) //Specify the data accessors.
                    .y(function (d) {
                        return d.value
                    })
                    .staggerLabels(true) //Too many bars and not enough room? Try staggering labels.
                    .showValues(true) //...instead, show the bar value right on top of each bar.
                    ;

            d3.select('#chart3').append('svg')
                    .datum(exampleData())
                    .call(chart);

            nv.utils.windowResize(chart.update);

            return chart;
        });

        //Each bar represents a single discrete quantity.
        function exampleData() {
            return [{
                    key: "Cumulative Return",
                    values: [{
                            "label": "A Label",
                            "value": -29.765957771107
                        }, {
                            "label": "B Label",
                            "value": 0
                        }, {
                            "label": "C Label",
                            "value": 32.807804682612
                        }, {
                            "label": "D Label",
                            "value": 196.45946739256
                        }, {
                            "label": "E Label",
                            "value": 0.19434030906893
                        }, {
                            "label": "F Label",
                            "value": -98.079782601442
                        }, {
                            "label": "G Label",
                            "value": -13.925743130903
                        }, {
                            "label": "H Label",
                            "value": -5.1387322875705
                        }]
                }]
        }
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

            d3.select('#chart4').append('svg')
                    .datum(exampleData())
                    .transition().duration(350)
                    .call(chart);

            return chart;
        });

        //Pie chart example data. Note how there is only a single array of key-value pairs.
        function exampleData() {
            return [{
                    "label": "One",
                    "value": 29.765957771107
                }, {
                    "label": "Two",
                    "value": 0
                }, {
                    "label": "Three",
                    "value": 32.807804682612
                }, {
                    "label": "Four",
                    "value": 196.45946739256
                }, {
                    "label": "Five",
                    "value": 0.19434030906893
                }, {
                    "label": "Six",
                    "value": 98.079782601442
                }, {
                    "label": "Seven",
                    "value": 13.925743130903
                }, {
                    "label": "Eight",
                    "value": 5.1387322875705
                }];
        }
    }());

    (function () {
        /*Data sample:
         { 
         "key" : "North America" , 
         "values" : [ [ 1025409600000 , 23.041422681023] , [ 1028088000000 , 19.854291255832],
         [ 1030766400000 , 21.02286281168], 
         [ 1033358400000 , 22.093608385173],
         [ 1036040400000 , 25.108079299458],
         [ 1038632400000 , 26.982389242348]
         ...
         
         */
         nv.addGraph(function () {
                var chart = nv.models.lineWithFocusChart();

                chart.xAxis
                        .tickFormat(d3.format(',f'));

                chart.yAxis
                        .tickFormat(d3.format(',.2f'));

                chart.y2Axis
                        .tickFormat(d3.format(',.2f'));

                d3.select('#chart5 svg')
                        .datum(testData())
                        .transition().duration(500)
                        .call(chart);

                nv.utils.windowResize(chart.update);

                return chart;
            });
        function testData() {
            return stream_layers(3, 128, .1).map(function (data, i) {
                return {
                    key: 'Stream' + i,
                    values: data
                };
            });
        }
    }());

</script>