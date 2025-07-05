<?php
/** User: Shenoda */
/** @var $this \shenoda\phpmvc\View */

/** @var $model \app\models\ContactForm */

use shenoda\phpmvc\form\TextareaField;

$this->title = 'Contact';
?>
    <h1 style="color: #333; text-align: center; margin-bottom: 30px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        Contact Us</h1>

<?php $form = \shenoda\phpmvc\form\Form::begin('', 'post'); ?>
<?php echo $form->field($model, 'subject'); ?>
<?php echo $form->field($model, 'email'); ?>
<?php echo new TextareaField($model, 'body') ?>
    <button type="submit" class="btn btn-primary">
        Submit
    </button>
<?php echo \shenoda\phpmvc\form\Form::end(); ?>