<?php
$this->breadcrumbs=array(
    'Tindakan',
);
?>

<h1>Tindakan</h1>

<?php if(Yii::app()->user->role !== 'user'): ?>
    <?php echo CHtml::link('Create Tindakan', array('site/createTindakan')); ?>
<?php endif; ?>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_viewTindakan',
)); ?>
