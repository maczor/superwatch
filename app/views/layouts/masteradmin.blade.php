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
        <link rel="stylesheet" href="/css/datepicker.css">
        <link rel="stylesheet" href="/js/vendor/select2-3.4.2/select2.css">
        <link rel="stylesheet" href="/css/bootstrap-select.css">
        <!-- files upload -->
        <link rel="stylesheet" href="/jQuery-File-Upload-master/css/jquery.fileupload-ui.css">
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
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">SuperWatch</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <div class="nav navbar-nav navbar-form">
                    <button id="all_watches" class="btn btn-default">Watches List <span class="glyphicon glyphicon-list"></span></button>
                    <button id="add_new_watch" class="btn btn-default">Add New Watch <span class="glyphicon glyphicon-plus"></span></button>
                    @yield('langs')
                </div>
                <div class="nav navbar-nav navbar-form">
                	@yield('navi')
                </div>
                <!-- <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form> -->
                
                <form action="/logout" method="get" class="nav navbar-nav navbar-right navbar-form">
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
                <p class="navbar-text pull-right">Signed in as <strong>{{ Auth::user()->name }}</strong></p>
                
            </div><!-- /.navbar-collapse -->
        </nav>
        <div id="main" class="container">
            @yield('content')
        </div>
        @yield('modals')
        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>-->
        <script>window.jQuery || document.write('<script src="/js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="/js/vendor/bootstrap.min.js"></script>
        <script src="/js/vendor/underscore-min.js"></script>
        <script src="/js/vendor/select2-3.4.2/select2.min.js"></script>
        <script src="/js/vendor/jquery-ui-1.10.3.custom.min.js"></script>

<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="/jQuery-File-Upload-master/js/vendor/jquery.ui.widget.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="/jQuery-File-Upload-master/js/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="/jQuery-File-Upload-master/js/canvas-to-blob.min.js"></script>
<!-- blueimp Gallery script -->
<script src="/jQuery-File-Upload-master/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="/jQuery-File-Upload-master/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="/jQuery-File-Upload-master/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="/jQuery-File-Upload-master/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="/jQuery-File-Upload-master/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="/jQuery-File-Upload-master/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="/jQuery-File-Upload-master/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="/jQuery-File-Upload-master/js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="/jQuery-File-Upload-master/js/jquery.fileupload-ui.js"></script>

        <script src="/js/bootstrap-select.min.js"></script>
        <script src="/js/bootstrap-datepicker.js"></script>
        <script src="/js/mainadmin.js"></script>

        <!--<script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src='//www.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>-->
    </body>
</html>