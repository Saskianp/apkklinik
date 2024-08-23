<?php
$this->breadcrumbs = array('User');
?>

<h1>User</h1>

<?php if(Yii::app()->user->role === 'master'): ?>
    <?php echo CHtml::link('Create New User', array('site/createUser')); ?>
<?php endif; ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'columns' => array(
        'id',
        'username',
        'email',
        'role',
        array(
            'class' => 'CButtonColumn',
            'template'=> (Yii::app()->user->role === 'master') ? '{update}{delete}' : '',
            'buttons' => array(
                'update' => array(
                    'label' => 'Edit',
                    'url' => 'Yii::app()->createUrl("site/updateUser", array("id"=>$data->id))',
                ),
                'delete' => array(
                    'label' => 'Delete',
                    'url' => 'Yii::app()->createUrl("site/deleteUser", array("id"=>$data->id))',
                    'click' => 'function(){return confirm("Are you sure you want to delete this item?");}',
                    'options' => array('csrf' => true, 'post' => true),
                ),
            ),
        ),
    ),
)); ?>

