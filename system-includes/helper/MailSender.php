<?php


class MailSender
{

    public static $mail;
    /**
     * MailSender constructor.
     */
    public function __construct()
    {
        require 'PHPMailer-master/PHPMailerAutoload.php';
        self::$mail = new PHPMailer();
        self::$mail->SMTPDebug = 0;                               // Enable verbose debug output
        self::$mail->isSMTP();                                      // Set mailer to use SMTP
        self::$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        self::$mail->SMTPAuth = true;                               // Enable SMTP authentication
        self::$mail->Username = 'ayhanyunt@gmail.com';                 // SMTP username
        self::$mail->Password = '147852369A';                           // SMTP password
        self::$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        self::$mail->Port = 587;                                    // TCP port to connect to
        self::$mail->setFrom('ayhanyunt@gmail.com', 'kolaydna.com');
        self::$mail->CharSet = 'UTF-8';
    }

    function sendMailForActivation($sendToMail){
        self::$mail->addAddress($sendToMail);               // Name is optional
        self::$mail->isHTML(true);                                  // Set email format to HTML
        $activation_code = $this->createActivationCode();
        $message = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/activation/activation-form.html');
        $message = str_replace('%email%', $sendToMail, $message);
        $message = str_replace('%activation_code%', $activation_code, $message);

        self::$mail->Body = $message;
        self::$mail->AltBody = (strip_tags($message));
        $activation_obj = new ActivationDatabase();
        $activation_obj->createActivationCode($sendToMail,$activation_code);
        self::$mail->Subject = 'Aktivasyon Maili';
        if (self::$mail->send()){
            return "gonderildi";
        }   else{
            return "gonderilemedi";
        }
    }

    function sendMailForSiparisTamamlandi($sendToMail,$productArray,$cargoAddress,$billAddress,$customerName,$order_code){
        self::$mail->addAddress($sendToMail);               // Name is optional
        self::$mail->isHTML(true);
        if ($customerName==null){
            $message = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/admin/odeme/siparis-tamamlandi/ozet-mail-yonetici.html');

        }   else{
            $message = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/admin/odeme/siparis-tamamlandi/ozet-mail.html');

        }
        $str = "";
        $totalCount = 0 ;
        $totalPrice = 0 ;
        foreach ($productArray as $oneProduct){
            /**
             * @var $oneProduct Product
             */
            $productName = $oneProduct->getName();
            $productCount = $oneProduct->getCount();
            $totalCount+= $productCount;
            $productPrice = $oneProduct->getPrice()*$productCount;
            $totalPrice+=$productPrice;
            $str .=<<<HTML
<tr>
<th>${productName}</th>
<th>${productCount}</th>
<th>${productPrice}</th>
</tr>
HTML;
        }
        $totalPrice +=11.9;
        $message = str_replace("%content%",$str,$message);
        $message = str_replace("%kargoAdres%",$cargoAddress,$message);
        $message = str_replace("%faturaAdres%",$billAddress,$message);
        $message = str_replace("%urunSayisi%",$totalCount,$message);
        $message = str_replace("%price%",$totalPrice,$message);
        if ($customerName!=null){
            $message = str_replace("%isim%",$customerName,$message);
        }
        $message = str_replace("%order_code%",$order_code,$message);
        self::$mail->Body = $message;
        self::$mail->AltBody = (strip_tags($message));
        if ($customerName!=null){
            self::$mail->Subject = 'Siparişiniz alındı.';
        }   else{
            self::$mail->Subject = 'Yeni bir sipariş alındı.';
        }
        if (self::$mail->send()){
            return "gonderildi";
        }   else{
            return "gonderilemedi";
        }
    }

    function sendMailForPasswordChange($sendToMail,$password){
        self::$mail->addAddress($sendToMail);               // Name is optional
        self::$mail->isHTML(true);                                  // Set email format to HTML
        $activation_code = $this->createActivationCode();
        $message = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/sifre-degistir/sifre-degistir-mail-form.html');
        $message = str_replace('%email%', $sendToMail, $message);
        $message = str_replace('%activation_code%', $activation_code, $message);
        $message = str_replace('%password%',$password,$message);

        self::$mail->Body = $message;
        self::$mail->AltBody = (strip_tags($message));
        $activation_obj = new ActivationDatabase();
        $activation_obj->createActivationCode($sendToMail,$activation_code);
        self::$mail->Subject = 'Sifre Degistirme Maili';
        self::$mail->send();
    }

    function createActivationCode():int {
        $six_digit_random_number = mt_rand(100000, 999999);
        return $six_digit_random_number;
    }
}