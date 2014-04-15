
<?php 
echo CHtml::ajaxButton("Nascondi transazioni",'#',
    array('success'=>'js:function(event){$("#reshow-trans").show();$("#user-trans").fadeOut();}'),array('id'=>'hide-trans')
);
?>
<script>
    $("#show-trans").hide();
    $("#reshow-trans").hide();
    $("#reshow-trans").click(function(event){
        $("#user-trans").fadeIn();
    });
</script>
    
<h2>Transazioni</h2>

<?php 
if($dataProvider){
    $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider'=>$dataProvider,
            'columns'=>array(
                'id',
                array(            
                    'name'=>'Tipo transazione',
                    'value'=>'Yii::app()->params["userTransactionId"][$data->transaction_type]', 
                    'sortable'=>true,
                ),
                array(            
                    'name'=>'Collegata a',
                    'value'=>array($dataProvider->model,'getLinkedText'), 
                    'sortable'=>true,
                ),
                array(            
                    'name'=>'Importo',
                    'value'=>'$data->value', 
                    'sortable'=>true,
                    'cssClassExpression'=>'($data->value < 0) ? "red-trans" : "green-trans"'
                ),
            ),
    )); 
}

?>

