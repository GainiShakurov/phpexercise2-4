<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Список тестов</title>
</head>
<body>

<?php
require_once "functions.php";
testAccess();

echo '<br /><a href="logout.php">Разлогиниться</a>';

if (isset($_GET['name']) && !empty($_GET['name']) && !empty($_SESSION['user'])) {
    $path = 'tests/' . $_GET['name'] . '.json';
    $currentFile = scandir('tests/');

    if (!in_array($_GET['name'] . '.json', $currentFile)) {
        http_response_code(404);
        echo 'Cтраница не найдена!';
        exit(1);
    }

    $data = file_get_contents($path) or exit('Не удалось получить данные');
    $currentTest = json_decode($data, true) or exit('Ошибка декодирования json');

    echo '<form action="" method="POST">';
    echo '<input type="hidden" name="sended" value="1"/>';
    foreach ($currentTest as $questionKey => $data) {
        echo '<fieldset>';
        echo '<legend>' . $data['body'] . '</legend>';
        foreach ($data['answers'] as $answerKey => $answer) {
            echo '<label><input type="radio" name="' . $questionKey . '" value="' . $answerKey . '">' . $answer['body'] . '</label>';
        }
        echo '</fieldset>';
    }
    echo '<input type="submit" value="Отправить"></form>';

    if (isset($_POST['sended']) && !empty($_POST['sended'])) {

        $arr = [];
        $arr = $_POST;
        $correctAnswersNumber = 0;
        $correctAnswersQues = [];

        foreach ($arr as $key => $value) {

            if (!empty($currentTest[$key]['answers'][$value]['correct'])) {
                $correctAnswersNumber++;
                array_push($correctAnswersQues, $currentTest[$key]['body']);
            }

        }

        $_SESSION['correct'] = $correctAnswersNumber;
        $_SESSION['testname'] = $_GET['name'];
        $_SESSION['username'] = ($_SESSION ['guest'])? $_SESSION['user'] : $_SESSION['user']['user'];

        echo '<h4>Кол-во правильных ответов - ' . $correctAnswersNumber . '</h4>';
        echo '<h4>Правильно ответили на вопросы - ' . implode(', ', $correctAnswersQues) . '</h4>';
        echo '<img src="sertificat.php" />';
    }

}
?>
