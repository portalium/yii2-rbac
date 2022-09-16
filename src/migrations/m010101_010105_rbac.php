<?php
use yii\db\Migration;

class m010101_010105_rbac extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;
        
        $settings = yii\helpers\ArrayHelper::map(portalium\site\models\Setting::find()->asArray()->all(),'name','value');
        $role = 'admin';
        $admin = (isset($role) && $role != '') ? $auth->getRole($role) : $auth->getRole('admin');


        $auth->remove($auth->getPermission("setRole"));
        $auth->remove($auth->getPermission("setAssignment"));
        $auth->remove($auth->getPermission("setPermission"));
        
        $userWebAssignmentView = $auth->createPermission('userWebAssignmentView');
        $userWebAssignmentView->description = 'View user assignment';
        $auth->add($userWebAssignmentView);
        $auth->addChild($admin, $userWebAssignmentView);

        $userWebAssignmentAssign = $auth->createPermission('userWebAssignmentAssign');
        $userWebAssignmentAssign->description = 'Assign user assignment';
        $auth->add($userWebAssignmentAssign);
        $auth->addChild($admin, $userWebAssignmentAssign);

        $userWebAssignmentRevoke = $auth->createPermission('userWebAssignmentRevoke');
        $userWebAssignmentRevoke->description = 'Revoke user assignment';
        $auth->add($userWebAssignmentRevoke);
        $auth->addChild($admin, $userWebAssignmentRevoke);

        $userWebBulkAssignmentIndex = $auth->createPermission('userWebBulkAssignmentIndex');
        $userWebBulkAssignmentIndex->description = 'View bulk assignment';
        $auth->add($userWebBulkAssignmentIndex);
        $auth->addChild($admin, $userWebBulkAssignmentIndex);

        $userWebBulkAssignmentAssign = $auth->createPermission('userWebBulkAssignmentAssign');
        $userWebBulkAssignmentAssign->description = 'Assign bulk assignment';
        $auth->add($userWebBulkAssignmentAssign);
        $auth->addChild($admin, $userWebBulkAssignmentAssign);

        $userWebBulkAssignmentRevoke = $auth->createPermission('userWebBulkAssignmentRevoke');
        $userWebBulkAssignmentRevoke->description = 'Revoke bulk assignment';
        $auth->add($userWebBulkAssignmentRevoke);
        $auth->addChild($admin, $userWebBulkAssignmentRevoke);

        $userWebPermissionViewPath = $auth->createPermission('userWebPermissionViewPath');
        $userWebPermissionViewPath->description = 'View permission path';
        $auth->add($userWebPermissionViewPath);
        $auth->addChild($admin, $userWebPermissionViewPath);

    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->remove($auth->getPermission('userApiDefaultAssignmentView'));
        $auth->remove($auth->getPermission('userApiDefaultAssignmentAssign'));
        $auth->remove($auth->getPermission('userApiDefaultAssignmentRevoke'));
        $auth->remove($auth->getPermission('userApiBulkAssignmentIndex'));
        $auth->remove($auth->getPermission('userApiBulkAssignmentAssign'));
        $auth->remove($auth->getPermission('userApiBulkAssignmentRevoke'));
        $auth->remove($auth->getPermission('userApiPermissionViewPath'));

    }
}