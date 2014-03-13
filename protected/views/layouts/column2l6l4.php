<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
  <div class="col-md-6 col-md-offset-1" style="float: left;">
      <?php echo $content; ?>
  </div>
  <div class="col-md-4" style="float: left;">
      <?php echo $this->renderPartial($this->sideView); ?>
  </div>
</div>
<?php $this->endContent(); ?>