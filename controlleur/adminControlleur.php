<?php
require_once 'vendor/autoload.php';
// require_once 'core/db.php';
// require_once 'model/getUser.php';
echo "default login";
print_r($_POST);

$loader = new \Twig\Loader\FilesystemLoader('views');
$twig = new \Twig\Environment($loader);
// $template = $twig->load('admin-test.html.twig');
echo $twig->render('admin-test.html.twig', ['var1' => 'variables', 'var2' => 'here']);
