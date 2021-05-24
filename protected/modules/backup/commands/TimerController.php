<?php
namespace app\modules\backup\commands;

use app\modules\backup\helpers\MysqlBackup;
use app\components\TConsoleController;

class TimerController extends TConsoleController
{

    public $forced = false;

    public function options($actionID)
    {
        return [
            'forced'
        ];
    }

    public function optionAliases()
    {
        return [
            'f' => 'forced'
        ];
    }

    private $backup_files;

    /*
     * Index will automate everything once configured in console.php.
     *
     */
    public function actionIndex()
    {
        // will count number of files
        $files = $this->getFileList('*.zip');

        $totalFileAmount = count($files);
        self::log("Currently Total files in Folder: " . $totalFileAmount);
        $this->removeFiles($files);
        $this->create($this->forced);
    }

    public function removeFiles($files)
    {
        $max_files = $this->module->max_files;

        foreach ($files as $i => $rem) {
            $filename = DB_BACKUP_FILE_PATH . $rem;
            if ($i <= $max_files) {
                continue;
            }
            if (file_exists($filename)) {
                unlink($filename);
            }
        }

        return $max_files;
    }

    public function create($force = false)
    {
        $sql = new MysqlBackup();
        $settings = \Yii::$app->settings;
        $backup_interval = $settings->getValue('db_backup', '1');
        $last_backup = $settings->getValue('last_backup', '2017-10-10');
        $last_backup_time = strtotime($last_backup);
        $next_backup_time = strtotime("+" . $backup_interval . "days", $last_backup_time);
        self::log(__FUNCTION__ . ":last_backup_time = $last_backup_time  and next_backup_time=$next_backup_time");
        if ($force || time() >= $next_backup_time) {
            $settings->setValue('last_backup', date("Y-m-d H:i:s"));
            $sqlFile = $sql->fullBackup();
            self::log(__FUNCTION__ . ":Finished : " . $sqlFile);
            return $sqlFile;
        }
    }

    protected function getFileList($ext = '*.sql', $count = false)
    {
        $sql = new MysqlBackup();
        $path = $sql->getPath();
        $list = [];
        $list_files = glob($path . $ext);
        if ($count) {
            return count($list_files);
        }
        usort($list_files, function ($a, $b) {
            return filemtime($a) - filemtime($b);
        });

        if ($list_files) {
            $list = array_map('basename', $list_files);
            // sort($list);
        }
        return $list;
    }
}
