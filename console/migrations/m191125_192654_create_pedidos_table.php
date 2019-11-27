<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pedidos}}`.
 */
class m191125_192654_create_pedidos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pedidos}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->null(),
            'nome' => $this->string(),
            'endereco' => $this->string()->null(),
            'bairro' => $this->string()->null(),
            'cidade' => $this->string()->null(),
            'estado' => $this->string(2)->null(),
            'telefone' => $this->string()->null(),
            'email' => $this->string()->null(),
            'comentario' => $this->text()->null(),
            'valor_total' => $this->money(10,2)->null(),
            'pago' => $this->smallInteger()->notNull()->defaultValue(0),
            'confirmado' => $this->smallInteger()->notNull()->defaultValue(0),
            'data_pedido' => $this->dateTime()->notNull(),
        ]);


        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-pedidos-user_id}}',
            '{{%pedidos}}',
            'user_id'
        );

        // add foreign key for table `{{%pedidos}}`
        $this->addForeignKey(
            '{{%fk-pedidos-user_id}}',
            '{{%pedidos}}',
            'user_id',
            '{{%user}}',
            'id',
            null
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pedidos}}');
    }
}
