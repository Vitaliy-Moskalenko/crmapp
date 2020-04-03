<?php

use app\models\customer\CustomerRecord;
use app\models\customer\PhoneRecord;
use yii\web\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* Add Customer UI.
*
* @var View $this
* @var CustomerRecord $customer
* @var PhoneRecord $phone
*/
$form = ActiveForm::begin([
	'id' => 'add-customer-form',
] );

?>

	<div class="container">	
		<h1>Добавить контакт</h1>

		<?= $form->errorSummary([$customer, $phone]) ?>
		<?= $form->field($customer, 'name') ?>
		<?= $form->field($customer, 'birth_date') ?>
		<?= $form->field($customer, 'notes' ) ?>
		<?= $form->field($phone,    'number') ?>

		<?= Html::submitButton( 'Add Contact', ['class' => 'btn btn-primary']) ?>

	</div>
		
<?php ActiveForm::end(); ?>