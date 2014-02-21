<div class="lot-box">
    <div class="lot-box-int">
        <div class="lot-cat"> 
            <?php 
                echo CHtml::image('/images/site/'.$data->category->image, $data->category->category_name); 
            ?>
        </div>
        <div class="lot-name">       
            <span><?php echo $data->name; ?></span>
        </div>
        <div class="lot-star"></div>
            <div class="lot-img"> 
                <?php echo CHtml::image($this->getImageUrl($data,'mediumSquaredThumb'),'Lottery Image'); ?>
            </div>
        <div class="lot-break"></div>
        <div class="lot-value">
            <div class="lot-wlmoney"></div>
            <p><?php echo $data->prize_price;?></p>
        </div>
    </div>
</div>