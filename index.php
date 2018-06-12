<?php
require_once 'functions.php';

$errors = [];
if (!empty($_POST['username'])) {

    if (login($_POST['username'], $_POST['password'])) {
        redirect('list');
    } else {
        $errors[] = 'Неверные логин или пароль';
    }
}


?>

<form action="" method="POST">
    <h1>Вход на сайт</h1>
    <ul style="padding: 0;">
        <?php
        if (count($errors) > 0) {
            foreach ($errors as $error):
                echo '<li>' . $error . '</li>';
            endforeach;
        }
        ?>
    </ul>
    <div style="margin: 10px 0">
        <input placeholder="Имя" required="" id="username" name="username" type="text">
    </div>
    <div style="margin: 10px 0">
        <input placeholder="Пароль" id="password" name="password" type="password">
    </div>
    <div>
        <input value="Войти" type="submit">
    </div>
</form><!-- form -->