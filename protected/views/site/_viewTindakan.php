<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo (CHtml::encode($data->id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('nama_tindakan')); ?>:</b>
    <?php echo CHtml::encode($data->nama_tindakan); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('obat_id')); ?>:</b>
    <?php echo CHtml::encode($data->obat->nama_obat); ?>
    <br />

    <?php if(Yii::app()->user->role === 'master'): ?>
        <?php echo CHtml::link('Update', array('site/updateTindakan', 'id'=>$data->id)); ?>
        <?php echo CHtml::link('Delete', array('site/deleteTindakan', 'id'=>$data->id), array(
        'submit'=>array('site/deleteTindakan', 'id'=>$data->id),
        'confirm'=>'Are you sure you want to delete this item?',
        )); ?>
    <?php endif; ?>
    
</div>
