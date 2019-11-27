<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pedidos_produtos}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%pedidos}}`
 * - `{{%produto}}`
 */
class m191125_193417_create_pedidos_produtos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pedidos_produtos}}', [
            'id' => $this->primaryKey(),
            'pedido_id' => $this->integer()->notNull(),
            'produto_id' => $this->integer()->notNull(),
            'quantidade' => $this->integer(),
            'confirmado' => $this->integer(),
        ]);

        // creates index for column `pedido_id`
        $this->createIndex(
            '{{%idx-pedidos_produtos-pedido_id}}',
            '{{%pedidos_produtos}}',
            'pedido_id'
        );

        // add foreign key for table `{{%pedidos}}`
        $this->addForeignKey(
            '{{%fk-pedidos_produtos-pedido_id}}',
            '{{%pedidos_produtos}}',
            'pedido_id',
            '{{%pedidos}}',
            'id',
            null
        );

        // creates index for column `produto_id`
        $this->createIndex(
            '{{%idx-pedidos_produtos-produto_id}}',
            '{{%pedidos_produtos}}',
            'produto_id'
        );

        // add foreign key for table `{{%produto}}`
        $this->addForeignKey(
            '{{%fk-pedidos_produtos-produto_id}}',
            '{{%pedidos_produtos}}',
            'produto_id',
            '{{%produtos}}',
            'id',
            null
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%pedidos}}`
        $this->dropForeignKey(
            '{{%fk-pedidos_produtos-pedido_id}}',
            '{{%pedidos_produtos}}'
        );

        // drops index for column `pedido_id`
        $this->dropIndex(
            '{{%idx-pedidos_produtos-pedido_id}}',
            '{{%pedidos_produtos}}'
        );

        // drops foreign key for table `{{%produto}}`
        $this->dropForeignKey(
            '{{%fk-pedidos_produtos-produto_id}}',
            '{{%pedidos_produtos}}'
        );

        // drops index for column `produto_id`
        $this->dropIndex(
            '{{%idx-pedidos_produtos-produto_id}}',
            '{{%pedidos_produtos}}'
        );

        $this->dropTable('{{%pedidos_produtos}}');
    }
}
