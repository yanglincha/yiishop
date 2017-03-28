<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_category`.
 */
class m170328_103953_create_article_category_table extends Migration
{
    /**
     * @inheritdoc
     * 文章类别 表
     */
    public function up()
    {
        $this->createTable('article_category', [
            'id' => $this->primaryKey()->notNull()->comment('ID'),
            'name'=>$this->string(50)->notNull()->comment('类别名称'),
            'intro'=>$this->text()->comment('简介'),
            'status'=>$this->integer()->notNull()->comment('状态'),
            'sort'=>$this->integer()->notNull()->comment('排序'),
            'is_help'=>$this->integer()->notNull()->comment('是否有帮助'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_category');
    }
}
