<?php

use yii\db\Migration;

/**
 * Handles the creation of table `url_alias`.
 */
class m170704_011845_create_url_alias_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('url_alias', [
            'id' => $this->primaryKey(),
            'alias' => $this->string()->notNull(),
            'route' => $this->string()->notNull(),
            'params' => $this->string()->notNull()->defaultValue('a:0:{}'),
            'status' => $this->integer()->notNull()->defaultValue(1),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('url_alias');
    }
}
