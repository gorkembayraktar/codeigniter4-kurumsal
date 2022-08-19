<?php

namespace App\Libraries;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


class SendMail{

    private $config;

    public $error;

    public $fromMail,$fromName;
    public $adress = [];

    public function __construct($data){
        $this->config['protocol'] = 'smtp';
        $this->config['port'] = 465;
        foreach($data as $key => $val){
            $this->config[$key] = $val;
        }
    }

    public function setFrom($mail,$fromName){
        $this->fromMail = $mail;
        $this->fromName = $fromName;
    }
    public function addAddress($mail,$name){
        $this->adress[] = [
            "mail" => $mail,
            "name" => $name
        ];
    }
    

    public function send($subject,$body,$altbody = ''){
        $mail = new PHPMailer();
        try {
            //Server settings
            $mail->isSMTP();                                            
            $mail->Host       = $this->config['host'];                   
            $mail->SMTPAuth   = true;                                  
            $mail->Username   = $this->config['email'];                 
            $mail->Password   = $this->config['password'];                              
            $mail->SMTPSecure =  $this->config['secure'];          
            $mail->Port       = $this->config['port']; 

            $mail->setFrom( $this->fromMail,  $this->fromName);

            foreach($this->adress as $adres){
                $mail->addAddress($adres['mail'], $adres['name']);   
            }
     
            //Content
            $mail->isHTML(true);                                
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = $altbody;

            $mail->send();
            $this->error = '';

            $this->adress = [];

            return true;
        } catch (Exception $e) {
            $this->error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }
}