<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="./styles/main.css">
        <title>Music Manager</title>
    </head>
    <body>
        <?php include('header.php'); ?>
        <div class="row">
            <div class="list-group">
                <?php include('./view/action_list.php'); ?>
            </div>
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Database Error</h1>
                    <p class="lead">Error message: <?php echo $error_message; ?></p>
                </div>
            </div>
        </div>
    </body>
    <footer>
        <?php include('footer.php') ?>
    </footer>
</html>