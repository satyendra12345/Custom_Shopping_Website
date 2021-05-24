<?php
/**

*@copyright : Satyendra Pandey

*@author	 : Satyendra Pandey  < pandeysatyendra870@gmail.com >

*

* All Rights Reserved.

* Proprietary and confidential :  All information contained herein is, and remains

* the property of Satyendra Pandey  and his partners.

* Unauthorized copying of this file, via any medium is strictly prohibited.

*

*/

 



namespace app\models;



use Yii;

use app\models\Feed;

use app\models\Category;
use app\models\User;
use app\models\Menu;



use yii\helpers\ArrayHelper;





/**

* This is the model class for table "tbl_product".

*



    * @property integer $id


    * @property string $title


    * @property string $description


    * @property string $image_file


    * @property integer $category_id


    * @property integer $menu_id


    * @property integer $price


    * @property integer $state_id


    * @property integer $type_id


    * @property string $created_on


    * @property string $updated_on


    * @property integer $created_by_id





* === Related data ===

    
* @property Category $category

    
* @property User $createdBy

    
* @property Menu $menu

    

*/





class Product extends \app\components\TActiveRecord

{


	public  function __toString()

	{

		return (string)$this->title;

	}

public static function getCategoryOptions()

	{

		// return ["TYPE1","TYPE2","TYPE3"];

			
		return ArrayHelper::Map ( Category::findActive ()->all (), 'id', 'title' );


	}



	
	
	public static function getMenuOptions()

	{

		// return ["TYPE1","TYPE2","TYPE3"];

			
		return ArrayHelper::Map ( Menu::findActive ()->all (), 'id', 'title' );


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

		return '{{%product}}';

	}




	/**

	* @inheritdoc

	*/

	public function rules()

	{

		return [
            [['title', 'description'], 'string'],
            [['category_id', 'menu_id', 'price'], 'required'],
            [['category_id', 'menu_id', 'price', 'state_id', 'type_id', 'created_by_id'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['image_file'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['created_by_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by_id' => 'id']],
            [['menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::className(), 'targetAttribute' => ['menu_id' => 'id']],
            [['image_file'], 'trim'],
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

		
		    'category_id' => Yii::t('app', 'Category'),

		
		    'menu_id' => Yii::t('app', 'Menu'),

		
		    'price' => Yii::t('app', 'Price'),

		
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

    public function getCategory()

    {

    	return $this->hasOne(Category::className(), ['id' => 'category_id']);

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

    public function getMenu()

    {

    	return $this->hasOne(Menu::className(), ['id' => 'menu_id']);

    }



    public static function getHasManyRelations()

    {

    	$relations = [];




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


		$relations['category_id'] = ['category','Category','id'];


		$relations['created_by_id'] = ['createdBy','User','id'];


		$relations['menu_id'] = ['menu','Menu','id'];


		return $relations;

	}



	public function beforeDelete() {

	    if (! parent::beforeDelete()) {

            return false;

        }

        //TODO : start here


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

			$json['image_file'] 	= \Yii::$app->createAbsoluteUrl('product/download',array('file'=>$this->image_file));



			$json['category_id'] 	= $this->category_id;



			$json['menu_id'] 	= $this->menu_id;



			$json['price'] 	= $this->price;



			$json['state_id'] 	= $this->state_id;



			$json['type_id'] 	= $this->type_id;



			$json['created_on'] 	= $this->created_on;





			$json['created_by_id'] 	= $this->created_by_id;



			if ($with_relations)

		    {


				// category


				$list = $this->category;



				if ( is_array($list))

				{

					$relationData = [];

					foreach( $list as $item)

					{

						$relationData [] 	= $item->asJson();

					}

					$json['category'] 	= $relationData;

				}

				else

				{

					$json['category'] 	= $list;

				}


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


				// menu


				$list = $this->menu;



				if ( is_array($list))

				{

					$relationData = [];

					foreach( $list as $item)

					{

						$relationData [] 	= $item->asJson();

					}

					$json['menu'] 	= $relationData;

				}

				else

				{

					$json['menu'] 	= $list;

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

						$model->title = $faker->text;
			$model->description = $faker->text;
			$model->image_file = $faker->text(10);
			$model->category_id = 1;
			$model->menu_id = 1;
			$model->price = $faker->text(10);
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


                    

                    	$model->title = isset($item['title'])?$item['title']:$faker->text;

                   
                    

                    	$model->description = isset($item['description'])?$item['description']:$faker->text;

                   
                    

                    	$model->image_file = isset($item['image_file'])?$item['image_file']:$faker->text(10);

                   
                    

                    	$model->category_id = isset($item['category_id'])?$item['category_id']:1;

                   
                    

                    	$model->menu_id = isset($item['menu_id'])?$item['menu_id']:1;

                   
                    

                    	$model->price = isset($item['price'])?$item['price']:$faker->text(10);

                   			$model->state_id = self::STATE_ACTIVE;

                    

                    	$model->type_id = isset($item['type_id'])?$item['type_id']:0;

                   
        	$model->save();

        }

	}	

}

