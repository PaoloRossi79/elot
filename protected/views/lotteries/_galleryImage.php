<div class="span4">
<?php 
    /*$dataProvider =  new CActiveDataProvider('Lotteries', array(
        'criteria'=>array(
            'condition'=>'id='.$data->id,
        ))
    );
    $imgData=$this->getImageList($data->id);
    $dataProvider->setData($imgData);
    $dataProvider->setKeys(array_keys($imgData));
//    $dataProvider =  new CActiveDataProvider('Lotteries');
    $this->widget('ext.JCarousel.JCarousel', array(
        'dataProvider' => $dataProvider,
        'thumbUrl' => '"/images/lotteries/".$data->entityId."/gallerySmallThumb/".$data->file',
        'imageUrl' => '"/images/lotteries/".$data->entityId."/galleryBigThumb/".$data->file',
        'target' => 'big-gallery-item',
        'cssFile' => 'elot-skin.css',
    ));*/
    ?>
   
    
</div>
<div class="span12">
<div id="big-gallery-item"><?php echo CHtml::image($this->getImageUrl($model,"galleryBigThumb"),'Prize image '.$model->name,array('class'=>'big-image-prize')); ?></div>
<?php
    $dataProvider =  new MyImageDataProvider($model);
    $this->widget('ext.JCarousel.JCarousel', array(
        'dataProvider' => $dataProvider,
        /*'thumbUrl' => '$this->getImageUrl($data,"mediumSquaredThumb")',
        'imageUrl' => '$this->getImageUrl($data,"galleryBigThumb")',*/
        'thumbUrl' => '"/images/".$data->entityType."/".$data->entityId."/mediumSquaredThumb/".$data->file',
        'imageUrl' => '"/images/".$data->entityType."/".$data->entityId."/gallerySmallThumb/".$data->file',
        'target' => 'big-gallery-item',
        'cssFile' => 'elot-skin.css',
        'altText' => '"Immagine premio ".$data->name',
    ));
?>
</div>