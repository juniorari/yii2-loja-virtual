<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%produtos}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%categorias}}`
 */
class m191125_184923_create_produtos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%produtos}}', [
            'id' => $this->primaryKey(),
            'categoria_id' => $this->integer()->notNull(),
            'nome' => $this->string(255)->notNull(),
            'descricao' => $this->text(),
            'preco' => $this->money(10,2)->notNull(),
            'quantidade' => $this->integer()->notNull()->defaultValue(0),
            'foto1' => $this->string(255)->null(),
            'foto2' => $this->string(255)->null(),
            'foto3' => $this->string(255)->null(),
            'foto4' => $this->string(255)->null(),
            'foto5' => $this->string(255)->null(),

        ]);

        // creates index for column `categoria_id`
        $this->createIndex(
            '{{%idx-produtos-categoria_id}}',
            '{{%produtos}}',
            'categoria_id'
        );

        // add foreign key for table `{{%categorias}}`
        $this->addForeignKey(
            '{{%fk-produtos-categoria_id}}',
            '{{%produtos}}',
            'categoria_id',
            '{{%categorias}}',
            'id',
            null
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%categorias}}`
        $this->dropForeignKey(
            '{{%fk-produtos-categoria_id}}',
            '{{%produtos}}'
        );

        // drops index for column `categoria_id`
        $this->dropIndex(
            '{{%idx-produtos-categoria_id}}',
            '{{%produtos}}'
        );

        $this->dropTable('{{%produtos}}');
    }
}
