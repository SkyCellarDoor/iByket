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
        <form class="ui large form" role="form" method="POST" action="{{ route('') }}">
            {{ csrf_field() }}

            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input id="name" type="text" placeholder="Логин" name="name" value="{{ old('name') }}" required
                               autofocus>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="mail icon"></i>
                        <input id="email" type="email" placeholder="email" class="form-control" name="email"
                               value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input id="password" type="password" placeholder="пароль" class="form-control" name="password"
                               required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input id="password-confirm" type="password" placeholder="подтверждение пароля"
                               class="form-control" name="password_confirmation" required>
                    </div>
                </div>
                <input type="submit" class="ui fluid large teal submit button" value="Зарегистрироваться">
            </div>
        </form>
    </div>
</div>

</body>
</html>

