@extends('skyapp.index')

@section('page_css')

    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all"/>

@endsection

@section('content')

    <div class="ui top attached menu">
        <div class="item">&nbsp;Дом</div>
    </div>

    <div class="ui bottom attached segment">
        <div class="ui cards">
            @foreach($storages as $storage)
                <div class="ui card">
                    <div class="content">
                        <div class="header">
                            {{ $storage->name }}
                        </div>
                        <div class="meta">
                            <i class="plus icon"></i> <span class="right floated">1</span>
                        </div>
                        <div class="meta">
                            3
                        </div>
                        <div class="meta">
                            3
                        </div>
                    </div>
                    <div class="extra content">
                        <div class="header">
                      <span class="right floated">
                       5
                      </span>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </div>

    <div class="ui segment">
        <div id="chartdiv" style="width	: 100%; height: 400px;"></div>
    </div>

@endsection


@section('page_scripts')
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    {{--<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>--}}

@endsection


@section('script')
    <script>
        var chartData = generateChartData();
        var chart = AmCharts.makeChart("chartdiv", {
            "type": "serial",
            "theme": "",
            "marginRight": 80,
            "autoMarginOffset": 20,
            "marginTop": 7,
            "dataProvider": chartData,
            "valueAxes": [{
                "axisAlpha": 0.2,
                "dashLength": 1,
                "position": "left"
            }],
            "mouseWheelZoomEnabled": true,
            "graphs": [{
                "id": "g1",
                "balloonText": "[[value]]" + " p.",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "hideBulletsCount": 50,
                "title": "red line",
                "valueField": "visits",
                "useLineColorForBulletBorder": true,
                "balloon": {
                    "drop": true
                }
            }],
            "chartScrollbar": {
                "autoGridCount": true,
                "graph": "g1",
                "scrollbarHeight": 50
            },
            "chartCursor": {
                "limitToGraph": "g1"
            },
            "categoryField": "date",
            "categoryAxis": {
                "parseDates": true,
                "axisColor": "#DADADA",
                "dashLength": 1,
                "minorGridEnabled": true
            },
            "export": {
                "enabled": false
            }
        });

        chart.addListener("rendered", zoomChart);
        zoomChart();

        // this method is called when chart is first inited as we listen for "rendered" event
        function zoomChart() {
            // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
            chart.zoomToIndexes(chartData.length - 40, chartData.length - 1);
        }

        // generate some random data, quite different range

        // generate some random data, quite different range
        function generateChartData() {

            return chartData = [
                    @forEach ($sells as $key => $value)
                {
                    "date": "{{$key}}",
                    "visits": "{{ $value }}"
                },
                @endforeach
            ];


        }

        //            }, {
        //                "date": "2013-01-28",
        //                "value": 83
        //            },
        //        {
        //                "date": "2013-01-29",
        //                "value": 84
        //            },
        // {
        //                "date": "2013-01-30",
        //                "value": 81
        //            }]
        //        });


    </script>
@endsection


