
<h1>品牌列表</h1>
<?php
echo \yii\bootstrap\Html::a('添加品牌',['brand/add'],['class'=>'btn btn-info']);
echo \yii\bootstrap\Html::a('回收站',['brand/recycle'],['class'=>'btn btn-danger']);
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
                <?php echo \yii\bootstrap\Html::a('编辑',['brand/edit','id'=>$model->id],['class'=>'btn btn-success'])?>
                <?php echo \yii\bootstrap\Html::a('删除',['brand/hide','id'=>$model->id],['class'=>'btn btn-danger'])?>
            </td>
        </tr>
    <?php endforeach;?>
</table>
<?php
echo \yii\widgets\LinkPager::widget([
    'pagination'=>$pager,
    'nextPageLabel'=>'下一页',
    'prevPageLabel'=>'上一页',
]);
