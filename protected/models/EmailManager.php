<?php

class EmailManager extends PActiveRecord
{
        /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Translation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        private function sendWithTry($mail){
            $res = false;
            if($mail){
                try{
                    $res = $mail->send();
                    return $res;
                } catch (Exception $ex) {
                    Yii::log("Err sending email: ".$ex->getMessage(), "error");
                }
            }
            return false;
        }
        
	public function sendResetPasswordEmail($user){
            try {
                $mail = new YiiMailer();
                $mail->setView('resetPassword');
                $mail->setData(array('resetLink' => Users::model()->getResetLink($user)));
                $mail->setFrom('info@wonlot.com', 'WonLot');
                $mail->setTo($user->email);
    //            $mail->setTo('paolorossi79@gmail.com');
                $mail->setSubject('Password Reset');
                $sendRes=$mail->send();
                return $sendRes;
            } catch (Exception $e){
                Yii::log("Err sending email: ".$e->getMessage(), "error");
            }
        }

	public function sendConfirmEmail($user){
            try {
                $mail = new YiiMailer();
                $mail->setView('confirmEmail');
                $mail->setData(array('confirmLink' => Users::model()->getConfirmLink($user)));
                $mail->setFrom('info@wonlot.com', 'WonLot');
                $mail->setTo($user->email);
    //            $mail->setTo('paolorossi79@gmail.com');
                $mail->setSubject('Email Confirmation');
                $sendRes=EmailManager::sendWithTry($mail);
                return $sendRes;
            } catch (Exception $e){
                Yii::log("Err sending email: ".$e->getMessage(), "error");
            }
        }
        
	public function sendConfirmOkEmail($user){
            try {
                $mail = new YiiMailer();
                $mail->setView('confirmOkEmail');
                $mail->setData(array('user' => $user));
                $mail->setFrom('info@wonlot.com', 'WonLot');
                $mail->setTo($user->email);
    //            $mail->setTo('paolorossi79@gmail.com');
                $mail->setSubject('Email confirmed!');
                $sendRes=EmailManager::sendWithTry($mail);
                return $sendRes;
            } catch (Exception $e){
                Yii::log("Err sending email: ".$e->getMessage(), "error");
            }
        }
        
	public function sendInviteConfirmEmail($invite,$which){
            try {
                $user = $invite->$which;
                $mail = new YiiMailer();
                $mail->setView('inviteConfirmEmail');
                $mail->setData(array('invite' => $invite,'user'=> $user));
                $mail->setFrom('info@wonlot.com', 'WonLot');
                $mail->setTo($user->email);
    //            $mail->setTo('paolorossi79@gmail.com');
                $mail->setSubject('Invite confirmed!');
                $sendRes=EmailManager::sendWithTry($mail);
                return $sendRes;
            } catch (Exception $e){
                Yii::log("Err sending email: ".$e->getMessage(), "error");
            }
        }
        
	public function sendInviteEmail($invite,$which){
            try {
                $user = $invite->$which;
                $mail = new YiiMailer();
                $mail->setView('inviteEmail');
                $mail->setData(array('invite' => $invite,'user'=> $user));
                $mail->setFrom('info@wonlot.com', 'WonLot');
                $mail->setTo($user->email);
    //            $mail->setTo('paolorossi79@gmail.com');
                $mail->setSubject('You got a new Invite on WonLot!');
                $sendRes=EmailManager::sendWithTry($mail);
                return $sendRes;
            } catch (Exception $e){
                Yii::log("Err sending email: ".$e->getMessage(), "error");
            }
        }
        
	public function sendOpenLottery($lottery){
            if($lottery && $lottery->owner && $lottery->owner->email){
                try {
                    $mail = new YiiMailer();
                    $mail->setView('openlottery');
                    $mail->setData(array('lottery' => $lottery));
                    $mail->setFrom('info@wonlot.com', 'WonLot');
                    $mail->setTo($lottery->owner->email);
        //            $mail->setTo('paolorossi79@gmail.com');
                    $mail->setSubject('Una tua Asta si è aperta su WonLot!');
                    $sendRes=EmailManager::sendWithTry($mail);
                    return $sendRes;
                } catch (Exception $e){
                    Yii::log("Err sending email: ".$e->getMessage(), "error");
                }
            }
        }
        
	public function sendCloseLottery($lottery){
            if($lottery && $lottery->owner && $lottery->owner->email){
                try {
                    $mail = new YiiMailer();
                    $mail->setView('closelottery');
                    $mail->setData(array('lottery' => $lottery));
                    $mail->setFrom('info@wonlot.com', 'WonLot');
                    $mail->setTo($lottery->owner->email);
        //            $mail->setTo('paolorossi79@gmail.com');
                    $mail->setSubject('Una tua Asta si è chiusa su WonLot!');
                    $sendRes=EmailManager::sendWithTry($mail);
                    return $sendRes;
                } catch (Exception $e){
                    Yii::log("Err sending email: ".$e->getMessage(), "error");
                }
            }
        }
	
	public function sendVoidLotteryToOwner($lottery){
            if($lottery && $lottery->owner && $lottery->owner->email){
                try {
                    $mail = new YiiMailer();
                    $mail->setView('voidlottery');
                    $mail->setData(array('lottery' => $lottery));
                    $mail->setFrom('info@wonlot.com', 'WonLot');
                    $mail->setTo($lottery->owner->email);
        //            $mail->setTo('paolorossi79@gmail.com');
                    $mail->setSubject('Una tua Asta si è chiusa su WonLot!');
                    $sendRes=EmailManager::sendWithTry($mail);
                    return $sendRes;
                } catch (Exception $e){
                    Yii::log("Err sending email: ".$e->getMessage(), "error");
                }
            }
        }
        
	public function sendVoidLottery($lottery){
            if($lottery && $lottery->owner && $lottery->owner->email){
                try {
                    $mail = new YiiMailer();
                    $mail->setView('voidlottery');
                    $mail->setData(array('lottery' => $lottery));
                    $mail->setFrom('info@wonlot.com', 'WonLot');
                    $mail->setTo($lottery->owner->email);
        //            $mail->setTo('paolorossi79@gmail.com');
                    $mail->setSubject('Una tua Asta si è chiusa su WonLot!');
                    $sendRes=EmailManager::sendWithTry($mail);
                    return $sendRes;
                } catch (Exception $e){
                    Yii::log("Err sending email: ".$e->getMessage(), "error");
                }
            }
        }
	
	public function sendTicket($ticket){
            try {
                $mail = new YiiMailer();
                $mail->setView('ticket');
                $mail->setData(array('ticket' => $ticket));
                $mail->setFrom('info@wonlot.com', 'WonLot');
                $mail->setTo($ticket->user->email);
    //            $mail->setTo('paolorossi79@gmail.com');
                $mail->setSubject('Hai acquistato un ticket su WonLot!');
                $sendRes=EmailManager::sendWithTry($mail);
                return $sendRes;
            } catch (Exception $e){
                Yii::log("Err sending email: ".$e->getMessage(), "error");
            }
        }
        
	public function sendTickets($user){
            try {
                $ticketsOrganized = Tickets::model()->organizeTicketsByLottery($user->tickets);
                $mail = new YiiMailer();
                $mail->setView('tickets');
                $mail->setData(array('tickets' => $ticketsOrganized));
                $mail->setFrom('info@wonlot.com', 'WonLot');
                $mail->setTo($user->email);
    //            $mail->setTo('paolorossi79@gmail.com');
                $mail->setSubject('Hai acquistato dei ticket su WonLot!');
                $sendRes=EmailManager::sendWithTry($mail);
            return $sendRes;
            } catch (Exception $e){
                Yii::log("Err sending email: ".$e->getMessage(), "error");
            }
        }
        
	public function sendGiftTicket($ticket,$receiver){
            try {
                $mail = new YiiMailer();
                $mail->setView('giftTicket');
                $mail->setData(array('ticket' => $ticket));
                $mail->setFrom('info@wonlot.com', 'WonLot');
                $mail->setTo($receiver);
    //            $mail->setTo('paolorossi79@gmail.com');
                $mail->setSubject('Ti hanno regalato un ticket su WonLot!');
                $sendRes=EmailManager::sendWithTry($mail);
                return $sendRes;
            } catch (Exception $e){
                Yii::log("Err sending email: ".$e->getMessage(), "error");
            }
        }
	
        public function sendGiftTickets($user){
            try {
                $ticketsOrganized = Tickets::model()->organizeTicketsByLottery($user->tickets);
                $mail = new YiiMailer();
                $mail->setView('giftTickets');
                $mail->setData(array('tickets' => $ticketsOrganized));
                $mail->setFrom('info@wonlot.com', 'WonLot');
                $mail->setTo($user->email);
    //            $mail->setTo('paolorossi79@gmail.com');
                $mail->setSubject('Hai acquistato dei ticket su WonLot!');
                $sendRes=EmailManager::sendWithTry($mail);
                return $sendRes;
            } catch (Exception $e){
                Yii::log("Err sending email: ".$e->getMessage(), "error");
            }
        }
        
	public function sendGiftTicketsToExt($user){
            try {
                $mail = new YiiMailer();
                $mail->setView('giftTicketsToExt');
                $mail->setData(array('tickets' => $user['lotteries']));
                $mail->setFrom('info@wonlot.com', 'WonLot');
                $mail->setTo($user['email']);
    //            $mail->setTo('paolorossi79@gmail.com');
                $mail->setSubject('Ti hanno regalato un ticket su WonLot!');
                $sendRes=EmailManager::sendWithTry($mail);
                return $sendRes;
            } catch (Exception $e){
                Yii::log("Err sending email: ".$e->getMessage(), "error");
            }
        }
	
	public function sendExtractLotteryToWinner($lottery){
            if($lottery && $lottery->winner && $lottery->winner->email){
                try {
                    $mail = new YiiMailer();
                    $mail->setView('winlottery');
                    $mail->setData(array('lottery' => $lottery));
                    $mail->setFrom('info@wonlot.com', 'WonLot');
                    $mail->setTo($lottery->winner->email);
        //            $mail->setTo('paolorossi79@gmail.com');
                    $mail->setSubject('Una tua Asta si è chiusa su WonLot!');
                    $sendRes=EmailManager::sendWithTry($mail);
                    return $sendRes;
                } catch (Exception $e){
                    Yii::log("Err sending email: ".$e->getMessage(), "error");
                }
            }
        }
	
	public function sendExtractLotteryToOwner($lottery){
            if($lottery && $lottery->owner && $lottery->owner->email){
                try {
                    $mail = new YiiMailer();
                    $mail->setView('extractlottery');
                    $mail->setData(array('lottery' => $lottery));
                    $mail->setFrom('info@wonlot.com', 'WonLot');
                    $mail->setTo($lottery->owner->email);
        //            $mail->setTo('paolorossi79@gmail.com');
                    $mail->setSubject('Una tua Asta si è chiusa su WonLot!');
                    $sendRes=EmailManager::sendWithTry($mail);
                    return $sendRes;
                } catch (Exception $e){
                    Yii::log("Err sending email: ".$e->getMessage(), "error");
                }
            }
        }
	
        public function sendAdminEmail($model,$action){
            try {
                $mail = new YiiMailer();
                $mail->setView('adminError');
                $mail->setData(array('model' => $model));
                $mail->setFrom('info@wonlot.com', 'WonLot');
                $mail->setTo('paolorossi79@gmail.com');
                $mail->setSubject('Error '.$action." - ID=".$model->id);
                $sendRes=EmailManager::sendWithTry($mail);
                return $sendRes;
            } catch (Exception $e){
                Yii::log("Err sending email: ".$e->getMessage(), "error");
            }
        }

        public function sendCronAdminEmail($errors){
            try {
                $mail = new YiiMailer();
                $mail->setView('adminCronError');
                $mail->setData(array('errors' => $errors));
                $mail->setFrom('info@wonlot.com', 'WonLot');
                $mail->setTo('paolorossi79@gmail.com');
                $mail->setSubject('Error in CRON');
                $sendRes=EmailManager::sendWithTry($mail);
                return $sendRes;
            } catch (Exception $e){
                Yii::log("Err sending email: ".$e->getMessage(), "error");
            }
        }
        
	public function sendInviteDeclineEmail($invite,$which){
            try {
                $user = $invite->$which;
                $mail = new YiiMailer();
                $mail->setView('inviteDeclineEmail');
                $mail->setData(array('invite' => $invite,'user'=> $user));
                $mail->setFrom('info@wonlot.com', 'WonLot');
                $mail->setTo($user->email);
    //            $mail->setTo('paolorossi79@gmail.com');
                $mail->setSubject('An invitation has been declined on WonLot!');
                $sendRes=EmailManager::sendWithTry($mail);
                return $sendRes;
            } catch (Exception $e){
                Yii::log("Err sending email: ".$e->getMessage(), "error");
            }
        }

}