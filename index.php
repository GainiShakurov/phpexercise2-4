<?php
require_once 'functions.php';

$errors = [];
if (!empty($_POST['username'])) {

    if(login($_POST['username'], $_POST['password'])) {
        redirect('list');
    } else {
        $errors[] = 'Неверные логин или пароль';
    }
}

?>

<form action="" method="POST">
    <h1>Вход на сайт</h1>
    <ul>
        <? foreach ($errors as $error): ?>
            <ul><?= $error ?></ul>
        <? endforeach; ?>
    </ul>
    <div>
        <input placeholder="Имя" required="" id="username" name="username" type="text">
    </div>
    <div>
        <input placeholder="Пароль" id="password" name="password" type="password">
    </div>
    <div>
        <input value="Войти" type="submit">
    </div>
</form><!-- form -->