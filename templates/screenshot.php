<?php
require_once __DIR__ . "/../public/header.php";

session_start();
if (empty($_SESSION['logged'])) {
    header("Refresh:0; url=/");
    exit;
}
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
        <form class="container" action="/addScreenshot" method="post" name="add" enctype="multipart/form-data"
              id="form1">
            <div class="photoDescription">
                <img id="img-preview" type="file" src="img/addFoto.png" alt="Rectangle5" class="adve">
                <div class="public">
                    <p>Доступен только по прямой ссылке</p>
                    <input class="check1" type="checkbox" name="check" value="1">
                </div>
                <div class="upload_form">
                    <label>
                        <input name="file" id="img" type="file" class="main_input_file" accept="image/*"/>
                        <div>Обзор...</div>
                        <input class="f_name" type="text" id="f_name" value="Добавить фото." disabled/>
                    </label>
                </div>
                <div class="publish">
                    <button type="submit" name="button" class="button Add" id="ref">
                        <span>Опубликовать</span>
                    </button>
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
<script src="js/add.js.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<script>
    $('#img').change(function () {
        var input = $(this)[0];
        if (input.files && input.files[0]) {
            if (input.files[0].type.match('image.*')) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#img-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                console.log('ошибка, не изображение');
            }
        } else {
            console.log('Возникли проблемы');
        }
    });

    $('#reset-img-preview').click(function () {
        $('#img').val('');
        $('#img-preview').attr('src', 'default-preview.jpg');
    });

    $('#form').bind('reset', function () {
        $('#img-preview').attr('src', 'default-preview.jpg');
    });
</script>
</body>
</html>
