<?php
class CronElab
{
	public $jobs=array();

	public function insertJob($type_cmd, $par_1, $par_2, $par_3, $runDate=null,$par_4=null, $par_5=null)
	{
		$model = new CronCmd;
		if($runDate===null)
			$runDate=date("Y-m-d H:i:s");

		$model->type_cmd = $type_cmd;
		$model->active = 1;
		$model->status = "GO";
		$model->par_1 = $par_1;
		$model->par_2 = $par_2;
		$model->par_3 = $par_3;
                $model->par_4 = $par_4;
                $model->par_5 = $par_5;
		$model->run = $runDate;
		$model->created = date("Y-m-d H:i:s");

		$esit = $model->save();
		return $esit;
	}

	public function elabAll()
	{

               //echo 'Bingo';
               //ElaborationMail::sendEmail('mforestan@cupuppo.com','Cron Clos','Ha girato alle '.date("Y-m-d H:i:s"));
               //mail('mforestan@cupuppo.com','Cron Clos 2','Ha girato alle '.date("Y-m-d H:i:s"));
               
               $model = CronCmd::model()->findAllbySql("SELECT * FROM cron_cmd WHERE active=1 and status<>'OK' and DATE(run)<=DATE(NOW()) ORDER BY run");

		foreach($model as $job) {
			$result = false;
			$job->last_run = date("Y-m-d H:i:s");
			$job->update();

			if($job->type_cmd=="MAIL"){
                              $result = CronElab::sendMail($job->par_1, $job->par_2, $job->par_3, $job->par_4, $job->par_5);
			}

			if($result)$job->status = "OK";
			else $job->status = "KO";

			$job->update();
		}

                //Apriamo i deal UPCOMING con data >= di adesso
                $upcoming_deals = Deals::models()->findAllbySql("SELECT * FROM deals WHERE deal_status_id = 2 and start_date >= NOW()");
                foreach ($upcoming_deals as $ud) {
                   $ud->deal_status_id = 1;
                   $ud->save(false,'deal_status_id');
                }
                //$open_deals = Deals::model()->findAllbySql("SELECT * FROM deals WHERE deal_status_id IN (1,3) and end_date <= NOW()");

	} 

	public function sendMail($typeMail, $addressTo, $id, $key2, $key3=null)
	{
		$model=Users::model()->findByPk($id); 
		if($model===null){
			return false;
		}
		return (ElaborationMail::sendEmailType($typeMail, $addressTo, $model, $key2));
	}

}


//Example:
//CronElab::insertJob("MAIL", "REGISTRATION01", "tomail@tin.it","1");
//CronElab::elabAll();

?>