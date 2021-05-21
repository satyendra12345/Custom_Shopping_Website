<?php

/**
 *@copyright : ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 *@author	 : Shiv Charan Panjeta < shiv@toxsl.com >
 */
namespace app\modules\page\models\search;

use app\modules\page\models\Page as PageModel;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Page represents the model behind the search form about `app\modules\page\models\Page`.
 */
class Page extends PageModel
{

	/**
	 *
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[
				[
					'id',
					'state_id',
					'type_id',
					'created_by_id'
				],
				'integer'
			],
			[
				[
					'title',
					'description',
					'created_on',
					'updated_on'
				],
				'safe'
			]
		];
	}

	/**
	 *
	 * @inheritdoc
	 */
	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	public function beforeValidate()
	{
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
		$query = PageModel::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'sort' => [
				'defaultOrder' => [
					'id' => SORT_DESC
				]
			]
		]);

		if (! ($this->load($params) && $this->validate()))
		{
			return $dataProvider;
		}

		$query->andFilterWhere([
			'id' => $this->id,
			'state_id' => $this->state_id,
			'type_id' => $this->type_id,
			'created_on' => $this->created_on,
			'updated_on' => $this->updated_on,
			'created_by_id' => $this->created_by_id
		]);

		$query->andFilterWhere([
			'like',
			'title',
			$this->title
		])->andFilterWhere([
			'like',
			'description',
			$this->description
		]);

		return $dataProvider;
	}
}
