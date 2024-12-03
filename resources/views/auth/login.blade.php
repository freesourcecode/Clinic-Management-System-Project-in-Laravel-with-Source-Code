<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Login</title>
<link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('css/datepicker3.css')}}" rel="stylesheet">
<link href="{{asset('css/styles.css')}}" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
</head>
<body style="background-color: black;">
    
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">Admin Login Session</div>
                <div class="panel-body">
                @if ($success = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $success }}</strong>
                    </div>
                    @endif
                @if(count($errors))
                    <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    @foreach($errors->all() as $error)
                         <strong>{{ $error }}</strong>
                    @endforeach
                    </div>
                    @endif

                
                    <form role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <fieldset>
                             <div class="form-group">
                                <input class="form-control" placeholder="Username" name="name" type="text" autofocus="" required="">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="" required="">
                            </div>
                             @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong></strong>
                                    </span>
                                @endif
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</a>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->    y
    </script>   
</body>

</html>
