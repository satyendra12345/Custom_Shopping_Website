<?php


namespace app\models\search;

use app\models\EmailQueue as EmailQueueModel;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * EmailQueue represents the model behind the search form about `app\models\EmailQueue`.
 */
class EmailQueue extends EmailQueueModel
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'id',
                    'attempts',
                    'state_id',
                    'model_id'
                ],
                'integer'
            ],
            [
                [
                    'from_email',
                    'to_email',
                    'message',
                    'subject',
                    'date_published',
                    'last_attempt',
                    'date_sent',
                    'model_type'
                ],
                'safe'
            ]
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
    public function beforeValidate() {
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
        $query = EmailQueueModel::find();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ]
        ]);
        
        if (! ($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        
        $query->andFilterWhere([
            'id' => $this->id,
            'date_published' => $this->date_published,
            'last_attempt' => $this->last_attempt,
            'date_sent' => $this->date_sent,
            'attempts' => $this->attempts,
            'state_id' => $this->state_id,
            'model_id' => $this->model_id
        ]);
        
        $query->andFilterWhere([
            'like',
            'from_email',
            $this->from_email
        ])
            ->andFilterWhere([
            'like',
            'to_email',
            $this->to_email
        ])
            ->andFilterWhere([
            'like',
            'message',
            $this->message
        ])
            ->andFilterWhere([
            'like',
            'subject',
            $this->subject
        ])
            ->andFilterWhere([
            'like',
            'model_type',
            $this->model_type
        ]);
        
        return $dataProvider;
    }
}

