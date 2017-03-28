
<h1>品牌回收站</h1>
<?php
echo \yii\bootstrap\Html::a('品牌首页',['brand/index'],['class'=>'btn btn-info']);
?>
<table class="table table-bordered table-hover" >
    <tr>
        <th>ID</th>
        <th>名称</th>
        <th>LOGO</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    <?php foreach($models as $model):?>
        <tr>
            <td><?=$model->id?></td>
            <td><?=$model->name?></td>
            <td><?=\yii\bootstrap\Html::img('@web'.$model->logo,['style'=>'max-height:30px'])?></td>
            <td><?=\backend\models\Brand::$statuses[$model->status]?></td>
            <td>
                <?php echo \yii\bootstrap\Html::a('还原',['brand/restore','id'=>$model->id],['class'=>'btn btn-success'])?>
                <?php echo \yii\bootstrap\Html::a('删除',['brand/delete','id'=>$model->id],['class'=>'btn btn-danger'])?>
            </td>
        </tr>
    <?php endforeach;?>
</table>
