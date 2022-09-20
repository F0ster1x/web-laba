<?php
/* @var array $params */

require_once __DIR__ . "/../public/header.php";
session_start();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Скриншонты</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;1,500&display=swap"
          rel="stylesheet">
</head>
<body>
<header>
    <div class="menu">
        <?php header_site(); ?>
</header>
<section class="header">
    <div class="container">
        <form class="container" action="addScreenshot.php" method="post" name="add" enctype="multipart/form-data"
              id="form1">
            <div class="photoDescription">
                <img id="img-preview" type="file" src="/<?php echo $params['data']['link']; ?>" alt="Rectangle5"
                     class="adve">
                <div class="public">
                    <p>Дата добавления <?php echo $params['data']['dataScreen'] ?></p>
                </div>
            </div>
        </form>
    </div>
</section>

<section>
    <div class="container">
    </div>
</section>

<footer id="footer">
    <div class="container">

    </div>
</footer>
</body>
</html>
