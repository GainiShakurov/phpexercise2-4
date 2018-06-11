<?php
session_start();

function loginGuest($login)
{
    $_SESSION['user'] = $login;
    $_SESSION['guest'] = true;
    return true;
}

function login($login, $password = null)
{

    if (empty($password)) {
        loginGuest($login);
        return true;
    } else {
        {
            $user = getUser($login);

            if ($user && $user['password'] === $password) {
                $_SESSION['user'] = $user;
                $_SESSION['guest'] = false;
                return true;
            }
        }

        return false;
    }
}

function getUsers()
{
    $userData = file_get_contents(__DIR__ . '/users/login.json');
    if (!$userData) {
        return [];
    }
    $users = json_decode($userData, true);
    if (!$users) {
        return [];
    }
    return $users;
}

function getUser($login)
{
    $users = getUsers();
    foreach ($users as $user) {
        if ($login === $user['user']) {
            return $user;
        }
    }
    return null;
}

function redirect($page) {
    header("Location: $page.php");
    die;

}

function testAccess($user) {
    if (empty($user)) {
        http_response_code(403);
        echo 'Доступ запрещен!';
        die;
    }
}