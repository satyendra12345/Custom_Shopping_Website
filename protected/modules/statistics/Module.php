<?php
namespace app\modules\statistics;

use app\components\TModule;
use app\components\TController;

/**
 * statistics module definition class
 */
class Module extends TModule
{

    const NAME = 'statistics';

    /**
     *
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public static function subNav()
    {
        return TController::addMenu(\Yii::t('app', 'Statistics'), '#', 'bar-chart ', Module::isAdmin(), [
            TController::addMenu(\Yii::t('app', 'Home'), '//statistics/dashboard/home', 'lock', Module::isAdmin())
        ]);
    }

    public static function dbFile()
    {
        return __DIR__ . '/db/install.sql';
    }
}
