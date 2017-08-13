<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Static top for Semantic-UI</title>
    <meta name="description" content="">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name="mobile-web-app-capable" content="yes">

    <!-- build:css styles/vendor.css -->
    <!-- bower:css -->
    <link href="{{ asset("semantic/") }}/css/semantic.css" rel="stylesheet" type="text/css"/>

    <!-- endbower -->
    <!-- endbuild -->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,300&subset=latin,vietnamese' rel='stylesheet'
          type='text/css'>
</head>
<body style="padding: 10px; background: #e5e5e5;">


<script src="https://code.jquery.com/jquery-3.2.1.js" type="text/javascript"></script>
<script src="{{ asset("/semantic/") }}/js/semantic.js" type="text/javascript"></script>


<div class="ui middle aligned center aligned grid">
    <div class="column" style="max-width: 450px; margin-top: 100px;">
        <h2 class="ui teal image header">
            {{--<img src="1" class="image">--}}
            <div class="content">
                SkyApp
            </div>
        </h2>
        <form class="ui large form" role="form" method="POST" action="{{ route('update_storage') }}">
            {{ csrf_field() }}
            <input type="hidden" name="user_id" value="{{ \Illuminate\Support\Facades\Auth::id() }}">
            <div class="ui stacked segment">
                <div class="field">
                    <label>Выберите магазин</label>
                    <select class="dropdown field" name="storage">
                        @foreach($storages as $storage)
                            @if ($storage -> id == \Illuminate\Support\Facades\Auth::user()->storage_id)
                                <option value="{{ $storage->id }}" selected>{{ $storage->name }}</option>
                            @else
                                <option value="{{ $storage->id }}">{{ $storage->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <input type="submit" class="ui fluid large teal submit button" value="Продожить">
            </div>
        </form>
    </div>
</div>

</body>
<script>
    $(".dropdown").dropdown();
</script>
</html>

