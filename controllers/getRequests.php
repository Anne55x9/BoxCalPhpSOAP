<?php
/**
 * Created by PhpStorm.
 * User: ASW
 * Date: 06/01/2018
 * Time: 14:44
 */

require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader, array('auto_reload' => true));


$wsdl = "http://boxvolumecaltrialexameasw20180106012921.azurewebsites.net/BoxCalService.svc?wsdl";
$client1 = new SoapClient($wsdl);
$result1 = $client1->GetAllRequest();

print_r($result1);


$template = $twig->loadTemplate('allRequestsView.html.twig');
$parametersToTwig = array("requests"=>$result1);
echo $template->render($parametersToTwig);

