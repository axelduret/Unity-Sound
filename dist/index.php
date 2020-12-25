<?php

define('open_access', 1);

if (session_status() == PHP_SESSION_NONE) {

    session_start();
}

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/inc/functions.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false // __DIR__ . '/tmp'
]);


$twig->addFunction(new \Twig\TwigFunction('truncate', function ($str, $width) {
    return strtok(wordwrap($str, $width, "...\n"), "\n");
}));

$twig->addFunction(new \Twig\TwigFunction('convertDate', function ($date) {
    $timestamp = strtotime($date);
    $newDate = date("d M. Y", $timestamp);
    return $newDate;
}));

$twig->addFunction(new \Twig\TwigFunction('flash_alert', function () {
    flash_alert();
}));

$twig->addFunction(new \Twig\TwigFunction('user_login', function () {
    user_login();
}));

$twig->addFunction(new \Twig\TwigFunction('register', function () {
    register();
}));

$twig->addFunction(new \Twig\TwigFunction('confirm_account', function () {
    confirm_account();
}));

$twig->addFunction(new \Twig\TwigFunction('registered_user', function () {
    registered_user();
}));

$twig->addFunction(new \Twig\TwigFunction('logout', function () {
    logout();
}));

$twig->addFunction(new \Twig\TwigFunction('video_fetch', function () {
    video_fetch();
}));

$twig->addFunction(new \Twig\TwigFunction('user_fetch', function () {
    user_fetch();
}));

$page = 'video';

if (isset($_GET['id'])) {
    $page = $_GET['id'];
}

switch ($page) {
    case 'home':
        echo $twig->render('home.twig');
        break;
    case 'video':
        echo $twig->render('video.twig', [
            'videos' => video_fetch()
        ]);
        break;
    case 'login':
        echo $twig->render('login.twig', [
            'user_login' => user_login()
        ]);
        break;
    case 'register':
        echo $twig->render('register.twig', [
            'register' => register()
        ]);
        break;
    case 'account':
        echo $twig->render('account.twig', [
            'registered_user' => registered_user(),
            'user_id' => $_SESSION['auth']->id,
            'user_name' => $_SESSION['auth']->username,
            'user_email' => $_SESSION['auth']->email,
            'user_date' => $_SESSION['auth']->confirmed_at,
            'user_role' => $_SESSION['auth']->role,
            'users' => user_fetch()
        ]);
        break;
    case 'confirm':
        confirm_account();
        break;
    case 'logout':
        logout();
        break;
    case 'default':
        header('HTTP/1.0 404 Not Found');
        echo $twig->render('404.twig');
        break;
}
