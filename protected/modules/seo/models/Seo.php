<?php

namespace app\modules\seo\models;

use Yii;
use yii\helpers\Inflector;

/**
 * This is the model class for table "tbl_seo".
 *
 * @property integer $id
 * @property string $route
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property string $data
 * @property string $created_on
 * @property string $updated_on
 *
 */
class Seo extends \app\components\TActiveRecord
{

    public function __toString()
    {
        return (string) $this->title;
    }

    public function beforeValidate()
    {
        if ($this->isNewRecord) {
            if (! isset($this->created_on))
                $this->created_on = date('Y-m-d H:i:s');
            if (! isset($this->updated_on))
                $this->updated_on = date('Y-m-d H:i:s');
        } else {
            $this->updated_on = date('Y-m-d H:i:s');
        }
        return parent::beforeValidate();
    }

    /**
     *
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%seo}}';
    }

    /**
     *
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'created_on',
                    'route'
                    // 'title',
                    // 'keywords',
                    // 'description',
                    // 'data'
                ],
                'required'
            ],
            [
                [
                    'created_on',
                    'updated_on',
                    'relative_url'
                ],
                'safe'
            ],
            [
                [
                    'route',
                    'title',
                    'keywords',
                    'description',
                    'data'
                ],
                'string',
                'max' => 255
            ]
        ];
    }

    /**
     *
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'route' => Yii::t('app', 'Route'),
            'relative_url' => Yii::t('app', 'Relative Url'),
            'title' => Yii::t('app', 'Title'),
            'keywords' => Yii::t('app', 'Keywords'),
            'description' => Yii::t('app', 'Description'),
            'data' => Yii::t('app', 'Data'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_on' => Yii::t('app', 'Updated On')
        ];
    }

    public static function getHasManyRelations()
    {
        $relations = [];
        return $relations;
    }

    public static function getHasOneRelations()
    {
        $relations = [];
        return $relations;
    }

    public function beforeDelete()
    {
        if (! parent::beforeDelete()) {
            return false;
        }
        return true;
    }

    public function getControllerID()
    {
        $admin = '';
        if (method_exists("\app\components\WebUser", 'getIsAdminMode'))
            if (Yii::$app->user->isAdminMode)
                $admin = '/admin';
        $class = 'seo';
        return Inflector::camel2id($class) . $admin;
    }

    // to manage module's url
    public function getUrl($action = 'view', $id = NULL)
    {
        $params = [
            $this->getControllerID() . '/' . 'manager' . '/' . $action
        ];
        // VarDumper::dump($params);exit;
        $params['id'] = $this->id;

        // add the title parameter to the URL
        if ($this->hasAttribute('title'))
            $params['title'] = $this->title;
        else
            $params['title'] = (string) $this;

        return Yii::$app->getUrlManager()->createAbsoluteUrl($params, true);
    }

    public function asJson($with_relations = false)
    {
        $json = [];
        $json['id'] = $this->id;
        $json['route'] = $this->route;
        $json['title'] = $this->title;
        $json['keywords'] = $this->keywords;
        $json['description'] = $this->description;
        $json['data'] = $this->data;
        $json['created_on'] = $this->created_on;
        if ($with_relations) {}
        return $json;
    }

    public static function findByRoute($route, $url = null)
    {
        $model = null;
        if ($url != null) {
            $model = self::find()->where([
                'relative_url' => $url
            ])->one();
        }

        if ($model == null) {
            $model = self::find()->where([
                'like',
                'route',
                $route
            ])->one();
        }

        return $model;
    }

    public static function getMeta($model, $controller, $action, $url = null)
    {
        if ($url != null) {
            $seo = self::find()->where([
                'relative_url' => $url
            ])->one();
            if ($seo != null) {
                return $seo;
            }
        }

        if ($model != null && isset($model->id)) {
            $seo = self::findByRoute($controller . '/' . $action . '/' . $model->id);
        } else {
            $seo = self::findByRoute($controller . '/' . $action);
        }

        return $seo;
    }

    public static function addAnalyticsCode()
    {
        $model = Analytics::findActive()->all();

        if (empty($model)) {
            return;
        }
        foreach ($model as $data) {
            if ($data->type_id == Analytics::TYPE_GOOGLE) {
                \Yii::$app->getView()->registerJsFile('https://www.googletagmanager.com/gtag/js?id=' . $data->account);

                $js = "
                
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', '{$data->account}');";

                \Yii::$app->getView()->registerJs($js, \yii\web\View::POS_END, 'google-analytics-code');
            }
        }
    }
}