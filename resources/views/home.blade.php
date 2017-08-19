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
                        @foreach($storage->bills_model as $bill)
                            <div class="meta">
                                <i class="{{ $bill->image }} icon"></i> <span class="right floated"> {{ $bill->SumBillShift() }}
                                    p.</span>
                            </div>

                        @endforeach
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
        var chart = AmCharts.makeChart("chartdiv", {
            "type": "serial",
            "theme": "light",
            "marginTop": 0,
            "marginRight": 80,
            "dataProvider": [
                    @forEach ($sells as $key => $value)
                {
                    "day": "{{$key}}",
                    "value": "{{ $value['r_sell'] }}",
                    "value2": "{{ $value['w_sell'] }}",
                    "value3": "{{ $value['sell'] }}"
                },
                @endforeach
            ],
            "valueAxes": [{
                "axisAlpha": 0,
                "position": "left"
            }],
            "graphs": [
                {
                    "id": "g1",
                    "balloonText": "[[category]]<br><b><span style='font-size:12px;'>[[value]]</span></b>",
                "bullet": "round",
                    "bulletSize": 8,
                    "lineColor": "#d1655d",
                    "lineThickness": 2,
                    "negativeLineColor": "#637bb6",
                    "title": "Розничные продажи",
                    "type": "smoothedLine",
                    "valueField": "value"
                },
                {
                    "id": "g2",
                    "balloonText": "[[category]]<br><b><span style='font-size:12px;'>[[value]]</span></b>",
                    "bullet": "round",
                    "bulletSize": 8,
                    "lineColor": "#423dd1",
                    "lineThickness": 2,
                    "negativeLineColor": "#637bb6",
                    "title": "Оптовые продажи",
                    "type": "smoothedLine",
                    "valueField": "value2"
                },
                {
                    "id": "g3",
                    "balloonText": "[[category]]<br><b><span style='font-size:12px;'>[[value]]</span></b>",
                    "bullet": "round",
                    "bulletSize": 8,
                    "lineColor": "#2bd13e",
                    "lineThickness": 2,
                    "negativeLineColor": "#637bb6",
                    "title": "Общая",
                    "type": "smoothedLine",
                    "valueField": "value3"
                }
            ],
            "chartScrollbar": {
                "graph": "g3",
                "gridAlpha": 0,
                "color": "#888888",
                "scrollbarHeight": 55,
                "backgroundAlpha": 0,
                "dragIcon": "dragIconRectSmallBlack",
                "selectedBackgroundAlpha": 0.1,
                "selectedBackgroundColor": "#888888",
                "graphFillAlpha": 0,
                "autoGridCount": true,
                "selectedGraphFillAlpha": 0,
                "graphLineAlpha": 0.2,
                "graphLineColor": "#c2c2c2",
                "selectedGraphLineColor": "#888888",
                "selectedGraphLineAlpha": 1

            },
            "chartCursor": {
                "categoryBalloonDateFormat": "YYYY-MM-DD",
                "cursorAlpha": 0,
                "valueLineEnabled": true,
                "valueLineBalloonEnabled": true,
                "valueLineAlpha": 0.5,
                "fullWidth": true
            },
            "dataDateFormat": "YYYY-MM-DD",
            "categoryField": "day",
            "categoryAxis": {
                "minPeriod": "DD",
                "parseDates": true,
                "minorGridAlpha": 0.1,
                "minorGridEnabled": true
            },
            "export": {
                "enabled": false
            },
            "legend": {
                "enabled": true,
                "useGraphSettings": true
            },
        });

        chart.addListener("rendered", zoomChart);
        if (chart.zoomChart) {
            chart.zoomChart();
        }

        function zoomChart() {
            chart.zoomToIndexes(Math.round(chart.dataProvider.length * 0.4), Math.round(chart.dataProvider.length * 0.55));
        }


    </script>
@endsection


