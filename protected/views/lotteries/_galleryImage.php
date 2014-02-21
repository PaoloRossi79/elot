<div class="span4">
<?php 
    $dataProvider =  new CActiveDataProvider('Lotteries', array(
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
    ));
    ?>
</div>
<div class="span12">
<div id="big-gallery-item"><?php echo CHtml::image($this->getImageUrl($data,"galleryBigThumb"),'Prize image '.$k); ?></div>
</div>