<?php
$buttons = array(
        'save' => array(
                'type' => 'submit',
                'label' => 'Save',
        ),
);
if($this->model->isNewRecord || $this->model->status==Yii::app()->params['lotteryStatusConst']['draft']){
    $buttons=array(
        'draft' => array(
                'type' => 'submit',
                'label' => 'Save as draft',
        ),
        'publish' => array(
                'type' => 'submit',
                'label' => 'Publish',
        ),
    );
}

return array(
	'title' => Yii::t('clos', 'Lotteries'),
	'attributes' => array(
		'enctype' => 'multipart/form-data',
                'id' => 'lot-form',
	),    
        'elements' => array(
            'name' => array(
                    'label' => Yii::t('clos', 'Lottery Name'),
                    'type' => 'text',
                    'size'=>25,
                    'maxlength'=>45
            ),
            /*'lottery_type' => array(
                    'label' => Yii::t('clos', 'Lottery Type'),
                    'type' => 'dropdownlist',
                    'items' => CHtml::listData(Yii::app()->params['lotteryTypes'], 'id', 'name')
            ),*/
            'prize_img' => array(
                'label' => Yii::t('clos', 'Prize Image'),
                'type' => 'bootstrap.widgets.TbThumbnails',
            ),
            'prize_desc' => array(
                        'label' => Yii::t('clos', 'Prize Description'),
                        'type' => 'ext.imperavi-redactor-widget.ImperaviRedactorWidget'
            ),
            'prize_category' => array(
                        'label' => 'Prize Category',//Yii::t('clos', 'Section'),
                        'type' => 'dropdownlist',
                        'items' => CHtml::listData(PrizeCategories::model()->getPrizeCatList(), 'id', 'category_name')
            ),
            'prize_conditions' => array(
                    'label' => Yii::t('clos', 'prize_conditions'),
                    'type' => 'text',
                    'size'=>45,
                    'maxlength'=>155
            ),
            'prize_shipping' => array(
                    'label' => 'Prize Shipping',//Yii::t('clos', 'Section'),
                    'type' => 'dropdownlist',
                    'items' => CHtml::listData(Yii::app()->params['speditionType'], 'id', 'type')
            ),
            /*'prize_price' => array(
                    'label' => Yii::t('clos', 'prize_price'),
                    'type' => 'text'
            ),*/
            'prize_price' => array(
                        'label' => Yii::t('clos', 'Prize Value'),
                        'type' => 'ext.prizeCalculator.PrizeCalculatorWidget'
            ),
            'ticket_value' => array(
                    'label' => Yii::t('clos', 'ticket_value'),
                    'type' => 'text'
            ),
            /*'min_ticket' => array(
                    'label' => Yii::t('clos', 'min_ticket'),
                    'type' => 'text'
            ),
            'max_ticket' => array(
                    'label' => Yii::t('clos', 'max_ticket'),
                    'type' => 'text'
            ),*/
            'lottery_start_date' => array(
                    'label' => 'lottery_start_date start',
                    'type' => 'application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',
                    'options'=>array(
                            'dateFormat'=>'dd/mm/yy',
                            //'dateFormat'=>'yy-mm-dd',
                            'timeFormat'=>'HH:mm:ss',
                            'showSecond'=>true,
                            'showTimezone'=>false,
                            'language' => 'it',
                            'ampm' => false,
                    ),
                    'language' => 'it',
            ),
            'lottery_draw_date' => array(
                    'label' => 'lottery_draw_date end',
                    'type' => 'application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',
                    'options'=>array(
                            'dateFormat'=>'dd/mm/yy',
                            //'dateFormat'=>'yy-mm-dd',
                            'timeFormat'=>'HH:mm:ss',
                            'showSecond'=>true,
                            'showTimezone'=>false,
                            'language' => 'it'
                    ),
                    'language' => 'it'
            ),
	),
	'buttons' => $buttons,
);