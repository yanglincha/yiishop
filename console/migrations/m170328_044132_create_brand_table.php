<?php

use yii\db\Migration;

/**
 * Handles the creation of table `brand`.
 */
class m170328_044132_create_brand_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('brand', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(50)->notNull()->comment('名称'),
            'intro'=> $this->text()->comment('简介'),
            'logo'=> $this->string()->notNull()->comment('LOGO'),
            'sort'=>$this->integer()->notNull()->comment('排序'),
            'status'=> $this->integer()->notNull()->comment('状态'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('brand');
    }
}
