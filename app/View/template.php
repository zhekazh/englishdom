<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EnglishDom task</title>
    <link href="/css/main-page.css" media="screen" rel="stylesheet" type="text/css">
</head>
<body>
<div class="main-wrapper">
    <header class="header">
        <div class="top-line">
            <div class="container">
                <p class="leader-online">Лидер онлайн обучения</p>
                <div class="personal-area js-add-is-unregistered">
                    <img src="/img/s2_1.jpg" alt="avatar" class="js-avatar avatar-area">
                    <a href="/" class="link-area icon-after phn-main-user-name">
                        <span class="text-link phn__header__link-lk">Жуковский Евгений</span>
                    </a>
                </div>
            </div>
        </div>
        <nav class="navigation">
            <div class="container">
                <div class="wrapper-navigation">
                    <div class="wrapper-logo">
                        <a href="/" class="logo" title="На главную"></a>
                    </div>
                    <div class="wrapper-main-menu">
                        <div class="main-menu">
                            <a href="/" class="item-menu icon-before">Comment List</a>
                            <a href="/log" class="item-menu icon-before">Log</a>
                            <a href="/install" class="item-menu icon-before">Install</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <?php
    /** @var string $content */
    echo $content;
    ?>
</div>
<div class="footer">
    <div class="footer-menu-info">
        <div class="container"></div>
    </div>
    <div class="footer-bottom">
        <div class="container"></div>
    </div>
</div>
</body>
</html>