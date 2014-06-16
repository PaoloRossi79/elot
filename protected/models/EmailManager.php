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
            $mail = new YiiMailer();
            $mail->setView('resetPassword');
            $mail->setData(array('resetLink' => User::model()->getResetLink($user)));
            $mail->setFrom('info@wonlot.com', 'WonLot');
            $mail->setTo($user->email);
//            $mail->setTo('paolorossi79@gmail.com');
            $mail->setSubject('Password Reset');
            $sendRes=$mail->send();
            return $sendRes;
        }

	public function sendConfirmEmail($user){
            $mail = new YiiMailer();
            $mail->setView('confirmEmail');
            $mail->setData(array('confirmLink' => User::model()->getConfirmLink($user)));
            $mail->setFrom('info@wonlot.com', 'WonLot');
            $mail->setTo($user->email);
//            $mail->setTo('paolorossi79@gmail.com');
            $mail->setSubject('Email Confirmation');
            $sendRes=EmailManager::sendWithTry($mail);
            return $sendRes;
        }
        
	public function sendConfirmOkEmail($user){
            $mail = new YiiMailer();
            $mail->setView('confirmOkEmail');
            $mail->setData(array('user' => $user));
            $mail->setFrom('info@wonlot.com', 'WonLot');
            $mail->setTo($user->email);
//            $mail->setTo('paolorossi79@gmail.com');
            $mail->setSubject('Email confirmed!');
            $sendRes=EmailManager::sendWithTry($mail);
            return $sendRes;
        }
        
	public function sendInviteConfirmEmail($invite,$which){
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
        }
        
	public function sendInviteEmail($invite,$which){
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
        }
        
	public function sendOpenLottery($lottery){
            $mail = new YiiMailer();
            $mail->setView('openlottery');
            $mail->setData(array('lottery' => $lottery));
            $mail->setFrom('info@wonlot.com', 'WonLot');
            $mail->setTo($lottery->owner->email);
//            $mail->setTo('paolorossi79@gmail.com');
            $mail->setSubject('Una tua lotteria si è aperta su WonLot!');
            $sendRes=EmailManager::sendWithTry($mail);
            return $sendRes;
        }
        
	public function sendCloseLottery($lottery){
            $mail = new YiiMailer();
            $mail->setView('closelottery');
            $mail->setData(array('lottery' => $lottery));
            $mail->setFrom('info@wonlot.com', 'WonLot');
            $mail->setTo($lottery->owner->email);
//            $mail->setTo('paolorossi79@gmail.com');
            $mail->setSubject('Una tua lotteria si è chiusa su WonLot!');
            $sendRes=EmailManager::sendWithTry($mail);
            return $sendRes;
        }
	
	public function sendVoidLotteryToOwner($lottery){
            $mail = new YiiMailer();
            $mail->setView('voidlottery');
            $mail->setData(array('lottery' => $lottery));
            $mail->setFrom('info@wonlot.com', 'WonLot');
            $mail->setTo($lottery->owner->email);
//            $mail->setTo('paolorossi79@gmail.com');
            $mail->setSubject('Una tua lotteria si è chiusa su WonLot!');
            $sendRes=EmailManager::sendWithTry($mail);
            return $sendRes;
        }
        
	public function sendVoidLottery($lottery){
            $mail = new YiiMailer();
            $mail->setView('voidlottery');
            $mail->setData(array('lottery' => $lottery));
            $mail->setFrom('info@wonlot.com', 'WonLot');
            $mail->setTo($lottery->owner->email);
//            $mail->setTo('paolorossi79@gmail.com');
            $mail->setSubject('Una tua lotteria si è chiusa su WonLot!');
            $sendRes=EmailManager::sendWithTry($mail);
            return $sendRes;
        }
	
	public function sendTicket($ticket){
            $mail = new YiiMailer();
            $mail->setView('ticket');
            $mail->setData(array('ticket' => $ticket));
            $mail->setFrom('info@wonlot.com', 'WonLot');
            $mail->setTo($ticket->user->email);
//            $mail->setTo('paolorossi79@gmail.com');
            $mail->setSubject('Hai acquistato un ticket su WonLot!');
            $sendRes=EmailManager::sendWithTry($mail);
            return $sendRes;
        }
        
	public function sendTickets($user){
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
        }
        
	public function sendGiftTicket($ticket,$receiver){
            $mail = new YiiMailer();
            $mail->setView('giftTicket');
            $mail->setData(array('ticket' => $ticket));
            $mail->setFrom('info@wonlot.com', 'WonLot');
            $mail->setTo($receiver);
//            $mail->setTo('paolorossi79@gmail.com');
            $mail->setSubject('Ti hanno regalato un ticket su WonLot!');
            $sendRes=EmailManager::sendWithTry($mail);
            return $sendRes;
        }
	
        public function sendGiftTickets($user){
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
        }
        
	public function sendGiftTicketsToExt($user){
            $mail = new YiiMailer();
            $mail->setView('giftTicketsToExt');
            $mail->setData(array('tickets' => $user['lotteries']));
            $mail->setFrom('info@wonlot.com', 'WonLot');
            $mail->setTo($user['email']);
//            $mail->setTo('paolorossi79@gmail.com');
            $mail->setSubject('Ti hanno regalato un ticket su WonLot!');
            $sendRes=EmailManager::sendWithTry($mail);
            return $sendRes;
        }
	
	public function sendExtractLotteryToWinner($lottery){
            $mail = new YiiMailer();
            $mail->setView('winlottery');
            $mail->setData(array('lottery' => $lottery));
            $mail->setFrom('info@wonlot.com', 'WonLot');
            $mail->setTo($lottery->winner->email);
//            $mail->setTo('paolorossi79@gmail.com');
            $mail->setSubject('Una tua lotteria si è chiusa su WonLot!');
            $sendRes=EmailManager::sendWithTry($mail);
            return $sendRes;
        }
	
	public function sendExtractLotteryToOwner($lottery){
            $mail = new YiiMailer();
            $mail->setView('extractlottery');
            $mail->setData(array('lottery' => $lottery));
            $mail->setFrom('info@wonlot.com', 'WonLot');
            $mail->setTo($lottery->owner->email);
//            $mail->setTo('paolorossi79@gmail.com');
            $mail->setSubject('Una tua lotteria si è chiusa su WonLot!');
            $sendRes=EmailManager::sendWithTry($mail);
            return $sendRes;
        }
	
        public function sendAdminEmail($model,$action){
            $mail = new YiiMailer();
            $mail->setView('adminError');
            $mail->setData(array('model' => $model));
            $mail->setFrom('info@wonlot.com', 'WonLot');
            $mail->setTo('paolorossi79@gmail.com');
            $mail->setSubject('Error '.$action." - ID=".$model->id);
            $sendRes=EmailManager::sendWithTry($mail);
            return $sendRes;
        }

        public function sendCronAdminEmail($errors){
            $mail = new YiiMailer();
            $mail->setView('adminCronError');
            $mail->setData(array('errors' => $errors));
            $mail->setFrom('info@wonlot.com', 'WonLot');
            $mail->setTo('paolorossi79@gmail.com');
            $mail->setSubject('Error in CRON');
            $sendRes=EmailManager::sendWithTry($mail);
            return $sendRes;
        }
        
	public function sendInviteDeclineEmail($invite,$which){
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
        }

}