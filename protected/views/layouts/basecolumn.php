<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
  <div class="show-filter-button">
    <button class="btn btn-large glyphicon glyphicon-zoom-in" id="show-filter"></button>
    <span id="show-search">Mostra ricerca</span>
    <span id="hide-search">Nascondi ricerca</span>
  </div>
  <div id="search-column" class="col-md-3">
      <?php
            $this->renderPartial('/site/filters',$this->filterModel);
        ?>
  </div>
  <div class="max-column">
      <?php echo $content; ?>
  </div>
</div>
<?php $this->endContent(); ?>