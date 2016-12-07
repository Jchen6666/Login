<?php
require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../View');
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));

$template = $twig->loadTemplate('MainPage.html.twig');

$user = $_POST['Username'];
$p = $_POST['Password'];
$URI='http://resthomeoptimizer.cloudapp.net/Service1.svc/AccessAccount/?email='.$user.'&password='.$p;

$json=file_get_contents($URI);
if ($json=="true"){
    $id=$_POST['Id'];
    $URI2='http://resthomeoptimizer.cloudapp.net/Service1.svc/GetLastSensorValues/?accountId='.$id;
    $json2=file_get_contents($URI2);
    $value=json_decode($json2);

    $twigContent=array("value"=>$value);
    echo $template->render($twigContent);
}
else {

    echo 'fail';
}
