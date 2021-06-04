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

use app\models\Product;



use yii\helpers\ArrayHelper;





/**

* This is the model class for table "tbl_cart".

*



    * @property integer $id


    * @property integer $product_id


    * @property integer $state_id


    * @property integer $type_id


    * @property string $created_on

	* @property string $browser_id


    * @property string $updated_on


    * @property integer $created_by_id





* === Related data ===

    
* @property Product $product

    

*/





class Cart extends \app\components\TActiveRecord

{


	public  function __toString()

	{

		return (string)$this->product_id;

	}

public static function getProductOptions()

	{

		return ["TYPE1","TYPE2","TYPE3"];

			
		//return ArrayHelper::Map ( Product::findActive ()->all (), 'id', 'title' );


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

		return '{{%cart}}';

	}




	/**

	* @inheritdoc

	*/

	public function rules()

	{

		return [
            [['product_id'], 'required'],
            [['product_id', 'state_id', 'type_id', 'created_by_id'], 'integer'],
            [['created_on', 'updated_on','browser_id'], 'safe'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
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

		
		    'product_id' => Yii::t('app', 'Product'),

		
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

    public function getProduct()

    {

    	return $this->hasOne(Product::className(), ['id' => 'product_id']);

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


		$relations['product_id'] = ['product','Product','id'];


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



			$json['product_id'] 	= $this->product_id;



			$json['state_id'] 	= $this->state_id;



			$json['type_id'] 	= $this->type_id;



			$json['created_on'] 	= $this->created_on;





			$json['created_by_id'] 	= $this->created_by_id;



			if ($with_relations)

		    {


				// product


				$list = $this->product;



				if ( is_array($list))

				{

					$relationData = [];

					foreach( $list as $item)

					{

						$relationData [] 	= $item->asJson();

					}

					$json['product'] 	= $relationData;

				}

				else

				{

					$json['product'] 	= $list;

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

						$model->product_id = 1;
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


                    

                    	$model->product_id = isset($item['product_id'])?$item['product_id']:1;

                   			$model->state_id = self::STATE_ACTIVE;

                    

                    	$model->type_id = isset($item['type_id'])?$item['type_id']:0;

                   
        	$model->save();

        }

	}	

}

