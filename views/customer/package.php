<?php

use app\models\Customer;
use app\models\CustomerPackage;
use app\models\Package;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/** @var View $this */
/** @var Customer $customerModel */
/** @var CustomerPackage[] $customerPackageModels */
/** @var Package[] $packages */

$this->title = 'Package Customer';
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-package">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="customer-package-form">

        <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($customerModel, 'name')->textInput(['disabled' => true, 'maxlength' => true]) ?>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>
                    <i class="glyphicon glyphicon-envelope"></i> Packages
                </h4>
            </div>
            <div class="panel-body">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                    'limit' => 4, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $customerPackageModels[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'full_name',
                        'address_line1',
                        'address_line2',
                        'city',
                        'state',
                        'postal_code',
                    ],
                ]); ?>

                <div class="container-items"><!-- widgetContainer -->
                <?php foreach ($customerPackageModels as $i => $customerPackageModel): ?>
                    <div class="item panel panel-default"><!-- widgetBody -->
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">Package</h3>
                            <div class="pull-right">
                                <button type="button" class="add-item btn btn-success btn-xs">
                                    <i class="glyphicon glyphicon-plus"></i>
                                    +
                                </button>
                                <button type="button" class="remove-item btn btn-danger btn-xs">
                                    <i class="glyphicon glyphicon-minus"></i>
                                    -
                                </button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                                // necessary for update action.
                                if (! $customerPackageModel->isNewRecord) {
                                    echo Html::activeHiddenInput($customerPackageModel, "[{$i}]id");
                                }
                            ?>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?= $form->field($customerPackageModel, "[{$i}]package_id")
                                    ->label($customerPackageModel->getAttributeLabel('package_name'))
                                    ->widget(Select2::class, [
                                        'data' => ArrayHelper::map($packages, 'id', 'name'),
                                        'options' => ['placeholder' => 'Select a package ...'],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                        'theme' => Select2::THEME_KRAJEE_BS4,
                                    ]) ?>
                                </div>
                                <div class="col-sm-4">
                                    <?= $form->field($customerPackageModel, "[{$i}]package_price")->textInput(['disabled' => true, 'maxlength' => true, 'type' => 'number']) ?>
                                </div>
                                <div class="col-sm-4">
                                    <?= $form->field($customerPackageModel, "[{$i}]quantity")->textInput(['maxlength' => true, 'type' => 'number']) ?>
                                </div>
                            </div><!-- .row -->
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
                <?php DynamicFormWidget::end(); ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton($customerPackageModel->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
