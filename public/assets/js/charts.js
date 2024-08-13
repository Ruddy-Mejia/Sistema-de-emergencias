/******/ (() => { // webpackBootstrap
    var __webpack_exports__ = {};
    /*!********************************************************!*\
      !*** ./resources/js/pages/dashboard-analytics.init.js ***!
      \********************************************************/
    /*
    Template Name: Velzon - Admin & Dashboard Template
    Author: Themesbrand
    Website: https://Themesbrand.com/
    Contact: Themesbrand@gmail.com
    File: Analytics sales init js
    */
    // get colors array from the string
    function getChartColorsArray(chartId) {
        if (document.getElementById(chartId) !== null) {
            var colors = document.getElementById(chartId).getAttribute("data-colors");

            if (colors) {
                colors = JSON.parse(colors);
                return colors.map(function (value) {
                    var newValue = value.replace(" ", "");

                    if (newValue.indexOf(",") === -1) {
                        var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
                        if (color) return color; else return newValue;
                        ;
                    } else {
                        var val = value.split(',');

                        if (val.length == 2) {
                            var rgbaColor = getComputedStyle(document.documentElement).getPropertyValue(val[0]);
                            rgbaColor = "rgba(" + rgbaColor + "," + val[1] + ")";
                            return rgbaColor;
                        } else {
                            return newValue;
                        }
                    }
                });
            } else {
                console.warn('data-colors atributes not found on', chartId);
            }
        }
    } // world map with line & markers


    var vectorMapWorldLineColors = getChartColorsArray("users-by-country");

    if (vectorMapWorldLineColors) {
        var worldlinemap = new jsVectorMap({
            map: "world_merc",
            selector: "#users-by-country",
            zoomOnScroll: false,
            zoomButtons: false,
            markers: [{
                name: "La Paz",
                coords: [-16.5205316, -68.2064802]
            },{
                name: "Beni",
                coords: [-13.4180275, -67.0469951]
            },
            {
                name: "Pando",
                coords: [-11.0781257, -68.7496485]
            }, {
                name: "Cochabamba",
                coords: [-17.3938784,-66.2462782]
            }, {
                name: "Oruro",
                coords: [-17.961072,-67.1698575,]
            }, {
                name: "Potosí",
                coords: [-19.5710519,-65.7920885]
            }, {
                name: "Chuquisaca",
                coords: [-19.9074617,-66.5796512]
            }, {
                name: "Tarija",
                coords: [-21.521708,-64.807833]
            }, {
                name: "Santa Cruz",
                coords: [-17.7567133,-63.3413081]
            }],
            // }],
            // lines: [{
            //     from: "Canada",
            //     to: "Egypt"
            // }, {
            //     from: "Russia",
            //     to: "Egypt"
            // }, {
            //     from: "Greenland",
            //     to: "Egypt"
            // }, {
            //     from: "Brazil",
            //     to: "Egypt"
            // }, {
            //     from: "United States",
            //     to: "Egypt"
            // }, {
            //     from: "China",
            //     to: "Egypt"
            // }, {
            //     from: "Norway",
            //     to: "Egypt"
            // }, {
            //     from: "Ukraine",
            //     to: "Egypt"
            // }],
            regionStyle: {
                initial: {
                    stroke: "#9599ad",
                    strokeWidth: 0.25,
                    fill: vectorMapWorldLineColors,
                    fillOpacity: 1
                }
            },
            lineStyle: {
                animation: true,
                strokeDasharray: "6 3 6"
            }
        });
    } // Countries charts


    var barchartCountriesColors = getChartColorsArray("countries_charts");

    if (barchartCountriesColors) {
        var options = {
            series: [{
                data: [1010, 1640, 490, 1255, 1050, 689, 800, 420, 1085, 589],
                name: 'Sessions'
            }],
            chart: {
                type: 'bar',
                height: 436,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    horizontal: true,
                    distributed: true,
                    dataLabels: {
                        position: 'top'
                    }
                }
            },
            colors: barchartCountriesColors,
            dataLabels: {
                enabled: true,
                offsetX: 32,
                style: {
                    fontSize: '12px',
                    fontWeight: 400,
                    colors: ['#adb5bd']
                }
            },
            legend: {
                show: false
            },
            grid: {
                show: false
            },
            xaxis: {
                categories: ['India', 'United States', 'China', 'Indonesia', 'Russia', 'Bangladesh', 'Canada', 'Brazil', 'Vietnam', 'UK']
            }
        };
        var chart = new ApexCharts(document.querySelector("#countries_charts"), options);
        chart.render();
    } // Heatmap Charts Generatedata


    function generateData(count, yrange) {
        var i = 0;
        var series = [];

        while (i < count) {
            var x = (i + 1).toString() + "h";
            var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
            series.push({
                x: x,
                y: y
            });
            i++;
        }

        return series;
    } // Basic Heatmap Charts


    var chartHeatMapBasicColors = getChartColorsArray("audiences-sessions-country-charts");

    if (chartHeatMapBasicColors) {
        var options = {
            series: [{
                name: 'Sat',
                data: generateData(18, {
                    min: 0,
                    max: 90
                })
            }, {
                name: 'Fri',
                data: generateData(18, {
                    min: 0,
                    max: 90
                })
            }, {
                name: 'Thu',
                data: generateData(18, {
                    min: 0,
                    max: 90
                })
            }, {
                name: 'Wed',
                data: generateData(18, {
                    min: 0,
                    max: 90
                })
            }, {
                name: 'Tue',
                data: generateData(18, {
                    min: 0,
                    max: 90
                })
            }, {
                name: 'Mon',
                data: generateData(18, {
                    min: 0,
                    max: 90
                })
            }, {
                name: 'Sun',
                data: generateData(18, {
                    min: 0,
                    max: 90
                })
            }],
            chart: {
                height: 400,
                type: 'heatmap',
                offsetX: 0,
                offsetY: -8,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                heatmap: {
                    colorScale: {
                        ranges: [{
                            from: 0,
                            to: 50,
                            color: chartHeatMapBasicColors[0]
                        }, {
                            from: 51,
                            to: 100,
                            color: chartHeatMapBasicColors[1]
                        }]
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: true,
                horizontalAlign: 'center',
                offsetX: 0,
                offsetY: 20,
                markers: {
                    width: 20,
                    height: 6,
                    radius: 2
                },
                itemMargin: {
                    horizontal: 12,
                    vertical: 0
                }
            },
            colors: chartHeatMapBasicColors,
            tooltip: {
                y: [{
                    formatter: function formatter(y) {
                        if (typeof y !== "undefined") {
                            return y.toFixed(0) + "k";
                        }

                        return y;
                    }
                }]
            }
        };
        var chart = new ApexCharts(document.querySelector("#audiences-sessions-country-charts"), options);
        chart.render();
    } // Audiences metrics column charts


    var chartAudienceColumnChartsColors = getChartColorsArray("audiences_metrics_charts");

    if (chartAudienceColumnChartsColors) {
        var array = [];
        var array1 = [];

        data.forEach(function (item) {
            array.push(item.cantidad);
        });
        data1.forEach(function (item) {
            array1.push(item.cantidad);
        });
        var columnoptions = {
            series: [{
                name: 'Este año',
                data: array
            },
                {
                    name: 'Año pasado',
                    data: array1
                }
            ],
            chart: {
                type: 'bar',
                height: 309,
                stacked: true,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '20%',
                    borderRadius: 6
                }
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: true,
                position: 'bottom',
                horizontalAlign: 'center',
                fontWeight: 400,
                fontSize: '8px',
                offsetX: 0,
                offsetY: 0,
                markers: {
                    width: 9,
                    height: 9,
                    radius: 4
                }
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            grid: {
                show: false
            },
            colors: chartAudienceColumnChartsColors,
            xaxis: {
                categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                axisTicks: {
                    show: false
                },
                axisBorder: {
                    show: true,
                    strokeDashArray: 1,
                    height: 1,
                    width: '100%',
                    offsetX: 0,
                    offsetY: 0
                }
            },
            yaxis: {
                show: false
            },
            fill: {
                opacity: 1
            }
        };
        var chart = new ApexCharts(document.querySelector("#audiences_metrics_charts"), columnoptions);
        chart.render();
    } // User by devices


    var dountchartUserDeviceColors = getChartColorsArray("user_device_pie_charts");

    if (dountchartUserDeviceColors) {
        var options = {
            series: [78.56, 105.02, 42.89],
            labels: ["Desktop", "Mobile", "Tablet"],
            chart: {
                type: "donut",
                height: 219
            },
            plotOptions: {
                pie: {
                    size: 100,
                    donut: {
                        size: "76%"
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false,
                position: 'bottom',
                horizontalAlign: 'center',
                offsetX: 0,
                offsetY: 0,
                markers: {
                    width: 20,
                    height: 6,
                    radius: 2
                },
                itemMargin: {
                    horizontal: 12,
                    vertical: 0
                }
            },
            stroke: {
                width: 0
            },
            yaxis: {
                labels: {
                    formatter: function formatter(value) {
                        return value + "k" + " Users";
                    }
                },
                tickAmount: 4,
                min: 0
            },
            colors: dountchartUserDeviceColors
        };
        var chart = new ApexCharts(document.querySelector("#user_device_pie_charts"), options);
        chart.render();
    }
    /******/
})()
    ;
