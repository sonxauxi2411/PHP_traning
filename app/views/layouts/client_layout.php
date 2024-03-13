<html>

<head>
    <title>Website</title>
    <meta charset="utf-8">
    <link type='text/css' rel='stylesheet' href='<?php echo _WEB_PATH_  ?>/public/assets/clients/css/style.css' />
</head>

<body>
    <?php
    $this->render('blocks/header');

    $this->render($content, $sub_content);

    $this->render('blocks/footer')
   ?>

</html>