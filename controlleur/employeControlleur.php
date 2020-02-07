<?php
$action = 'default';
require_once 'vendor/autoload.php';
require_once 'core/db.php';
require_once 'model/getUser.php';
require_once 'model/checkHasVoted.php';
$userHasVoted = checkHasVoted($_SESSION["id_employe"]);
if ($userHasVoted == "") {
    $action = 'default';
    if (strpos($uri, '/', 1) !== false) {


        $action = (strpos($uri, '/', strlen($controlleur) + 1) === false) ? substr($uri, strpos($uri, '/', strlen($controlleur)) + 1) : substr($uri, strlen($controlleur) + 1, (strpos($uri, '/', strlen($controlleur) + 1) - 1) - (strlen($controlleur) - 1) - 1);
    }
} else {
    $action = 'has voted';
}

// require_once 'model/insertHumeur.php';

// echo "default login";
// print_r($_POST);

// $loader = new \Twig\Loader\FilesystemLoader('views');
// $twig = new \Twig\Environment($loader);
// // $template = $twig->load('admin-test.html.twig');
// echo $twig->render('employe-test.html.twig', ['bonjour' => 'sa marche employe', 'var2' => 'here']);
// echo 'ENTER PAPGE Employe';

switch ($action) {
    case 'default':
        // require_once 'views/employe.html';
        $loader = new \Twig\Loader\FilesystemLoader('views');
        $twig = new \Twig\Environment($loader);
        // $template = $twig->load('admin-test.html.twig');
        echo $twig->render('employe.html', ['emoticons' => "emoticons"]);
        break;

    case 'humeur':
        $today = getdate();
        // print_r($today);
        $uri = $_SERVER['REQUEST_URI'];
        $expUri = explode("/", $uri);
        // print_r($_SESSION);
        $selectedHumeur = $expUri[3];
        $selectedService = $_SESSION['id_service'];
        $idEmploye = $_SESSION['id_employe'];
        require_once 'model/insertHumeur.php';
        require_once 'model/insertHasVoted.php';
        // require_once 'views/hasVoted.html';
        $loader = new \Twig\Loader\FilesystemLoader('views');
        $twig = new \Twig\Environment($loader);
        // $template = $twig->load('admin-test.html.twig');
        echo $twig->render('message.html', ['hasVoted' => "Merci d'avoir voté!"]);
        // require_once 'controlleur/logoutControlleur.php';
        // echo 'employe humeur';
        break;

    case 'has voted':
        // require_once 'views/hasVoted.html';
        $loader = new \Twig\Loader\FilesystemLoader('views');
        $twig = new \Twig\Environment($loader);
        // $template = $twig->load('admin-test.html.twig');
        echo $twig->render('message.html', ['hasVoted' => "Merci d'avoir voté!"]);
        break;

    default:
        // require_once 'views/404.html.php';
        $loader = new \Twig\Loader\FilesystemLoader('views');
        $twig = new \Twig\Environment($loader);
        // $template = $twig->load('admin-test.html.twig');
        echo $twig->render('404.html.php', ['hasVoted' => "Merci d'avoir voté!"]);
        break;
}

exit;
