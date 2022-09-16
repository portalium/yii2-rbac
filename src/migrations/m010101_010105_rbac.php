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

        $RBACWebAssignmentView = $auth->createPermission('RBACWebAssignmentView');
        $RBACWebAssignmentView->description = 'View RBAC assignment';
        $auth->add($RBACWebAssignmentView);
        $auth->addChild($admin, $RBACWebAssignmentView);

        $RBACWebAssignmentAssign = $auth->createPermission('RBACWebAssignmentAssign');
        $RBACWebAssignmentAssign->description = 'Assign RBAC assignment';
        $auth->add($RBACWebAssignmentAssign);
        $auth->addChild($admin, $RBACWebAssignmentAssign);

        $RBACWebAssignmentRevoke = $auth->createPermission('RBACWebAssignmentRevoke');
        $RBACWebAssignmentRevoke->description = 'Revoke RBAC assignment';
        $auth->add($RBACWebAssignmentRevoke);
        $auth->addChild($admin, $RBACWebAssignmentRevoke);

        $RBACWebBulkAssignmentIndex = $auth->createPermission('RBACWebBulkAssignmentIndex');
        $RBACWebBulkAssignmentIndex->description = 'View bulk assignment';
        $auth->add($RBACWebBulkAssignmentIndex);
        $auth->addChild($admin, $RBACWebBulkAssignmentIndex);

        $RBACWebBulkAssignmentAssign = $auth->createPermission('RBACWebBulkAssignmentAssign');
        $RBACWebBulkAssignmentAssign->description = 'Assign bulk assignment';
        $auth->add($RBACWebBulkAssignmentAssign);
        $auth->addChild($admin, $RBACWebBulkAssignmentAssign);

        $RBACWebBulkAssignmentRevoke = $auth->createPermission('RBACWebBulkAssignmentRevoke');
        $RBACWebBulkAssignmentRevoke->description = 'Revoke bulk assignment';
        $auth->add($RBACWebBulkAssignmentRevoke);
        $auth->addChild($admin, $RBACWebBulkAssignmentRevoke);

        $RBACWebPermissionViewPath = $auth->createPermission('RBACWebPermissionViewPath');
        $RBACWebPermissionViewPath->description = 'View permission path';
        $auth->add($RBACWebPermissionViewPath);
        $auth->addChild($admin, $RBACWebPermissionViewPath);

    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->remove($auth->getPermission('RBACApiDefaultAssignmentView'));
        $auth->remove($auth->getPermission('RBACApiDefaultAssignmentAssign'));
        $auth->remove($auth->getPermission('RBACApiDefaultAssignmentRevoke'));
        $auth->remove($auth->getPermission('RBACApiBulkAssignmentIndex'));
        $auth->remove($auth->getPermission('RBACApiBulkAssignmentAssign'));
        $auth->remove($auth->getPermission('RBACApiBulkAssignmentRevoke'));
        $auth->remove($auth->getPermission('RBACApiPermissionViewPath'));

    }
}
