<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Список тестов</title>
</head>
<body>
<?php
require_once 'functions.php';
testAccess($_SESSION['user']);

echo '<br /><a href="logout.php">Разлогиниться</a>';
echo "<h3>Список всех доступных тестов</h3>";

$searchdir = __DIR__ . '/tests/';
$files = array_diff(scandir($searchdir), array('..', '.'));

echo '<ul>';
foreach ($files as $file) {
    echo '<li><a href="/test.php?name='.basename($file, '.json').'">' . $file . '</a></li>';
}
echo '</ul>';

if (!$_SESSION['guest']) {
    echo '<a href="admin.php">Добавить тесты</a>';
}

?>
</body>
</html>
