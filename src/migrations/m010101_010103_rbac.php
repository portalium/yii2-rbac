<?php
use yii\db\Migration;

class m010101_010103_rbac extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;

        // add "setRole" permission
        $setRole = $auth->createPermission('setRole');
        $setRole->description = 'Set a Role';
        $auth->add($setRole);

        // add "setAssignment" permission
        $setAssignment = $auth->createPermission('setAssignment');
        $setAssignment->description = 'Set Assignment';
        $auth->add($setAssignment);

        // add "setPermission" permission
        $setPermission = $auth->createPermission('setPermission');
        $setPermission->description = 'Set Permission';
        $auth->add($setPermission);


        $admin=$auth->getRole("admin");
        $auth->addChild($admin, $setRole);
        $auth->addChild($admin, $setAssignment);
        $auth->addChild($admin, $setPermission);

    }

    public function down()
    {
        $auth = Yii::$app->authManager;
        $auth->remove($auth->getPermission("setRole"));
        $auth->remove($auth->getPermission("setAssignment"));
        $auth->remove($auth->getPermission("setPermission"));
        $auth->remove($auth->getRole("admin"));

    }
}
