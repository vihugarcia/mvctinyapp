<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MVCTINYAPP</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,800">
        <link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="/css/bootstrap-theme.min.css">

        <!-- Custom styles -->
        <link rel="stylesheet" href="/css/style.css">

        <!-- JQuery -->
        <script src="/js/jquery.min.js"></script>

        <!-- Tether -->
        <script src="/js/tether.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="/js/bootstrap.min.js"></script>

        <link rel="stylesheet" type="text/css" href="/DataTables/datatables.min.css"/>

        <script type="text/javascript" src="/DataTables/datatables.min.js"></script>
    </head>
    <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">MVCTINYAPP</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="/">Home</a></li>
                    <li><a href="/about">About</a></li>
                    <li><a href="/contact">Contact</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <div class="container">
        <?= $content ?>
    </div>
    </body>
</html>