<?php

define('open_access', 1);

if (session_status() == PHP_SESSION_NONE) {

    session_start();
}

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/inc/functions.php';
require __DIR__ . '/inc/extensions.php';

use Twig\Environment;
use Twig\Extra\String\StringExtension;

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader, [
    'cache' => false // __DIR__ . '/tmp'
]);

$page = 'home';

if (isset($_GET['id'])) {
    $page = $_GET['id'];
}

if (!is_file(__DIR__ . '/templates/' . $page . '.twig')) {
    if ($_GET['id'] == 'confirm') {
        $page = 'confirm';
    } elseif ($_GET['id'] == 'logout') {
        $page = 'logout';
    } else {
        $page = 'default';
    }
}

if (isset($_SESSION['auth'])) {
    $user_id = $_SESSION['auth']->id;
    $user_name = $_SESSION['auth']->username;
    $user_email = $_SESSION['auth']->email;
    $user_token = $_SESSION['auth']->confirmation_token;
    $user_date = $_SESSION['auth']->confirmed_at;
    $user_role = $_SESSION['auth']->role;
} else {
    $user_id = "";
    $user_name = "Anonymous";
    $user_email = "";
    $user_token = "";
    $user_date = "";
    $user_role = "";
}

$twig->addGlobal('current_page', $page);
$twig->addGlobal('site_name', 'Unity Sound');

$twig->addExtension(new StringExtension());

$twig->addExtension(new custom_extensions());

$twig->addFunction(new \Twig\TwigFunction('main_menu_sidebar', function () {
    main_menu_sidebar();
}, ['is_safe' => ['html', 'javascript']]));

$twig->addFunction(new \Twig\TwigFunction('media_menu_sidebar', function () {
    media_menu_sidebar();
}, ['is_safe' => ['html', 'javascript']]));

$twig->addFunction(new \Twig\TwigFunction('glossary_menu_sidebar', function () {
    glossary_menu_sidebar();
}, ['is_safe' => ['html', 'javascript']]));

$twig->addFunction(new \Twig\TwigFunction('member_menu_sidebar', function () {
    member_menu_sidebar();
}, ['is_safe' => ['html', 'javascript']]));

$twig->addFunction(new \Twig\TwigFunction('confirm_account', function () {
    confirm_account();
}));

$twig->addFunction(new \Twig\TwigFunction('logout', function () {
    logout();
}));

$twig->addFunction(new \Twig\TwigFunction('videos_fetch', function () {
    videos_fetch();
}));

$twig->addFunction(new \Twig\TwigFunction('videos_list', function () {
    videos_list();
}));

$twig->addFunction(new \Twig\TwigFunction('users_fetch', function () {
    users_fetch();
}));

switch ($page) {
    case 'home':
        echo $twig->render('home.twig');
        break;
    case 'info':
        echo $twig->render('info.twig');
        break;
    case 'audio':
        echo $twig->render('audio.twig');
        break;
    case 'video':
        echo $twig->render('video.twig', [
            'videos' => videos_fetch()
        ]);
        break;
    case 'reggae':
        echo $twig->render('reggae.twig');
        break;
    case 'sound':
        echo $twig->render('sound.twig');
        break;
    case 'clash':
        echo $twig->render('clash.twig');
        break;
    case 'dubplate':
        echo $twig->render('dubplate.twig');
        break;
    case 'speaker':
        echo $twig->render('speaker.twig');
        break;
    case 'login':
        echo $twig->render('login.twig');
        break;
    case 'register':
        echo $twig->render('register.twig');
        break;
    case 'account':
        echo $twig->render('account.twig', [
            'user_id' => $user_id,
            'user_name' => $user_name,
            'user_email' => $user_email,
            'user_token' => $user_token,
            'user_date' => $user_date,
            'user_role' => $user_role
        ]);
        break;
    case 'admin':
        echo $twig->render('admin.twig', [
            'user_id' => $user_id,
            'user_name' => $user_name,
            'user_email' => $user_email,
            'user_token' => $user_token,
            'user_date' => $user_date,
            'user_role' => $user_role,
            'users' => users_fetch(),
            'videos' => videos_list()
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
