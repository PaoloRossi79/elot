<?php
class CronCommand extends CConsoleCommand
{
   
    public function run($args)
    {

        // ADD TO CRONTAB: php /path/to/cron.php Cron
        echo "OK";
        Yii::log("CRON OK!", "warning");
        
        // check upcoming to open
        $upCriteria = new CDbCriteria();
        $upCriteria->addCondition('t.status=1');
        $upCriteria->addCondition('t.lottery_start_date >= '.new CDbExpression("NOW()"));
        $upChange = Lotteries::model()->find();
    }


}    