<?php
/** @var $model \app\models\User */
?>

<h1 style="color: #333; text-align: center; margin-bottom: 30px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    Login</h1>

<?php $form = app\core\form\Form::begin('', "post"); ?>

<?php echo $form->field($model, 'email'); ?>
<?php echo $form->field($model, 'password')->passwordField(); ?>

<button type="submit" class="btn btn-primary">
    Submit
</button>
<?php echo \app\core\form\Form::end(); ?>


