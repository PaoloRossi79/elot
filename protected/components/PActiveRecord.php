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
    
    public function getImageList($entityId){
        $subPath="/images/".lcfirst(get_class($this))."/".$entityId."/";
        $img_path=Yii::app()->basePath."/..".$subPath;
        $fileList=array();
        if(is_dir($img_path)){
            $dirIter=new DirectoryIterator($img_path);
            while( $dirIter->valid()) {
                if($dirIter->isFile()){
                    $newFile=new stdClass;
                    $newFile->file=$dirIter->getFilename();
                    $newFile->entityId=$entityId;
                    $newFile->entityType=lcfirst(get_class($this));
                    $fileList[]=$newFile;
                }
                /*** move to the next element ***/
                $dirIter->next();
            }
        }
        return $fileList;
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
                if(Yii::app()->params['isCron']){
                    $this->last_modified_by="0";
                } else {
                    $this->last_modified_by=Yii::app()->user->id;
                }
            }
        }
        foreach($this->tableSchema->columns as $columnName => $column){
            if (($column->dbType == 'date') || ($column->dbType == 'datetime') && ($columnName !== 'created') && ($columnName !== 'modified')){
                if (!strlen($this->$columnName)) { 
                    $this->$columnName=null;
                } else {
                    if(!is_object($this->$columnName)){
                        $val = $this->$columnName;
                        $baseConversion = CDateTimeParser::parse($val,'yyyy-MM-dd HH:mm:ss');
                        if(!$baseConversion){
                            switch (strlen($val)){
                                case 10: //dd/MM/yyyy
                                    $this->$columnName=date('Y-m-d H:i:s',CDateTimeParser::parse($this->$columnName." 00:00:00",'dd/MM/yyyy HH:mm:ss'));
                                    break;
                                case 16: //dd/MM/yyyy HH:mm
                                    $this->$columnName=date('Y-m-d H:i:s',CDateTimeParser::parse($this->$columnName.":00",'dd/MM/yyyy HH:mm:ss'));
                                    break;
                                default: //dd/MM/yyyy HH:mm
                                    $this->$columnName=date('Y-m-d H:i:s',CDateTimeParser::parse($this->$columnName,'dd/MM/yyyy HH:mm:ss'));
                                    break;
                            }
                        }
                    }
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
                $this->$columnName = date('d/m/Y H:i:s', CDateTimeParser::parse($this->$columnName, 'yyyy-MM-dd hh:mm:ss'));
//                $this->$columnName = date('d/m/Y', CDateTimeParser::parse($this->$columnName, 'yyyy-MM-dd hh:mm:ss'));
                $t=1;
            }
        }
        return parent::afterFind();
    }
}

?>
