<!DOCTYPE html>
<html lang="en" ng-app="eApp">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QCV | e-Learning </title>
         <!-- No Cache BEGIN -->
    <meta content="no-cache" />
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="no-cache">
    <meta http-equiv="Expires" content="-1">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate, max-age=0">

    <link rel="icon" href="{{URL::to('assets/images/grevhai-logo.ico')}}">    

    <!-- editor -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/0.9.2/trix.css">

    <!-- custom -->
    <!-- <link data-require="bootstrap@3.3.6" data-semver="3.3.6" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" /> -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{URL::to('css/angular-ui-notification.css')}}">
    <link rel="stylesheet" href="{{URL::to('assets/css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::to('assets/plugin/codemirror/lib/codemirror.css')}}">

    <style>
        .fade.in {
            opacity: 1;
        }

        .modal.in .modal-dialog {
        -webkit-transform: translate(0, 0);
            -o-transform: translate(0, 0);
                transform: translate(0, 0);
        }

        .modal-backdrop.in {
            filter: alpha(opacity=50);
            opacity: .5;
        }
        
        #mainDivLogin{
            margin-top: 10px;
            width: 450px;
        }

        #mainDivSignup{
            width: 600px;
        }

        #mainDiv{
            margin-top: 125px;
            margin-bottom: 100px;
        }
        
        #iconHeaderMargin{
            margin-top: 5px;
            margin-bottom: 5px;
            margin-left: 5px;
            margin-right: 10px;
        }

        html {
            position: relative;
            min-height: 100%;
        }
        body {
            /* Margin bottom by footer height */
            margin-bottom: 60px;
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            /* Set the fixed height of the footer here */
            height: 60px;
            line-height: 60px; /* Vertically center the text there */
            background-color: #f5f5f5;
        }
        
        .card-body{
            padding: 10px;
        }
    </style>
    <base href="/">
     <!-- No Cache END-->
  </head>
<body class="nav-md">
    @include('layout.top-nav')
    <div class="container body">
        <div class="main_container">
            <div class="right_col" role="main">
                <div ui-view></div>
            </div>
        </div>
    </div>
    @yield('layout.templates')    

    <script type="text/javascript" src="{{URL::to('assets/node_modules/jquery/dist/jquery.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script text="type/javascript" src="{{URL::to('assets/plugin/codemirror/lib/codemirror.js')}}" ></script>
    <script text="type/javascript" src="{{URL::to('assets/plugin/codemirror/mode/vb/vb.js')}}" ></script>

    <script type="text/javascript" src="{{URL::to('assets/node_modules/angular/angular.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/node_modules/angular-ui-router/release/angular-ui-router.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/node_modules/angular-sanitize/angular-sanitize.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/node_modules/angular-ui-bootstrap/dist/ui-bootstrap-tpls.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/node_modules/angular-ui-notification/dist/angular-ui-notification.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('assets/node_modules/angular-trix/dist/angular-trix.min.js')}}"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/angular-moment/0.9.0/angular-moment.min.js"></script>
    
    <script type="text/javascript" src="{{URL::to('js/eapp.js')}}"></script>
    @yield('scripts')
</body>
</html>