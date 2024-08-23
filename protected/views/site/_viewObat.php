<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo (CHtml::encode($data->id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('nama_obat')); ?>:</b>
    <?php echo CHtml::encode($data->nama_obat); ?>
    <br />

    <?php if(Yii::app()->user->role === 'master'): ?>
        <?php echo CHtml::link('Update', array('site/updateObat', 'id'=>$data->id)); ?>
        <?php echo CHtml::link('Delete', array('site/deleteObat', 'id'=>$data->id), array(
            'submit'=>array('site/deleteObat', 'id'=>$data->id),
            'confirm'=>'Are you sure you want to delete this item?',
        )); ?>
    <?php endif; ?>

    
    
</div>
