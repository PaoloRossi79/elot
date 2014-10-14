<h2>Promozioni</h2>

<?php 
if($dataProvider){
    $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider'=>$dataProvider,
            'columns'=>array(
                'id',
                array(            
                    'name'=>Yii::t('wonlot','Tipo promozione'),
                    'value'=>'Yii::app()->params["specialOffersType"][$data->offer_on]["desc"]', 
                    'sortable'=>true,
                ),
                array(            
                    'name'=>Yii::t('wonlot','Valore promozione'),
                    'value'=>'$data->offer_value ."%"', 
                    'sortable'=>true,
                ),
                array(            
                    'name'=>Yii::t('wonlot','Utilizzi rimanenti'),
                    'value'=>'$data->times_remaining', 
                    'sortable'=>true,
                ),
                array(            
                    'name'=>Yii::t('wonlot','Validità'),
                    'value'=>array($dataProvider->model,'getValidityText'), 
                    'sortable'=>true,
                ),
                array(            
                    'name'=>'Data',
                    'value'=>'$data->created', 
                    'sortable'=>true,
                ),
            ),
    )); 
}

?>

