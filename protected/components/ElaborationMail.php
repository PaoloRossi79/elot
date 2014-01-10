<?php
class ElaborationMail extends CEmailLogRoute
{
    public function loadTemplate($templateName)
    {
		$language = 'it';
		$text = "";

		$fileName = dirname(__FILE__).DIRECTORY_SEPARATOR."templateMail".DIRECTORY_SEPARATOR.$language .DIRECTORY_SEPARATOR. $templateName . ".txt";

		$fh = fopen($fileName, 'r');

		if($fh){
			$text = fread($fh, filesize($fileName)); 
			$text = ElaborationMail::replaceTemplate($text);
			fclose($fh);
    		}
    		return $text;
    }

    public function sendEmail($toAddress, $subject, $message, $attachment = null, $senderName = null, $senderAddress = null, $toName = null, $ccAddress = null)
    {
      //$toAddress = Yii::app()->params['techEmail']; $ccAddress = null;// DEBUG

      $mail = new JPhpMailer;
      
      $mail->IsSMTP();
      $mail->Host = 'ssl://email-smtp.us-east-1.amazonaws.com';
      $mail->SMTPAuth = true;
      $mail->SMTPSecure = 'TLS';
      $mail->Port = 443;
      $mail->Username = 'AKIAIRWHE4BF2YHIZQ7A';
      $mail->Password = 'AhHav0/uxkAMrCV7Q8YAOP5OVN4x8MVovkEFqvLe8mvp';
      $mail->SMTPDebug  = 1;
      
      if(is_null($senderName) && is_null($senderAddress))
      {  
        $mail->SetFrom(Yii::app()->params['adminEmail'], Yii::app()->params['siteName']);
      }
      else
      {
        $mail->SetFrom($senderAddress, $senderName);
      }
      $mail->Subject = $subject;
      $mail->CharSet = 'utf-8';
      
      $mail->MsgHTML($message);
      $mail->AddAddress($toAddress, $toName);
      if(!is_null($ccAddress))
      {
        $mail->AddCC($ccAddress);
      }

      if (!is_null($attachment)) $mail->AddAttachment($attachment);

      $mailresult = $mail->Send();

      if ($mailresult) {
      	$r='1';
      } else {
      	$r='0';
      }
      Yii::log('Send mail subject = "' .$subject . '" - to = '.$toAddress. ' RET:'.$r.' MOT:'.$mailresult, 'info', 'mail');
      return $mailresult;
    }


//    public function privateEmail()
//    {
//		return( StrToUpper("hotmail.;tim.;tin.;libero.;gmail.;") );
//    }

    public function sendEmailType($typeMail, $toAddress, $key1, $key2=null, $resetCode=null){
         $typeMail = StrToUpper($typeMail);
         $message = "";
         $subject = "" . time();

         if($typeMail == 'REGISTRATION_OK'){
            //Spedito all'utente che si registra senza attesa
            $message = ElaborationMail::loadTemplate($typeMail);				//load template
            $message = ElaborationMail::replaceTemplateRegistration($message, $key1);           //replace key for template
            $subject = Yii::t('clos', 'Benvenuto su ') . Yii::app()->params['siteName'];	//Subject mail
         } else if($typeMail == 'REGISTRATION_WAIT'){
            //Spedito all'utente che si registra con attesa
            $message = ElaborationMail::loadTemplate($typeMail);
            $message = ElaborationMail::replaceTemplateRegistration($message, $key1);
            $subject = Yii::t('clos', 'Benvenuto su ') . Yii::app()->params['siteName'];
         } else if($typeMail == 'INVITE') {
            //Spedito all'utente invitato da un altro utente
            $message = ElaborationMail::loadTemplate($typeMail);
            $message = ElaborationMail::replaceTemplateInvite($message, $key1, $key2);
            $subject = ucwords($key2->firstname.' '.$key2->lastname) . ' ' . Yii::t('clos', 'ti ha invitato a fare parte della community privata ') . Yii::app()->params['siteName'];
         } else if($typeMail == 'PASSWORD_RECOVER') {
            //Spedito quando l'utente richiede il reinvio della password
            $message = ElaborationMail::loadTemplate($typeMail);
            $message = ElaborationMail::replaceTemplateRecoverPassword($message, $key1, $resetCode);
            $subject = Yii::t('clos', 'La tua password su ') . Yii::app()->params['siteName'];
         } else if($typeMail == 'PASSWORD_PROBLEM') {
            // Messaggio informativo per dire all'utente che la sua password potrebbe essergli stata cambiata
            $message = ElaborationMail::loadTemplate($typeMail);
            $message = ElaborationMail::replaceTemlatePasswordProblem($message, $key1);
            $subject = Yii::t('clos', 'Comunicazione per');
            $subject .= ucwords(' '.$key1->firstname.' '.$key1->lastname.' '); 
            $subject .= Yii::t('clos', 'da parte di Clos 1,81');
         }

         if ($message != ""){
            $return = ElaborationMail::sendEmail($toAddress, $subject, $message);
         } else {
            $return = false;
         }

         if ($return) $r='1';
         else $r='0';
         Yii::log('  Send mail subject = "' .$subject . '" - to = '.$toAddress. ' RET:'.$r . ' MOT:'.$return, 'trace', 'error');

         return $return;
    }

    public function replaceTemplate($text){		
		$text = str_replace("##DATE_TIME##", date_format(new DateTime(), 'd/m/Y H:i:s'), $text);
		return $text;
    }

    public function replaceTemplateAtt($text,$searcharray,$replacearray) {

                if(count($searcharray)==count($replacearray))
                     $text = str_replace($searcharray,$replacearray,$text);

                $text = str_replace("##SITE_LINK##", Yii::app()->params['siteUrl'], $text);
                $text = str_replace("##SITE_NAME##", Yii::app()->params['siteName'], $text);
                $text = str_replace("##FROM_EMAIL##", Yii::app()->params['adminEmail'], $text);
                $text = str_replace("##DATE_TIME##", date_format(new DateTime(), 'd/m/Y H:i:s'), $text);

                return $text;

    }

    public function replaceTemplateRegistration($text, $model){
                //##SITE_LINK##, ##SITE_NAME##, ##FROM_EMAIL##
                //##LOGIN_LINK##, ##INVITE_LINK##, ##PROFILE_LINK##
                //##FULLNAME##, ##DOB##, ##USER_EMAIL##,##PASSWORD##

		$text = str_replace("##FULLNAME##", ucwords($model->firstname . ' ' .$model->lastname), $text);
                list($y, $m, $d) = explode('-',$model->birthdate);
		$text = str_replace("##DOB##", $d.'/'.$m.'/'.$y, $text);
                $text = str_replace("##USER_EMAIL##", strtolower($model->email), $text);
                $text = str_replace("##PASSWORD2##", $model->password2, $text);
                
                //$rcon = new RegistrationController();
                if (substr(Yii::app()->params['siteUrl'], -1)=='/') $siteurl= substr(Yii::app()->params['siteUrl'], 0, -1);
                else $siteurl=Yii::app()->params['siteUrl'];
                
                
                $loginurl = str_replace('.com/site','.com/index.php/site',$siteurl.Yii::app()->createUrl('/site/login'));
                $userinvite = str_replace('.com/user','.com/index.php/site',$siteurl.Yii::app()->createUrl('/userInvites/index'));
                $profile = str_replace('.com/user','.com/index.php/site',$siteurl.Yii::app()->createUrl('/user/update'));

                $text = str_replace("##LOGIN_LINK##",$loginurl, $text);
                $text = str_replace("##INVITE_LINK##", $userinvite, $text);
                $text = str_replace("##PROFILE_LINK##", $profile, $text);
                
                $text = str_replace("##SITE_LINK##", Yii::app()->params['siteUrl'], $text);
                $text = str_replace("##SITE_NAME##", Yii::app()->params['siteName'], $text);
                $text = str_replace("##FROM_EMAIL##", Yii::app()->params['adminEmail'], $text);

		return $text;
    }

    public function replaceTemplateInvite($text, $model, $user){
               //##SITE_LINK##, ##SITE_NAME##, ##FROM_EMAIL##
               //##INVITER_NAME##, ##INVITER_EMAIL##,
               //##INVITE_ID##, ##INVITE_DATE##, ##INVITE_LINK##
               //##INVITED_EMAIL##
       
                $text = str_replace("##SITE_LINK##", Yii::app()->params['siteUrl'], $text);
                $text = str_replace("##SITE_NAME##", Yii::app()->params['siteName'], $text);
                $text = str_replace("##FROM_EMAIL##", Yii::app()->params['adminEmail'], $text);
                
                $text = str_replace("##INVITER_NAME##", ucwords($user->firstname.' '.$user->lastname), $text);
                $text = str_replace("##INVITER_EMAIL##", strtolower($user->email), $text);

                $text = str_replace("##INVITE_ID##", $model->guid, $text);
                $text = str_replace("##INVITE_DATE##", date_format(new DateTime(), 'd/m/Y H:i'), $text);
                $text = str_replace("##INVITE_LINK##", $this->createAbsoluteUrl('/registration').'?invit='.$model->guid, $text);
				$text = str_replace("##MESSAGE##", empty($model->message) ? Yii::t('clos', 'Nessun messaggio') : $model->message, $text);
       
		$text = str_replace("##INVITED_EMAIL##", $model->invited_user_email, $text);
                
		return $text;
    }

    public function replaceTemplateRecoverPassword($text, $user, $resetCode){
               //##SITE_LINK##, ##SITE_NAME##, ##FROM_EMAIL##
               //##LOGIN_LINK##, ##CHANGE_PWD_LINK##
               //##USER_EMAIL##, ##USER_FULLNAME##, ##USER_PASSWORD##

                $text = str_replace("##SITE_LINK##", Yii::app()->params['siteUrl'], $text);
                $text = str_replace("##SITE_NAME##", Yii::app()->params['siteName'], $text);
                $text = str_replace("##FROM_EMAIL##", Yii::app()->params['adminEmail'], $text);

                $text = str_replace("##LOGIN_LINK##", $this->createAbsoluteUrl('/site/login'), $text);
                $text = str_replace("##CHANGE_PWD_LINK##", $this->createAbsoluteUrl('/user/password'), $text);

                $text = str_replace("##USER_EMAIL##", strtolower($user->email), $text);
                $text = str_replace("##USER_FULLNAME##", ucwords($user->firstname.' '.$user->lastname), $text);
                $text = str_replace("##USER_PASSWORD##", $user->password, $text);
                $text = str_replace("##RESET_LINK##", Yii::app()->params['siteUrl'].'password-reset?rcode='.$resetCode, $text);

		return $text;
    }

    public function replaceTemlatePasswordProblem($text, $user){
               //##SITE_LINK##, ##SITE_NAME##, ##FROM_EMAIL##
               //##LOGIN_LINK##, ##CHANGE_PWD_LINK##
               //##USER_EMAIL##, ##USER_FULLNAME##, ##USER_PASSWORD##

                if (substr(Yii::app()->params['siteUrl'], -1)=='/') $siteurl= substr(Yii::app()->params['siteUrl'], 0, -1);
                else $siteurl=Yii::app()->params['siteUrl'];

                $text = str_replace("##SITE_LINK##", Yii::app()->params['siteUrl'], $text);
                $text = str_replace("##SITE_NAME##", Yii::app()->params['siteName'], $text);
                $text = str_replace("##FROM_EMAIL##", Yii::app()->params['adminEmail'], $text);

                $text = str_replace("##LOGIN_LINK##", $siteurl.Yii::app()->createUrl('/site/login'), $text);
                $text = str_replace("##CHANGE_PWD_LINK##", $siteurl.Yii::app()->createUrl('/user/password'), $text);

                $text = str_replace("##USER_EMAIL##", strtolower($user->email), $text);
                $text = str_replace("##USER_FULLNAME##", ucwords($user->firstname.' '.$user->lastname), $text);
                $text = str_replace("##USER_PASSWORD##", $user->password, $text);

    return $text;
    }



}
?>