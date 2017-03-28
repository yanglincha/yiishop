<?php

namespace backend\controllers;

use backend\models\Brand;
use yii\data\Pagination;
use yii\web\Request;
use yii\web\UploadedFile;
use xj\uploadify\UploadAction;

class BrandController extends \yii\web\Controller
{
    //品牌列表
    public function actionIndex()
    {
        $query = Brand::find()->where(['status'=>['0','1']]);
        //分页
        $pager = new Pagination([
            'totalCount'=>$query->count(),
            'pageSize'=>2,
        ]);
        $models = $query->limit($pager->limit)->offset($pager->offset)->all();
        return $this->render('index',['models'=>$models,'pager'=>$pager]);
    }
    //添加品牌
    public function actionAdd(){
        //实例化数据模型
        $model = new Brand();
        //使用request组件
        $request = new Request();
        if($request->isPost){
            $model->load($request->post());
            //$model->logo_file = UploadedFile::getInstance($model,'logo_file');
            if($model->validate()){
                //if($model->logo_file){
                    //$fileName = 'upload/brand/'.uniqid().'.'.$model->logo_file->extension;
                   // $model->logo_file->saveAs($fileName,false);
                    //$model->logo = $fileName;
                //}
                $model->save();
                \Yii::$app->session->setFlash('success','添加成功');
                return $this->redirect(['brand/index']);
            }
        }
        //分配数据
        return $this->render('add',['model'=>$model]);
    }
    //'删除'品牌  将品牌隐藏
    public function actionHide($id){
        //根据id查找一条数据  然后隐藏
        $model = Brand::findOne(['id'=>$id]);
        $model->status = '-1';
        $model->save(false);
        //成功后跳转到index页面
        \Yii::$app->session->setFlash('success','隐藏成功');
        return $this->redirect(['brand/index']);
    }
    public function actionEdit($id){
        //实例化数据模型
        $model = Brand::findOne(['id'=>$id]);
        //使用request组件
        $request = new Request();
        if($request->isPost){
            $model->load($request->post());
            //$model->logo_file = UploadedFile::getInstance($model,'logo_file');
            if($model->validate()){
//                if($model->logo_file){
//                    $fileName = 'upload/brand/'.uniqid().'.'.$model->logo_file->extension;
//                    $model->logo_file->saveAs($fileName,false);
//                    $model->logo = $fileName;
//                }
                $model->save(false);
                \Yii::$app->session->setFlash('success','添加成功');
                return $this->redirect(['brand/index']);
            }

        }
        //分配数据
        return $this->render('add',['model'=>$model]);
    }
    //删除记录
    public function actionDelete($id){
        $model = Brand::findOne(['id'=>$id]);
        $model->delete();
        \Yii::$app->session->setFlash('success','删除成功');
        return $this->redirect(['brand/recycle']);
    }
    //还原数据
    public function actionRestore($id){
        //根据id查找一条数据  然后还原
        $model = Brand::findOne(['id'=>$id]);
        $model->status = 1;
        $model->save(false);
        //成功后跳转到index页面
        \Yii::$app->session->setFlash('success','还原成功');
        return $this->redirect(['brand/index']);
    }
    //显示隐藏的数据
    public function actionRecycle(){
        $models = Brand::find()->where(['status'=>'-1'])->all();
        return $this->render('recycle',['models'=>$models]);
    }


    public function actions() {
        return [
            's-upload' => [
                'class' => UploadAction::className(),
                'basePath' => '@webroot/upload/brand',
                'baseUrl' => '@web/upload/brand',
                'enableCsrf' => true, // default
                'postFieldName' => 'Filedata', // default
                //BEGIN METHOD
                //'format' => [$this, 'methodName'],
                //END METHOD
                //BEGIN CLOSURE BY-HASH
                'overwriteIfExist' => true,
//                'format' => function (UploadAction $action) {
//                    $fileext = $action->uploadfile->getExtension();
//                    $filename = sha1_file($action->uploadfile->tempName);
//                    return "{$filename}.{$fileext}";
//                },
                //END CLOSURE BY-HASH
                //BEGIN CLOSURE BY TIME
                'format' => function (UploadAction $action) {
                    $fileext = $action->uploadfile->getExtension();
                    $filehash = sha1(uniqid() . time());
                    $p1 = substr($filehash, 0, 2);
                    $p2 = substr($filehash, 2, 2);
                    return "{$p1}/{$p2}/{$filehash}.{$fileext}";
                },
                //END CLOSURE BY TIME
                'validateOptions' => [
                    'extensions' => ['jpg', 'png','gif'],
                    'maxSize' => 1 * 1024 * 1024, //file size
                ],
                'beforeValidate' => function (UploadAction $action) {
                    //throw new Exception('test error');
                },
                'afterValidate' => function (UploadAction $action) {},
                'beforeSave' => function (UploadAction $action) {},
                'afterSave' => function (UploadAction $action) {
                    $action->output['fileUrl'] = $action->getWebUrl();
                    $action->getFilename(); // "image/yyyymmddtimerand.jpg"
                    $action->getWebUrl(); //  "baseUrl + filename, /upload/image/yyyymmddtimerand.jpg"
                    $action->getSavePath(); // "/var/www/htdocs/upload/image/yyyymmddtimerand.jpg"
                },
            ],
        ];
    }

}
