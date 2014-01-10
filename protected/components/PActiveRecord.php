<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PActiveRecord
 *
 * @author paolo
 */
class PActiveRecord  extends CActiveRecord {
    private $runCustomBeforeSave=true;
    
    public  function save($runValidation=true,$attributes=null,$runBeforeSave=true){
        if(!$runBeforeSave){
            $this->runCustomBeforeSave=false;
        }
        return parent::save($runValidation,$attributes);
    }
    
    protected function beforeSave(){
        if($this->runCustomBeforeSave){
            if($this->hasAttribute('created') && $this->isNewRecord){
                $this->created=new CDbExpression('NOW()');
            }
            if($this->hasAttribute('modified')){
                $this->modified=new CDbExpression('NOW()');
            }
            if($this->hasAttribute('last_modified_by')){
                $this->last_modified_by=Yii::app()->user->id;
            }
        }
        foreach($this->tableSchema->columns as $columnName => $column){
            if (($column->dbType == 'date') || ($column->dbType == 'datetime') && ($columnName !== 'created') && ($columnName !== 'modified')){
                if (!strlen($this->$columnName)) { 
                    $this->$columnName=null;
                } else {
                    $oldCol=$this->$columnName;
//                    $this->$columnName=Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss',$oldCol);
                    $this->$columnName=date('Y-m-d H:i:s',CDateTimeParser::parse($oldCol,'dd/MM/yyyy HH:mm:ss'));
                }
            }
        }
        return parent::beforeSave();
    }
    
    protected function afterFind() {
        // Format dates based on the locale
        foreach($this->tableSchema->columns as $columnName => $column)
        {           
            if (!strlen($this->$columnName)) continue;

            if ($column->dbType == 'datetime' || $column->dbType == 'timestamp')
            {
                /*$this->$columnName = Yii::app()->dateFormatter->formatDateTime(
                    CDateTimeParser::parse(
                        $this->$columnName, 
                        'yyyy-MM-dd hh:mm:ss'
                    ),
                    'small','small'
                );*/
                $this->$columnName = date('d/m/Y H:i:s', CDateTimeParser::parse($this->$columnName, 'yyyy-MM-dd hh:mm:ss'));
            }
        }
        return parent::afterFind();
    }
}

?>
