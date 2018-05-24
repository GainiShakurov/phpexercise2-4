<?php
require_once 'functions.php';

if (empty($_SESSION['user'])) {
    http_response_code(403);
    echo 'Доступ запрещен!';
    die;
}

echo '<a href="logout.php">Выйти</a>';
echo "<h3>Список всех доступных тестов</h3>";

$searchdir = __DIR__ . '/tests/';
$files = array_diff(scandir($searchdir), array('..', '.'));

echo '<ul>';
foreach ($files as $file) {
    echo '<li><a href="http://' . $_SERVER['HTTP_HOST']. '/test.php?name='.basename($file, '.json').'">' . $file . '</a></li>';
}
echo '</ul>';

if (!$_SESSION['guest']) {
    echo '<a href="admin.php">Добавить тесты</a>';
}

?>
