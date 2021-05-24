<?php


 



namespace app\models;



use Yii;

use app\models\Feed;

use app\models\User;

use app\models\Product;



use yii\helpers\ArrayHelper;





/**

* This is the model class for table "tbl_category".

*

    * @property integer $id

    * @property string $title

    * @property string $description

    * @property string $image_file

    * @property integer $state_id

    * @property integer $type_id

    * @property string $created_on

    * @property string $updated_on

    * @property integer $created_by_id



* === Related data ===

    * @property User $createdBy

    * @property Product[] $products

    */





class Category extends \app\components\TActiveRecord

{

	public  function __toString()

	{

		return (string)$this->title;

	}

	const STATE_INACTIVE 	= 0;

	const STATE_ACTIVE	 	= 1;

	const STATE_DELETED 	= 2;



	public static function getStateOptions()

	{

		return [

				self::STATE_INACTIVE		=> "New",

				self::STATE_ACTIVE 			=> "Active" ,

				self::STATE_DELETED 		=> "Deleted",

		];

	}

	public function getState()

	{

		$list = self::getStateOptions();

		return isset($list [$this->state_id])?$list [$this->state_id]:'Not Defined';



	}

	public function getStateBadge()

	{

		$list = [

				self::STATE_INACTIVE 		=> "secondary",

				self::STATE_ACTIVE 			=> "success" ,

				self::STATE_DELETED 		=> "danger",

		];

		return isset($list[$this->state_id])?\yii\helpers\Html::tag('span', $this->getState(), ['class' => 'badge badge-' . $list[$this->state_id]]):'Not Defined';

	}

    public static function getActionOptions()

    {

        return [

            self::STATE_INACTIVE => "Deactivate",

            self::STATE_ACTIVE => "Activate",

            self::STATE_DELETED => "Delete"

        ];

    }



		public static function getTypeOptions()

	{

		return ["TYPE1","TYPE2","TYPE3"];

				}



	 	public function getType()

	{

		$list = self::getTypeOptions();

		return isset($list [$this->type_id])?$list [$this->type_id]:'Not Defined';



	}

				public function beforeValidate()

	{

		if($this->isNewRecord)

		{

				if ( empty( $this->created_on )){ $this->created_on = date( 'Y-m-d H:i:s');}

				if ( empty( $this->updated_on )){ $this->updated_on = date( 'Y-m-d H:i:s');}

				if ( empty( $this->created_by_id )){ $this->created_by_id = self::getCurrentUser();

            }

			}else{

					$this->updated_on = date( 'Y-m-d H:i:s');

			}

		return parent::beforeValidate();

	}





	/**

	* @inheritdoc

	*/

	public static function tableName()

	{

		return '{{%category}}';

	}



	/**

	* @inheritdoc

	*/

	public function rules()

	{

		return [

            [['description'], 'required'],

            [['state_id', 'type_id', 'created_by_id'], 'integer'],

            [['created_on', 'updated_on'], 'safe'],

            [['title', 'description'], 'string', 'max' => 128],

            [['image_file'], 'string', 'max' => 255],

            [['created_by_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by_id' => 'id']],

            [['title', 'description', 'image_file'], 'trim'],

            [['image_file'],'file',

						'skipOnEmpty' => true,

						'extensions' => 'png, jpg,jpeg' ],

            [['state_id'], 'in', 'range' => array_keys(self::getStateOptions())],

            [['type_id'], 'in', 'range' => array_keys (self::getTypeOptions())]

        ];

	}



	/**

	* @inheritdoc

	*/





	public function attributeLabels()

	{

		return [

				    'id' => Yii::t('app', 'ID'),

				    'title' => Yii::t('app', 'Title'),

				    'description' => Yii::t('app', 'Description'),

				    'image_file' => Yii::t('app', 'Image File'),

				    'state_id' => Yii::t('app', 'State'),

				    'type_id' => Yii::t('app', 'Type'),

				    'created_on' => Yii::t('app', 'Created On'),

				    'updated_on' => Yii::t('app', 'Updated On'),

				    'created_by_id' => Yii::t('app', 'Created By'),

				];

	}



    /**

    * @return \yii\db\ActiveQuery

    */

    public function getCreatedBy()

    {

    	return $this->hasOne(User::className(), ['id' => 'created_by_id']);

    }



    /**

    * @return \yii\db\ActiveQuery

    */

    public function getProducts()

    {

    	return $this->hasMany(Product::className(), ['created_by_id' => 'id']);

    }

    public static function getHasManyRelations()

    {

    	$relations = [];



		$relations['Products'] = ['products','Product','id','created_by_id'];

    	$relations['feeds'] = [

            'feeds',

            'Feed',

            'model_id'

        ];

		return $relations;

	}

    public static function getHasOneRelations()

    {

    	$relations = [];

		$relations['created_by_id'] = ['createdBy','User','id'];

		return $relations;

	}



	public function beforeDelete() {

	    if (! parent::beforeDelete()) {

            return false;

        }

        //TODO : start here

		//Product::deleteRelatedAll(['created_by_id'=>$this->id]);

		return true;

	}

	

  	public function beforeSave($insert)

    {

        if (! parent::beforeSave($insert)) {

            return false;

        }

        //TODO : start here

        

        return true;

    }

    public function asJson($with_relations=false)

	{

		$json = [];

			$json['id'] 	= $this->id;

			$json['title'] 	= $this->title;

			$json['description'] 	= $this->description;

		if(isset($this->image_file))

			$json['image_file'] 	= \Yii::$app->createAbsoluteUrl('category/download',array('file'=>$this->image_file));

			$json['state_id'] 	= $this->state_id;

			$json['type_id'] 	= $this->type_id;

			$json['created_on'] 	= $this->created_on;

			$json['created_by_id'] 	= $this->created_by_id;

			if ($with_relations)

		    {

				// createdBy

				$list = $this->createdBy;



				if ( is_array($list))

				{

					$relationData = [];

					foreach( $list as $item)

					{

						$relationData [] 	= $item->asJson();

					}

					$json['createdBy'] 	= $relationData;

				}

				else

				{

					$json['createdBy'] 	= $list;

				}

				// products

				$list = $this->products;



				if ( is_array($list))

				{

					$relationData = [];

					foreach( $list as $item)

					{

						$relationData [] 	= $item->asJson();

					}

					$json['products'] 	= $relationData;

				}

				else

				{

					$json['products'] 	= $list;

				}

			}

		return $json;

	}

	

		

    public static function addTestData($count = 1)

    {

        $faker = \Faker\Factory::create();

        $states = array_keys(self::getStateOptions());

        for ($i = 0; $i < $count; $i ++) {

            $model = new self();

            $model->loadDefaultValues();

						$model->title = $faker->text(10);

			$model->description = $faker->text(10);

			$model->image_file = $faker->text(10);

			$model->state_id = $states[rand(0,count($states))];

			$model->type_id = 0;

        	$model->save();

        }

	}

    public static function addData($data)

    {

    	if (self::find()->count() != 0)

    	{

            return;

        }

        

        $faker = \Faker\Factory::create();

        foreach( $data as $item) {

            $model = new self();

            $model->loadDefaultValues();

                    

                    	$model->title = isset($item['title'])?$item['title']:$faker->text(10);

                                       

                    	$model->description = isset($item['description'])?$item['description']:$faker->text(10);

                                       

                    	$model->image_file = isset($item['image_file'])?$item['image_file']:$faker->text(10);

                   			$model->state_id = self::STATE_ACTIVE;

                    

                    	$model->type_id = isset($item['type_id'])?$item['type_id']:0;

                           	$model->save();

        }

	}	

}

