<?php
class CronTicketsCommand extends CConsoleCommand
{
   
    public function run($args)
    {

        $busy = file_exists(Yii::app()->basePath."/cron-ticket.lock");
        if(!$busy){
            Yii::log("CRON OK!", "warning");
            $file=Yii::app()->basePath."/cron-ticket.lock";
            $oFile=fopen($file,"w");
            fwrite($oFile,"5");
            fclose($oFile);
            chmod($file, 0777);
            try {
                // ADD TO CRONTAB: php /path/to/cron.php CronTickets
                Yii::log("CRON Tickets OK!", "warning");
                $errors = array('tickets'=>array(),'giftTickets'=>array());

                Lotteries::model()->sendTicketsEmail($errors);
                Lotteries::model()->sendGiftTicketsEmail($errors);
                Yii::log("CRON Tickets Fine", "warning");

                if(count($errors['tickets']) > 0 && count($errors['giftTickets']) > 0){
                    $emailRes=EmailManager::sendCronAdminEmail($errors);
                }
            } catch (Exception $exc) {
                Yii::log("CRON Tickets error:".$exc->getTraceAsString(),'error');
            }
            unlink($file);
        } else {
            Yii::log("CRON Tickets Busy -> SKIP ", "warning");
            $file=Yii::app()->basePath."/cron-ticket.lock";
            $oFile=fopen($file,"r");
            $filesize=filesize($file);
            Yii::log("SIZE=".$filesize, "warning");
            $last=fread($oFile,$filesize);
            fclose($oFile); 
            Yii::log("LAST=".$last, "warning");
            $newLast=$last-1;
            if($newLast == 0){
                unlink($file);
            } else {
                $oFile=fopen($file,"w");
                fwrite($oFile,$newLast);
                fclose($oFile); 
            }
        }
    }

}    