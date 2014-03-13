<?php
class PrizeCalculatorWidget extends CInputWidget
{
    public $prize;
    public $commission; 
    public $options = array();
    public $selector;
    public $inputField;
    public $wlPerc = 5;
 
    public function init()
    {
        list($this->name, $this->id) = $this->resolveNameID();
        $this->htmlOptions['id'] = $this->id;
        $labels = $this->model->attributeLabels();
        $this->htmlOptions['placeholder'] = $labels[$this->attribute];
        $this->selector = '#' . $this->id;

        if ($this->hasModel()) {
                $this->inputField = CHtml::activeTextField($this->model, $this->attribute, $this->htmlOptions);
        } else {
                $this->inputField = CHtml::textField($this->name, $this->value, $this->htmlOptions);
        }
    }
 
    public function run()
    {
            $this->registerClientScript();
            $this->render('calculator');
    } 
    
    /**
    * Registers necessary client scripts.
    */
    public function registerClientScript()
    {
            Yii::app()->clientScript->registerScript(__CLASS__."-ready". '#' . $this->id, <<<JS
        if($("#$this->id").val() > 0){
            $("#commission-missing").hide();
            $("#commission-data").show();
        }
JS
            ,CClientScript::POS_READY);
            Yii::app()->clientScript->registerScript(__CLASS__. '#' . $this->id, <<<JS
jQuery("#$this->id").change(function() {
        if($("#$this->id").val() > 0){
            $("#commission-data").show();
            $("#commission-missing").hide();
        } else {
            $("#commission-data").hide();
            $("#commission-missing").show();
        }
        var newVal = $("#$this->id").val() - ($("#$this->id").val() * $this->wlPerc / 100);
        $("#userEarning").text(newVal);
});	
JS
            );
    }
}
?>
