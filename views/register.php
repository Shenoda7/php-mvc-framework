<?php
/** @var $model \app\models\User */
?>

<h1 style="color: #333; text-align: center; margin-bottom: 30px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    Create an Account</h1>

<?php $form = shenoda\phpmvc\form\Form::begin('', "post"); ?>

<div class="row">
    <div class="col">
        <?php echo $form->field($model, 'firstname'); ?>
    </div>
    <div class="col">
        <?php echo $form->field($model, 'lastname'); ?>
    </div>
</div>

<?php echo $form->field($model, 'email'); ?>
<?php echo $form->field($model, 'password')->passwordField(); ?>
<?php echo $form->field($model, 'confirmPassword')->passwordField(); ?>

<button type="submit" class="btn btn-primary">
    Submit
</button>
<?php echo \shenoda\phpmvc\form\Form::end(); ?>


