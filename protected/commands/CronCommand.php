<?php
class CronCommand extends CConsoleCommand
{
   
    public function run($args)
    {
        Yii::log("CRON START!", "warning");
        // ADD TO CRONTAB: php /path/to/cron.php Cron
        $busy = file_exists(Yii::app()->basePath."/cron-lottery.lock");
        if(!$busy){
            Yii::log("CRON OK!", "warning");
            $file=Yii::app()->basePath."/cron-lottery.lock";
            $oFile=fopen($file,"w");
            fwrite($oFile,"DO");
            fclose($oFile);
            try {
                $errors = array('open'=>array(),'close'=>array(), 'extract'=>array(),'void'=>array());
                Lotteries::model()->checkToOpen($errors);
                Yii::log("CRON 1", "warning");
                Lotteries::model()->checkToClose($errors);
                Yii::log("CRON 2", "warning");
                Lotteries::model()->checkToExtract($errors);
                Yii::log("CRON 3", "warning");
                Lotteries::model()->checkToVoid($errors);
                Yii::log("CRON Fine", "warning");
                if(count($errors['open'])+
                   count($errors['close'])+
                   count($errors['extract'])+
                   count($errors['void']) > 0){
                   $emailRes=EmailManager::sendCronAdminEmail($errors);
                }
            } catch (Exception $exc) {
                Yii::log("CRON error:".$exc->getTraceAsString(),'error');
            }
            unlink($file);
        } else {
            Yii::log("CRON Busy -> SKIP ", "warning");
        }
        Yii::log("CRON END!", "warning");
    }


}    