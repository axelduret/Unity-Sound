<?php

defined('open_access') or die('Restricted access');

function main_menu_sidebar()
{

    require __DIR__ . '/db.php';

    $req = $pdo->query('SELECT * FROM pages WHERE subgroup = \'main\' AND published = \'1\' ORDER BY ordering ASC');

    while ($page = $req->fetch(PDO::FETCH_ASSOC)) {

        $name = htmlspecialchars($page['title']);
        $title = strtoupper($name);
        $url = strtolower($name);
        $icon = htmlspecialchars($page['icon']);
        $description = htmlspecialchars($page['description']);
        $tooltip = ucwords($description);
        $current_page = 'home';

        if (isset($_GET['id'])) {
            $current_page = $_GET['id'];
        }
        if ($url == $current_page) {
            echo "<div class=\"menu-item-active shadow-sm\" title=\"$tooltip\">
            <div class=\"row m-0 px-2\">
            <div class=\"col-2 m-0 p-0 text-center\" style=\"min-width:16.666px\"><i class=\"$icon\"></i></div>
            <div class=\"col m-0 p-0 pl-2 text-left\">$title</div>
            </div>
            </div>";
        } else {
            if ($url !== 'home') {
                echo "<div class=\"menu-item shadow-sm\" title=\"$tooltip\" onClick=\"window.location='index.php?id=$url'\">
            <div class=\"row m-0 px-2\">
            <div class=\"col-2 m-0 p-0 text-center\" style=\"min-width:16.666px\"><i class=\"$icon\"></i></div>
            <div class=\"col m-0 p-0 pl-2 text-left\">$title</div>
            </div>
            </div>";
            } else {
                echo "<div class=\"menu-item shadow-sm\" title=\"$tooltip\" onclick=\"window.location='index.php'\">
            <div class=\"row m-0 px-2\">
            <div class=\"col-2 m-0 p-0 text-center\" style=\"min-width:16.666px\"><i class=\"$icon\"></i></div>
            <div class=\"col m-0 p-0 pl-2 text-left\">$title</div>
            </div>
            </div>";
            }
        }
    }
}

function media_menu_sidebar()
{

    require __DIR__ . '/db.php';

    $req = $pdo->query('SELECT * FROM pages WHERE subgroup = \'media\' AND published = \'1\' ORDER BY ordering ASC');

    while ($page = $req->fetch(PDO::FETCH_ASSOC)) {

        $name = htmlspecialchars($page['title']);
        $title = strtoupper($name);
        $url = strtolower($name);
        $icon = htmlspecialchars($page['icon']);
        $description = htmlspecialchars($page['description']);
        $tooltip = ucwords($description);
        $current_page = 'home';

        if (isset($_GET['id'])) {
            $current_page = $_GET['id'];
        }
        if ($url == $current_page) {
            echo "<div class=\"menu-item-active shadow-sm\" title=\"$tooltip\">
            <div class=\"row m-0 px-2\">
            <div class=\"col-2 m-0 p-0 text-center\" style=\"min-width:16.666px\"><i class=\"$icon\"></i></div>
            <div class=\"col m-0 p-0 pl-2 text-left\">$title</div>
            </div>
            </div>";
        } else {
            if ($url !== 'home') {
                echo "<div class=\"menu-item shadow-sm\" title=\"$tooltip\" onClick=\"window.location='index.php?id=$url'\">
            <div class=\"row m-0 px-2\">
            <div class=\"col-2 m-0 p-0 text-center\" style=\"min-width:16.666px\"><i class=\"$icon\"></i></div>
            <div class=\"col m-0 p-0 pl-2 text-left\">$title</div>
            </div>
            </div>";
            }
        }
    }
}

function glossary_menu_sidebar()
{

    require __DIR__ . '/db.php';

    $req = $pdo->query('SELECT * FROM pages WHERE subgroup = \'glossary\' AND published = \'1\' ORDER BY ordering ASC');

    while ($page = $req->fetch(PDO::FETCH_ASSOC)) {

        $name = htmlspecialchars($page['title']);
        $title = strtoupper($name);
        $url = strtolower($name);
        $icon = htmlspecialchars($page['icon']);
        $description = htmlspecialchars($page['description']);
        $tooltip = ucwords($description);
        $current_page = 'home';

        if (isset($_GET['id'])) {
            $current_page = $_GET['id'];
        }
        if ($url == $current_page) {
            echo "<div class=\"menu-item-active shadow-sm\" title=\"$tooltip\">
            <div class=\"row m-0 px-2\">
            <div class=\"col-2 m-0 p-0 text-center\" style=\"min-width:16.666px\"><i class=\"$icon\"></i></div>
            <div class=\"col m-0 p-0 pl-2 text-left\">$title</div>
            </div>
            </div>";
        } else {
            if ($url !== 'home') {
                echo "<div class=\"menu-item shadow-sm\" title=\"$tooltip\" onClick=\"window.location='index.php?id=$url'\">
            <div class=\"row m-0 px-2\">
            <div class=\"col-2 m-0 p-0 text-center\" style=\"min-width:16.666px\"><i class=\"$icon\"></i></div>
            <div class=\"col m-0 p-0 pl-2 text-left\">$title</div>
            </div>
            </div>";
            }
        }
    }
}

function member_menu_sidebar()
{

    require __DIR__ . '/db.php';

    if (!isset($_SESSION['auth'])) {
        $req = $pdo->query('SELECT * FROM pages WHERE subgroup = \'member_in\' AND published = \'1\' ORDER BY ordering ASC');
        $displayLogout = false;
    } else {
        $req = $pdo->query('SELECT * FROM pages WHERE subgroup = \'member_out\' AND published = \'1\' ORDER BY ordering ASC');
        $displayLogout = true;
    }

    while ($page = $req->fetch(PDO::FETCH_ASSOC)) {

        $name = htmlspecialchars($page['title']);
        $title = strtoupper($name);
        $url = strtolower($name);
        $icon = htmlspecialchars($page['icon']);
        $description = htmlspecialchars($page['description']);
        $tooltip = ucwords($description);
        $current_page = 'home';

        if (isset($_GET['id'])) {
            $current_page = $_GET['id'];
        }
        if ($url == $current_page) {
            echo "<div class=\"menu-item-active shadow-sm\" title=\"$tooltip\">
            <div class=\"row m-0 px-2\">
            <div class=\"col-2 m-0 p-0 text-center\" style=\"min-width:16.666px\"><i class=\"$icon\"></i></div>
            <div class=\"col m-0 p-0 pl-2 text-left\">$title</div>
            </div>
            </div>";
        } else {
            if ($url !== 'home') {
                echo "<div class=\"menu-item shadow-sm\" title=\"$tooltip\" onClick=\"window.location='index.php?id=$url'\">
            <div class=\"row m-0 px-2\">
            <div class=\"col-2 m-0 p-0 text-center\" style=\"min-width:16.666px\"><i class=\"$icon\"></i></div>
            <div class=\"col m-0 p-0 pl-2 text-left\">$title</div>
            </div>
            </div>";
            }
        }
    }

    if (isset($_SESSION['auth'])) {
        if ($_SESSION['auth']->role != '0') {
            $req = $pdo->query('SELECT * FROM pages WHERE subgroup = \'privatePage\' AND published = \'1\' ORDER BY ordering ASC');

            while ($page = $req->fetch(PDO::FETCH_ASSOC)) {

                $name = htmlspecialchars($page['title']);
                $title = strtoupper($name);
                $url = strtolower($name);
                $icon = htmlspecialchars($page['icon']);
                $description = htmlspecialchars($page['description']);
                $tooltip = ucwords($description);
                $current_page = 'home';

                if (isset($_GET['id'])) {
                    $current_page = $_GET['id'];
                }
                if ($url == $current_page) {
                    echo "<div class=\"menu-item-active shadow-sm\" title=\"$tooltip\">
            <div class=\"row m-0 px-2\">
            <div class=\"col-2 m-0 p-0 text-center\" style=\"min-width:16.666px\"><i class=\"$icon\"></i></div>
            <div class=\"col m-0 p-0 pl-2 text-left\">$title</div>
            </div>
            </div>";
                } else {
                    if ($url !== 'home') {
                        echo "<div class=\"menu-item shadow-sm\" title=\"$tooltip\" onClick=\"window.location='index.php?id=$url'\">
            <div class=\"row m-0 px-2\">
            <div class=\"col-2 m-0 p-0 text-center\" style=\"min-width:16.666px\"><i class=\"$icon\"></i></div>
            <div class=\"col m-0 p-0 pl-2 text-left\">$title</div>
            </div>
            </div>";
                    }
                }
            }
        }
    }

    if ($displayLogout == true) {
        echo "<div class=\"menu-item shadow-sm\" title=\"Close The Session\" onClick=\"window.location='index.php?id=logout'\">
        <div class=\"row m-0 px-2\">
        <div class=\"col-2 m-0 p-0 text-center\" style=\"min-width:16.666px\"><i class=\"fas fa-sign-out-alt\"></i></div>
        <div class=\"col m-0 p-0 pl-2 text-left\">" . strtoupper('logout') . "</div>
        </div>
        </div>";
    }
}

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
    require __DIR__ . '/db.php';

    $users = $pdo->query('SELECT * FROM users ORDER BY id ASC');

    return $users;
}

function videos_fetch()
{
    require __DIR__ . '/db.php';

    $videos = $pdo->query('SELECT * FROM videos WHERE published = \'1\' ORDER BY id DESC');

    return $videos;
}

function videos_list()
{
    require __DIR__ . '/db.php';

    $videos = $pdo->query('SELECT * FROM videos ORDER BY id DESC');

    return $videos;
}
