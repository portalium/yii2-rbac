<?php
use yii\db\Migration;

class m010101_010105_rbac extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;

        $settings = yii\helpers\ArrayHelper::map(portalium\site\models\Setting::find()->asArray()->all(), 'name', 'value');
        $role = 'admin';
        $admin = (isset($role) && $role != '') ? $auth->getRole($role) : $auth->getRole('admin');

        $auth->remove($auth->getPermission("setRole"));
        $auth->remove($auth->getPermission("setAssignment"));
        $auth->remove($auth->getPermission("setPermission"));

        $rbacWebAssignmentView = $auth->createPermission('rbacWebAssignmentView');
        $rbacWebAssignmentView->description = 'View rbac assignment';
        $auth->add($rbacWebAssignmentView);
        $auth->addChild($admin, $rbacWebAssignmentView);

        $rbacWebAssignmentAssign = $auth->createPermission('rbacWebAssignmentAssign');
        $rbacWebAssignmentAssign->description = 'Assign rbac assignment';
        $auth->add($rbacWebAssignmentAssign);
        $auth->addChild($admin, $rbacWebAssignmentAssign);

        $rbacWebAssignmentRevoke = $auth->createPermission('rbacWebAssignmentRevoke');
        $rbacWebAssignmentRevoke->description = 'Revoke rbac assignment';
        $auth->add($rbacWebAssignmentRevoke);
        $auth->addChild($admin, $rbacWebAssignmentRevoke);

        $rbacWebBulkAssignmentIndex = $auth->createPermission('rbacWebBulkAssignmentIndex');
        $rbacWebBulkAssignmentIndex->description = 'View bulk assignment';
        $auth->add($rbacWebBulkAssignmentIndex);
        $auth->addChild($admin, $rbacWebBulkAssignmentIndex);

        $rbacWebBulkAssignmentAssign = $auth->createPermission('rbacWebBulkAssignmentAssign');
        $rbacWebBulkAssignmentAssign->description = 'Assign bulk assignment';
        $auth->add($rbacWebBulkAssignmentAssign);
        $auth->addChild($admin, $rbacWebBulkAssignmentAssign);

        $rbacWebBulkAssignmentRevoke = $auth->createPermission('rbacWebBulkAssignmentRevoke');
        $rbacWebBulkAssignmentRevoke->description = 'Revoke bulk assignment';
        $auth->add($rbacWebBulkAssignmentRevoke);
        $auth->addChild($admin, $rbacWebBulkAssignmentRevoke);

        $rbacWebPermissionViewPath = $auth->createPermission('rbacWebPermissionViewPath');
        $rbacWebPermissionViewPath->description = 'View permission path';
        $auth->add($rbacWebPermissionViewPath);
        $auth->addChild($admin, $rbacWebPermissionViewPath);

    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->remove($auth->getPermission('rbacApiDefaultAssignmentView'));
        $auth->remove($auth->getPermission('rbacApiDefaultAssignmentAssign'));
        $auth->remove($auth->getPermission('rbacApiDefaultAssignmentRevoke'));
        $auth->remove($auth->getPermission('rbacApiBulkAssignmentIndex'));
        $auth->remove($auth->getPermission('rbacApiBulkAssignmentAssign'));
        $auth->remove($auth->getPermission('rbacApiBulkAssignmentRevoke'));
        $auth->remove($auth->getPermission('rbacApiPermissionViewPath'));

    }
}
