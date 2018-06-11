<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Добавление тестов</title>
</head>
<body>
<?php

require_once "functions.php";
testAccess($_SESSION['user']);

echo '<br /><a href="logout.php">Разлогиниться</a>';

$uploaddir = __DIR__ . '/tests/';
/* Добавил время к имени, чтобы можно было загружать файлы с одним и тем же именем */
if (!empty($_FILES['testfile']['name']))
    $uploadfile = $uploaddir . basename($_FILES['testfile']['name'], ".json") . '-' . strtotime("now") . '.json';

if (!empty($_FILES['testfile']['name']) && (move_uploaded_file($_FILES['testfile']['tmp_name'], $uploadfile))) {
    redirect('list');
}

?>

<form enctype="multipart/form-data" action="admin.php" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="30000"/>
    Отправить файл:
    <p><input name="testfile" type="file"/></p>
    <p><input type="submit" value="Загрузить"/></p>
</form>
</body>
</html>



