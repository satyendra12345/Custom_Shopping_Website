# BACKUP

#### About Brief


## INSTALLATION 

## If you need to install single module 

Steps-
1. Go to ***htdocs*** or ***html*** folder.
2. Then, Go to your project->protected->modules and Open your terminal by ***ctrl+alt+t*** . 
3. Type ***git clone  http://192.168.10.21/yii2/modules/backup.git*** in your terminal. Wait till installation complete.
4. After clone run (project->protected->modules) this command ***php console.php installer/install/module -m=backup*** in termianl. Open your terminal by ***ctrl+alt+t*** .

> add below code in your .gitmodule file.

        [submodule "protected/modules/backup"]
        path = protected/modules/backup
        url = http://192.168.10.21/yii2/modules/backup.git

> add below code in web.php file, located at protected/config/web.php

        $config['modules']['backup'] = [
         'class' => 'app\modules\backup\Module'
        ];

> add module in side nav bar, located at protected/base/TBaseController.php

         if (yii::$app->hasModule('backup'))
                   $this->nav_left[] = \app\modules\backup\Module::subNav();

## During setup new project > you need to use these steps

Steps- 
1. Go to ***htdocs*** or ***html*** > you project .
2. 1st check  .gitmodule file blog module lines ( exists or not)

        [submodule "protected/modules/backup"]
        path = protected/modules/backup
        url = http://192.168.10.21/yii2/modules/backup.git

3. Then, run (in your project root)  ***bash ../scripts/clone-submodules.sh*** in your terminal.


## Automated Cleanup
If you want the system to automatically clear out old backups, you can configure `automated_cleanup`.

`automated_cleanup` defaults to false, and require a boolean values to be activated.

```php
    'modules' => [
    'backup' => [
        'class' => 'app\modules\backup\Module',
        'automated_cleanup' => true
        'max_files' => 20
    ]
],
```
When activated the cron method will delete all but the latest backup of the period before the previous period.

Lets look at an example:
If you run backups, but have configured `'automated_cleanup' => true`, the first cron job of a new day will delete all but the latest backup from the period before the previous day.

`'max_files' => 10` This will limit the number of files in the `protected/db` folder ,i.e if `'max_files' => 10` then folder will never create 
more than 10 files in it .





