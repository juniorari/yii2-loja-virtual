<?php

use yii\db\Migration;

/**
 * Class m191125_173817_create_users
 */
class m191125_173817_create_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $user = new \common\models\User();
        $user->username = 'admin';
        $user->email = 'juniorari@yahoo.com.br';
        $user->level = 10;
        $user->setPassword('admin123');
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->save(false);


        $user = new \common\models\User();
        $user->username = 'usuario';
        $user->email = 'joseari.jr@gmail.com';
        $user->level = 1;
        $user->setPassword('user123');
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->save(false);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //echo "m191125_173817_create_users cannot be reverted.\n";
        return true;
    }

}
