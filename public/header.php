<?php function header_site()
{ ?>
    <style>
        a {
            text-decoration: none; /* Отменяем подчеркивание у ссылки */
        }
    </style>
    <a href="/"><h1>Screen share</h1></a>
    <div class="ww" style="display:flex">

    <?php if (empty($_SESSION['logged'])) { ?>
    <button class="Sign Entrance" id="Button_Reg" style="display:block">
        <span>Зарегистрироваться</span>
    </button>
    <button class="button Entrance" id="Button_Enter">
        <span>Войти</span>
    </button>
    </div>

    </div>
<?php } else { ?>

    <form method='POST' style="display:flex;align-items: center;" action="/exit">
        <p style="margin-right: 33px;">Здравствуй, <?= $_SESSION['name'] ?></p>
        <button type="submit" style="font-size: 18px;margin-bottom: 0px;" name = 'but_exit' value = 'exit'>
        <span>Выход</span>
        </button>

    </form>
    </div>

<?php }
} ?>