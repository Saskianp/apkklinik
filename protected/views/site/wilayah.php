<?php
$this->breadcrumbs = array('Wilayah');
?>

<?php if(Yii::app()->user->role === 'master'): ?>
    <h2><?php echo $model->isNewRecord ? 'Create Wilayah' : 'Update Wilayah'; ?></h2>
    <?php echo $this->renderPartial('_formWilayah', array('model'=>$model)); ?>
<?php endif; ?>

<h2>Wilayah</h2>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        'id',
        'nama_wilayah',
        array(
            'class'=>'CButtonColumn',
            'template'=> (Yii::app()->user->role === 'master') ? '{update}{delete}' : '',
            'buttons'=>array(
                'update' => array(
                    'label'=>'Edit',
                    'url'=>'Yii::app()->createUrl("site/updateWilayah", array("id"=>$data->id))',
                ),
                'delete' => array(
                    'label' => 'Delete',
                    'url' => 'Yii::app()->createUrl("site/deleteWilayah", array("id"=>$data->id))',
                    'click' => 'function(){return confirm("Are you sure you want to delete this item?");}',
                    'options' => array('csrf' => true, 'post' => true),
                ),
            ),
        ),
    ),
)); ?>
