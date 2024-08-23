<?php
$this->breadcrumbs=array(
    'Obat',
);
?>

<h1>Obat</h1>

<?php if(Yii::app()->user->role === 'master'): ?>
    <?php echo CHtml::link('Create Obat', array('site/createObat')); ?>
<?php endif; ?>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_viewObat',
)); ?>
