<?php
/** User: Shenoda */
/** @var $this \app\core\View */

/** @var $model \app\models\ContactForm */

use app\core\form\TextareaField;

$this->title = 'Contact';
?>
    <h1 style="color: #333; text-align: center; margin-bottom: 30px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        Contact Us</h1>

<?php $form = \app\core\form\Form::begin('', 'post'); ?>
<?php echo $form->field($model, 'subject'); ?>
<?php echo $form->field($model, 'email'); ?>
<?php echo new TextareaField($model, 'body') ?>
    <button type="submit" class="btn btn-primary">
        Submit
    </button>
<?php echo \app\core\form\Form::end(); ?>