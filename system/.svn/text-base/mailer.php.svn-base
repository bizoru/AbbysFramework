<?php

require_once dirname(__FILE__) . '/mail/class.phpmailer.php';
require_once dirname(__FILE__) . '/mail/settings.php';


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Mailer {

    private $smtp;
    private $adminlist;

    function __construct() {

        $this->smtp = SMTP_SERVER;
        $this->adminlist = array(ADM1,ADM2,ADM3,ADM4);
    }

    function loadTemplate($template) {

        $template_file = dirname(__FILE__) . TEMPLATE_DIR . $template;
        $message = file_get_contents($template_file);

        return $message;
    }

    function prepareTemplate($template, $data) {

        foreach ($data as $key => $value) {


            $template = str_replace($key, $value, $template);
        }

        return $template;
    }

    function prepareDetails($reservas){
        
        $result = "<p>Se ha realizado la reserva de las siguientes unidades</p>";
        $package = "";
        
        foreach ($reservas as $reserva) {
        
            $line = "<p>Nombre Unidad:".$reserva['nombre']."</p>";
            $line = $line."<p>Descripcion: ".$reserva['descripcion']."</p>";
            $line = $line."<p>Tama&ntilde;o: ".$reserva['tamano']."</p>";
            $line = $line."<br>";
            $package = $package."".$line;
            
        }
        $result = $result." ".$package;
        return $result;
        
    }
    
    function includeList($items) {

        $liststart = "<li>";
        $listend = "</li>";
        $list = "<ul>";
        $liste = "</ul>";
        $result = $list;

        foreach ($items as $item) {

            $result = $result . " " . $liststart . " " . $item . " " . $listend;
        }

        return $result;
    }

    function email() {

        $mail = new PHPMailer(true);
        $mail->SetFrom(SENT_FROM,SENT_FROM_NAME);
        return $mail;
    }

    function getAdminList() {

        return $this->adminlist;
    }

}

?>
