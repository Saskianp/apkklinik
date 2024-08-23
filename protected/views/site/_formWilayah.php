<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'wilayah-form',
    'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<div class="row">
    <?php echo $form->labelEx($model,'nama_wilayah'); ?>
    <?php echo $form->textField($model,'nama_wilayah',array('size'=>30,'maxlength'=>255)); ?>
    <?php echo $form->error($model,'nama_wilayah'); ?>    
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>

</div>

<?php $this->endWidget(); ?>
