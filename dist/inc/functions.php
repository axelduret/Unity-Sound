<?php

function str_random($length)
{

    $alphabet = "0123456789qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM";

    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
}

function confirm_account()
{

    $user_id = $_GET['user'];

    $token = $_GET['token'];

    require_once __DIR__ . '/db.php';

    $req = $pdo->prepare('SELECT * FROM users WHERE id = ?');

    $req->execute([$user_id]);

    $user = $req->fetch();

    if ($user && $user->confirmation_token == $token) {

        $pdo->prepare('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?')->execute([$user_id]);

        $_SESSION['flash']['success'] = "Successful validation";

        $_SESSION['auth'] = $user;

        header('Location: ?id=account');
    } else {

        $_SESSION['flash']['error'] = "Invalid token";

        header('Location: ?id=login');
    }
}

function logout()
{
    unset($_SESSION['auth']);

    $_SESSION['flash']['success'] = "Successfully logged out";

    header('Location: index.php');
}

function users_fetch()
{
    require_once __DIR__ . '/db.php';

    $users = $pdo->query('SELECT * FROM users ORDER BY id ASC');

    return $users;
}

function videos_fetch()
{
    require_once __DIR__ . '/db.php';

    $videos = $pdo->query('SELECT * FROM videos WHERE published = \'1\' ORDER BY id DESC');

    return $videos;
}
