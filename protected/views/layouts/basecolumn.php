<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
  <div class="col-md-3">
      <?php
            $this->renderPartial('/site/filters',$this->filterModel);
        ?>
  </div>
  <div class="col-md-9">
      <?php echo $content; ?>
  </div>
</div>
<?php $this->endContent(); ?>