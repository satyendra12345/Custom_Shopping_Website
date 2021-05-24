<?php

namespace app\modules\seo\models;

use Yii;
use app\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use app\models\Feed;
/**
 * This is the model class for table "tbl_seo_redirect".
 *
 * @property integer $id
 * @property string $old_url
 * @property string $new_url
 * @property integer $state_id
 * @property integer $type_id
 * @property string $created_on
 * @property string $updated_on
 * @property integer $created_by_id
 
 * === Related data ===
 * @property User $createdBy
 */
class Redirect extends \app\components\TActiveRecord
{

    public function __toString()
    {
        return (string) $this->old_url;
    }

    const STATE_INACTIVE = 0;

    const STATE_ACTIVE = 1;

    const STATE_DELETED = 2;

    public static function getStateOptions()
    {
        return [
            self::STATE_INACTIVE => "New",
            self::STATE_ACTIVE => "Active",
            self::STATE_DELETED => "Deleted"
        ];
    }

    public function getState()
    {
        $list = self::getStateOptions();
        return isset($list[$this->state_id]) ? $list[$this->state_id] : 'Not Defined';
    }

    public function getStateBadge()
    {
        $list = [
            self::STATE_INACTIVE => "primary",
            self::STATE_ACTIVE => "success",
            self::STATE_DELETED => "danger"
        ];
        return isset($list[$this->state_id]) ? \yii\helpers\Html::tag('span', $this->getState(), [
            'class' => 'badge badge-' . $list[$this->state_id]
        ]) : 'Not Defined';
    }

    public static function getTypeOptions()
    {
        return [
            "TYPE1",
            "TYPE2",
            "TYPE3"
        ];
        // return ArrayHelper::Map ( Type::findActive ()->all (), 'id', 'title' );
    }

    public function getType()
    {
        $list = self::getTypeOptions();
        return isset($list[$this->type_id]) ? $list[$this->type_id] : 'Not Defined';
    }

    public function beforeValidate()
    {
        if ($this->isNewRecord) {
            if (! isset($this->created_on))
                $this->created_on = date('Y-m-d H:i:s');
            if (! isset($this->updated_on))
                $this->updated_on = date('Y-m-d H:i:s');
            if (! isset($this->created_by_id))
                $this->created_by_id = self::getCurrentUser();
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
        return '{{%seo_redirect}}';
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
                    'old_url',
                    'new_url',
                    'created_on',
                    'created_by_id'
                ],
                'required'
            ],
            [
                [
                    'state_id',
                    'type_id',
                    'created_by_id'
                ],
                'integer'
            ],
            [
                [
                    'created_on',
                    'updated_on'
                ],
                'safe'
            ],
            [
                [
                    'old_url',
                    'new_url'
                ],
                'string',
                'max' => 255
            ],
            [
                [
                    'created_by_id'
                ],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => [
                    'created_by_id' => 'id'
                ]
            ],
            [
                [
                    'old_url',
                    'new_url'
                ],
                'trim'
            ],
            [
                [
                    'state_id'
                ],
                'in',
                'range' => array_keys(self::getStateOptions())
            ],
            [
                [
                    'type_id'
                ],
                'in',
                'range' => array_keys(self::getTypeOptions())
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
            'old_url' => Yii::t('app', 'Old Url'),
            'new_url' => Yii::t('app', 'New Url'),
            'state_id' => Yii::t('app', 'State'),
            'type_id' => Yii::t('app', 'Type'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'created_by_id' => Yii::t('app', 'Created By')
        ];
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, [
            'id' => 'created_by_id'
        ]);
    }

    public static function getHasManyRelations()
    {
        $relations = [];
        $relations['id'] = [
            'feeds',
            'Feed',
            'model_id'
        ];
        return $relations;
    }

    public static function getHasOneRelations()
    {
        $relations = [];
        
        $relations['created_by_id'] = [
            'createdBy',
            'User',
            'id'
        ];
        return $relations;
    }

    public function getFeeds()
    {
        return $this->hasMany(Feed::class, [
            'model_id' => 'id'
        ])->andWhere([
            'model_type' => self::class
        ]);
    }

    public function beforeDelete()
    {
        if (! parent::beforeDelete()) {
            return false;
        }
        return true;
    }

    public function asJson($with_relations = false)
    {
        $json = [];
        $json['id'] = $this->id;
        $json['old_url'] = $this->old_url;
        $json['new_url'] = $this->new_url;
        $json['state_id'] = $this->state_id;
        $json['type_id'] = $this->type_id;
        $json['created_on'] = $this->created_on;
        $json['created_by_id'] = $this->created_by_id;
        if ($with_relations) {
            // createdBy
            $list = $this->createdBy;
            
            if (is_array($list)) {
                $relationData = [];
                foreach ($list as $item) {
                    $relationData[] = $item->asJson();
                }
                $json['createdBy'] = $relationData;
            } else {
                $json['CreatedBy'] = $list;
            }
        }
        return $json;
    }

    public function getUrl($action = 'view', $id = null)
    {
        $params = [
            '/seo/' . $this->getControllerID() . '/' . $action
        ];
        if ($id != null)
            $params['id'] = $id;
        else
            $params['id'] = $this->id;
        // add the title parameter to the URL
        if ($this->hasAttribute('title'))
            $params['title'] = $this->title;
        else
            $params['title'] = (string) $this;
        return Yii::$app->getUrlManager()->createAbsoluteUrl($params, true);
    }

    public static function check()
    {   
        $route = Yii::$app->request->url;
        
        $model = Redirect::findActive()->andWhere([
            'like',
            'old_url',
            $route
        ])->one();
        if (! empty($model)) {
            return \Yii::$app->controller->redirect([
                $model->new_url
            ]);
        }
    }
}
