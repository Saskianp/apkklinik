<h1>Create New User</h1>

<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($model); ?>

<div>
    <?php echo CHtml::activeLabel($model, 'username'); ?>
    <?php echo CHtml::activeTextField($model, 'username'); ?>
</div>

<div>
    <?php echo CHtml::activeLabel($model, 'password'); ?>
    <?php echo CHtml::activePasswordField($model, 'password'); ?>
</div>

<div>
    <?php echo CHtml::activeLabel($model, 'email'); ?>
    <?php echo CHtml::activeTextField($model, 'email'); ?>
</div>

<div>
    <?php echo CHtml::activeLabel($model, 'role'); ?>
    <?php echo CHtml::activeDropDownList($model, 'role', array('master' => 'Master','pegawai' => 'Pegawai', 'user' => 'User')); ?>
</div>

<div>
    <?php echo CHtml::submitButton('Create'); ?>
</div>

<?php echo CHtml::endForm(); ?>
