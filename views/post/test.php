<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<h1>Test Action</h1>

<?php if (Yii::$app-> session->hasFlash('success') ): ?>            <!-- hasFlash() проверяем есть ли в сессии Флеш сообщение с ключом  'success' -->
    <?php echo Yii::$app->session->getFlash('success'); ?>
<?php endif; ?>

<?php if (Yii::$app-> session->hasFlash('error') ): ?>
    <?php echo Yii::$app->session->getFlash('error'); ?>          <!-- getFlash() Дергаем из сессии ФлешСообщение с ключом  'error' -->
<?php endif; ?>

<?php $form = ActiveForm::begin(['options' => ['id' => 'testForm']]) ?>       <!-- В форму можем передавать массив параметров -->
<?= $form->field($model, 'name')->label('Имя') ?>
<?= $form->field($model, 'email')->input('email') ?>
<?= $form->field($model, 'text')->label('Текст сообщения')->textarea(['rows' => 5]) ?>
<?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
<?php $form::end()?> 