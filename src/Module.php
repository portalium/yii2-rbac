<?php

namespace portalium\rbac;

class Module extends \portalium\base\Module
{
    public static $description = 'Rbac Management Module';
    public static $name = 'Rbac';

    public $apiRules = [
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => [
                'rbac/default',
            ]
        ],
    ];
    
    public static $tablePrefix = 'user_';
    public function getMenuItems(){
        $menuItems = [
            [
                [
                    'menu' => 'web',
                    'type' => 'action',
                    'route' => '/user/auth/role',
                ],
                [
                    'menu' => 'web',
                    'type' => 'action',
                    'route' => '/user/auth/permission',
                ],
            ],
        ];
        return $menuItems;
    }

    public static function moduleInit()
    {
        self::registerTranslation('rbac','@portalium/rbac/messages',[
            'rbac' => 'rbac.php',
        ]);
    }

    public static function t($message, array $params = [])
    {
        return parent::coreT('rbac', $message, $params);
    }
}