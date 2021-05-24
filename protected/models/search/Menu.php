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
namespace app\models\search;



use Yii;

use yii\base\Model;

use yii\data\ActiveDataProvider;

use app\models\Menu as MenuModel;



/**

 * Menu represents the model behind the search form about `app\models\Menu`.

 */

class Menu extends MenuModel


{

    /**

     * @inheritdoc

     */

    public function rules()

    {

        return [

            [['id', 'state_id', 'type_id', 'created_by_id'], 'integer'],
            [['title', 'description', 'created_on', 'updated_on'], 'safe'],

        ];

    }



    /**

     * @inheritdoc

     */

    public function scenarios()

    {

        // bypass scenarios() implementation in the parent class

        return Model::scenarios();

    }

    public function beforeValidate(){

            return true;

    }

    /**

     * Creates data provider instance with search query applied

     *

     * @param array $params

     *

     * @return ActiveDataProvider

     */

    public function search($params)

    {

        $query = MenuModel::find();



		
        $dataProvider = new ActiveDataProvider([

            'query' => $query,

            'sort' => [

						'defaultOrder' => [

								'id' => SORT_DESC

						]

				]

        ]);



        if (!($this->load($params) && $this->validate())) {

            return $dataProvider;

        }



        $query->andFilterWhere([
            'state_id' => $this->state_id,
            'type_id' => $this->type_id,
            'created_by_id' => $this->created_by_id,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'created_on', $this->created_on])
            ->andFilterWhere(['like', 'updated_on', $this->updated_on]);



        return $dataProvider;

    }

}

