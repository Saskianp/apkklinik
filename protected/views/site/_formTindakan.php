<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($model); ?>

<div class="row">
    <?php echo CHtml::activeLabel($model, 'nama_tindakan'); ?>
    <?php echo CHtml::activeTextField($model, 'nama_tindakan'); ?>
</div>

<div class="row">
    <?php echo CHtml::activeLabel($model, 'obat_id'); ?>
    <?php echo CHtml::activeDropDownList($model, 'obat_id', CHtml::listData(Obat::model()->findAll(), 'id', 'nama_obat')); ?>
</div>

<div class="row buttons">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
</div>

<?php echo CHtml::endForm(); ?>
