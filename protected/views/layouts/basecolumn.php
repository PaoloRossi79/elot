<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
  <div class="col-md-4">
      <?php
            $this->renderPartial('/site/filters',$this->filterModel);
        ?>
  </div>
  <div class="col-md-8">
      <?php echo $content; ?>
  </div>
</div>
<?php $this->endContent(); ?>