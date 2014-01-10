<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row-fluid">
<div class="span12">
    <div class="span4">
            <div id="sidebar">
            <?php
            $this->renderPartial('/site/filters',$this->filterModel);
            ?>
            </div><!-- sidebar -->
    </div>
    <div class="span8 last">
            <div id="content">
                    <?php echo $content; ?>
            </div><!-- content -->
    </div>
</div>
</div>
<?php $this->endContent(); ?>