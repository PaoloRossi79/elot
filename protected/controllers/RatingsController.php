<?php

class RatingsController extends Controller
{
        public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create'),
				'users'=>array('@'),
			),
                    );
        }
        
	public function actionIndex()
	{
		$this->render('index');
	}
        
	public function actionCreate()
	{
            $userId = Yii::app()->user->id;
            $params=$_POST;
            if($params){
                if($params['lotteryId'] && $params['ticketId'] && $params['touserId']){
                    //check if can rate
                    $lottery = Lotteries::model()->findByPk($params['lotteryId']);
                    if($lottery && $lottery->winnerTicket->id == $params['ticketId'] && $lottery->winner->id == $userId){
                        $rate = new Ratings;
                        $rate->user_id = $userId;
                        $rate->to_entity_id = $params['touserId'];
                        $rate->to_entity_type = 'vendor';
                        $rate->rating_value = $params['rating'];
                        $rate->comment = $params['comment'];
                        $rate->published = 1;
                        if($rate->save()){
                            echo CJSON::encode(array(
                                'res'=>1,
                            ));
                        } else {
                            echo CJSON::encode(array(
                            'res'=>0,
                                'msg'=>Yii::t('wonlot','Errore nel salvataggio del voto'),
                            ));
                        }
                    } else {
                        echo CJSON::encode(array(
                            'res'=>0,
                            'msg'=>Yii::t('wonlot','Errore: non puoi votare per questa lotteria'),
                        ));
                    }
                    
                } else {
                    echo CJSON::encode(array(
                        'res'=>0,
                        'msg'=>Yii::t('wonlot','Errore: dati mancanti'),
                    ));
                }
            } else {
                echo CJSON::encode(array(
                    'res'=>0,
                    'msg'=>Yii::t('wonlot','Errore: dati mancanti'),
                ));
            }
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}