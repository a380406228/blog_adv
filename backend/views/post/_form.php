<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Poststatus;
use common\models\Adminuser;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>

    <!--
    <?= $form->field($model, 'status')->textInput() ?>
    -->
    <!-- hardcode硬编码
    <?= $form->field($model, 'status')->dropDownList([1=>'草稿', 2=>'已发布'], ['prompt'=>'请选择状态']); ?>
    -->
    <?php
    /*
    $psObjs = Poststatus::find()->all();
    $allStatus = ArrayHelper::map($psObjs, 'id', 'name');
    */
    // 方法3：查询构建器
    /*
    $allStatus = (new \yii\db\Query())
    ->select(['name', 'id'])
    ->from('poststatus')
    ->indexBy('id')
    ->column();
    */

    // 方法4：AR find方法
    /*
    $allStatus = Poststatus::find()
    ->select(['name', 'id'])
    ->orderBy('position')
    ->indexBy('id')
    ->column();
    */

    /*
    echo "<hr><pre>";
    print_r($allStatus);
    echo "</pre>";
    exit(0);
    */

    
    /*
    $allStatus = Poststatus::find()
    ->select(['id', 'email'])
    ->
    */

    ?>
    <?= $form->field($model, 'status')->dropDownList(
    Poststatus::find()
    ->select(['name', 'id'])
    ->orderBy('position')
    ->indexBy('id')
    ->column(), ['prompt'=>'请选择状态']); ?>

    <!--
    <?= $form->field($model, 'create_time')->textInput() ?>
    <?= $form->field($model, 'update_time')->textInput() ?>
    -->

    <?= $form->field($model, 'author_id')->dropDownList(
    Adminuser::find()
    ->select(['nickname', 'id'])
    ->indexBy('id')
    ->column(), ['prompt'=>'请选择作者']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
