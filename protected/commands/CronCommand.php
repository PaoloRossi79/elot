<?php
class CronCommand extends CConsoleCommand
{
   
    public function run($args)
    {

        // ADD TO CRONTAB: php /path/to/cron.php Cron
        echo "OK";
        Yii::log("CRON OK!", "warning");
        $errors = array('open'=>array(),'close'=>array(), 'extract'=>array());
        
        Lotteries::model()->checkToOpen($errors);
        Yii::log("CRON 2", "warning");
        Lotteries::model()->checkToClose($errors);
        Yii::log("CRON 4", "warning");
        Lotteries::model()->checkToExtract($errors);
        Yii::log("CRON 6", "warning");
        
        if(count($errors['open'])+
           count($errors['close'])+
           count($errors['extract']) > 0){
            $emailRes=EmailManager::sendCronAdminEmail($errors);
        }
    }


}    