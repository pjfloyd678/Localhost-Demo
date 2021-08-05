<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{#title#|capitalize}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <!-- Lets load some css! -->
        <link type="text/css" rel="stylesheet" href="/media/jquery-ui-1.12.1.custom/jquery-ui.min.css">
        <link type="text/css" rel="stylesheet" href="/media/jquery-ui-1.12.1.custom/jquery-ui.theme.min.css">
        <link type="text/css" rel="stylesheet" href="/media/css/localhost.css">
        <link type="text/css" rel="stylesheet" href="/media/css/responsive.css">
        <style>
            label, input { display:block; }
            input.text { margin-bottom:12px; width:95%; padding: .4em; }
            fieldset { padding:0; border:0; margin-top:25px; }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="/">LocalHost Development Page</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/jquery_recaptcha/index.php">Recaptcha</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/info.php" id="view-info" data-view="default" target="_blank">Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/random.php" id="view-random" data-view="default" target="_blank">Random</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/xml" id="view-xml" data-view="default">XML</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="view" data-view="default">View</a>
                    </li>
                    <li class="nav-item">
                        <span class="showdate">{if $loggedin }<a href="/auth/logout.php">Logout</a>{else}<a href="/auth/login.php">Login</a>{/if}</span>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>

        <main role="main" class="container">
