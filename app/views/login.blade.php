<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Superwatch Admin</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="/css/normalize.min.css">
        <link rel="stylesheet" href="/css/bootstrap.css">
        <!-- custom -->
        <link rel="stylesheet" href="/css/mainadmin.css">

        <script src="/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                        <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="#">SuperWatch</a>
            </div>
        </nav>
        <div id="main" class="container">
			<form class="form-horizontal" role="form" method="post">
			    <div class="form-group">
			        <div class="col-xs-offset-4 col-xs-4">
			            @if (Session::has('flash_error'))
			            {{ Session::get('flash_error') }}
			            @endif
			        </div>
			    </div>
			    <div class="form-group">
			        <label for="inputEmail" class="control-label col-xs-4">email</label>
			        <div class="controls col-xs-4">
			            <input type="text" class="form-control" name="inputEmail" placeholder="Email">
			        </div>
			    </div>
			    <div class="form-group">
			        <label for="inputPassword" class="control-label col-xs-4">Password</label>
			        <div class="controls col-xs-4">
			            <input type="password" class="form-control" name="inputPassword" placeholder="Password">
			        </div>
			    </div>
			    <div class="form-group">
			        <div class="col-sm-offset-4 col-xs-4">
			            <div class="checkbox">
			                <label>
			                    <input type="checkbox" name="inputRemember"> Remember me
			                </label>
			            </div>
			        </div>
			    </div>
			    <div class="form-group">
			        <div class="col-sm-offset-4 col-xs-4">
			            <button type="submit" class="btn btn-primary">Sign in</button>
			        </div>
			    </div>
			</form>
        </div>
        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>-->
        <script>window.jQuery || document.write('<script src="/js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="/js/vendor/bootstrap.min.js"></script>
        <script src="/js/mainadmin.js"></script>

        <!--<script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src='//www.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>-->
    </body>
</html>