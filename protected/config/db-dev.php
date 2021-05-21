<?php

				return [

				'class' => 'yii\db\Connection',

				'dsn' => 'mysql:host=127.0.0.1;dbname=custom_ainehome',

				'emulatePrepare' => true,

				'username' => 'root',

				'password' => '',

				'charset' => 'utf8mb4',

				'tablePrefix' => 'tbl_',

				'attributes' => [PDO::ATTR_CASE => PDO::CASE_LOWER],



                // 'enableSchemaCache' => 1 ,

                // 'schemaCacheDuration' => 3600,

                // 'schemaCache' => 'cache',

				];