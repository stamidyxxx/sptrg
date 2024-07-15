<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trgovina Branda</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www2.scptuj.si/~branda.luka/sptrg3a1-24/view/css/style_error.css">
    <link rel="icon" type="image/png" href="https://www2.scptuj.si/~branda.luka/sptrg3a1-24/view/slike/titleimg.png"/>
    </head>

    <body>
        <div class="error-container">
            <h1>
                <?php
                    if (isset($_GET['error']))
                        echo 'Error: ';
                    else
                        echo 'Unknown error!'
                ?>
            </h1>
            <p>
                <?php
                    if (isset($_GET['error']))
                        echo $_GET['error'];
                ?>
            </p>
            <p>Go back to the <a href="https://www2.scptuj.si/~branda.luka/sptrg3a1-24/index.php">homepage</a>.</p>
        </div>
    </body>

</html>