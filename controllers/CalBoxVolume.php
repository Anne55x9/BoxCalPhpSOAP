<?php
/**
 * Created by PhpStorm.
 * User: ASW
 * Date: 06/01/2018
 * Time: 13:47
 */

require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader, array('auto_reload' => true));
$template = $twig->loadTemplate('volResultView.html.twig');

if(isset($_POST['length'])){
    try{
        $wsdl = "http://boxvolumecaltrialexameasw20180106012921.azurewebsites.net/BoxCalService.svc?wsdl";
        $client = new SoapClient($wsdl);
        $numbers = array('length' => $_POST['length'], 'height' => $_POST['height'], 'width' => $_POST['width']);
        $result = $client->GetVolume($numbers);
    } catch(SoapFault $exception){
        print_r($exception->getMessage());
    }

    $default = array('resultat' => 'Volumen: ' . $result-> GetVolumeResult .'Cm3', 'length' => 'Længde: '.$numbers['length'], 'height' => ' Højde: '.$numbers['height'], 'width' => ' Bredde: '.$numbers['width']);
} else { $default = array('resultat' => "");
}

echo $template->render($default);



?>


