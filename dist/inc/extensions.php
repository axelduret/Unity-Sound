<?php

defined('open_access') or die('Restricted access');

class custom_extensions extends \Twig\Extension\AbstractExtension
{
    public function getFunctions()
    {
        return [
            new \Twig\TwigFunction('truncate', [$this, 'truncate']),
            new \Twig\TwigFunction('convertDate', [$this, 'convertDate']),
            new \Twig\TwigFunction('minimalDate', [$this, 'minimalDate']),
            new \Twig\TwigFunction('flash_alert', [$this, 'flash_alert']),
            new \Twig\TwigFunction('user_login', [$this, 'user_login']),
            new \Twig\TwigFunction('registered_user', [$this, 'registered_user']),
            new \Twig\TwigFunction('register', [$this, 'register']),
        ];
    }

    public function truncate($str, $width)
    {
        return strtok(wordwrap($str, $width, "...\n"), "\n");
    }

    public function convertDate($date)
    {
        $timestamp = strtotime($date);
        $newDate = date("d M. Y", $timestamp);
        return $newDate;
    }

    public function minimalDate($date)
    {
        $timestamp = strtotime($date);
        $newDate = date("d-m-y", $timestamp);
        return $newDate;
    }

    public function flash_alert()
    {
        if (isset($_SESSION['flash'])) :

            foreach ($_SESSION['flash'] as $type => $message) :

                echo '<div class="content-' . $type . 'Div">' . $message . '</div>';

            endforeach;

            unset($_SESSION['flash']);

        endif;
    }

    public function user_login()
    {
        if (!empty($_POST)) {
            if (!empty($_POST['username']) && !empty($_POST['password'])) {

                require __DIR__ . '/db.php';

                $req = $pdo->prepare('SELECT * FROM users WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL');

                $req->execute(['username' => $_POST['username']]);

                $user = $req->fetch();

                if ($user == null) {

                    $_SESSION['flash']['error'] = "Wrong username or password";
                } elseif (password_verify($_POST['password'], $user->password)) {

                    $_SESSION['auth'] = $user;

                    $_SESSION['flash']['success'] = "Successfully logged in";

                    header('Location: ?id=account');

                    exit();
                } else {

                    $_SESSION['flash']['error'] = "Wrong username or password";
                }
            } else {

                $_SESSION['flash']['error'] = "Username and password are required";
            }
        }
    }

    public function registered_user()
    {

        if (!isset($_SESSION['auth'])) {

            $_SESSION['flash']['error'] = "Access denied";

            header('Location: ?id=login');

            exit();
        }
    }

    public function register()
    {

        if (!empty($_POST)) {

            $errors = array();

            require __DIR__ . '/db.php';

            if (empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {

                $errors['username'] = "Invalid username";
            } else {

                $req = $pdo->prepare('SELECT id FROM users WHERE username = ?');

                $req->execute([$_POST['username']]);

                $user = $req->fetch();

                if ($user) {

                    $errors['username'] = 'This username already exists';
                }
            }

            if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

                $errors['email'] = "Invalid email";
            } else {

                $req = $pdo->prepare('SELECT id FROM users WHERE email = ?');

                $req->execute([$_POST['email']]);

                $user = $req->fetch();

                if ($user) {

                    $errors['email'] = 'This email already exists';
                }
            }

            if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {

                $errors['password'] = "Invalid password";
            }

            if (empty($errors)) {

                $req = $pdo->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, confirmation_token = ?");

                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

                $token = str_random(60);

                $req->execute([$_POST['username'], $password, $_POST['email'], $token]);

                $user_id = $pdo->lastInsertId();

                mail($_POST['email'], 'Unity Sound - Confirm your email adress', "Please, click the link below to validate your account on Unity Sound website\n\nhttp://unitysound.ch/index.php?id=confirm&user=$user_id&token=$token");

                $_SESSION['flash']['success'] = "Thank you for registering Unity Sound Website<br/>Confirmation has been sent to you by email";

                header('Location: index.php');

                exit();
            }
        }

        if (!empty($errors)) {

            echo '<div class="content-errorDiv">
    
                <p>Error trying register new account :</p><ul>';

            foreach ($errors as $error) {

                echo '<li>' . $error . '</li>';
            }

            echo '</ul></div>';
        }
    }
}
