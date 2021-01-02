<?php

namespace common\models;

use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "notifications".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $channel_id
 * @property string $title
 * @property string $uri
 * @property string $body
 * @property string $status // 'open', 'done', 'pending', 'error'
 * @property string $created_at
 */
class Notification extends ActiveRecord
{
    const GRID_SIZE = 10;

    const STATUS_OPEN = "open";
    const STATUS_DONE = "done";
    const STATUS_PENDING = "pending";
    const STATUS_ERROR = "error";

    const SCENARIO_UPDATE = "SCENARIO_UPDATE";
    const SCENARIO_FILTER = "SCENARIO_FILTER";

    public static function tableName(): string
    {
        return 'notifications';
    }

    public function setScenario($value)
    {
        if ($this->isNewRecord && $value == self::SCENARIO_UPDATE) {
            $this->channel_id = 'channel_server';
            $this->title = 'MyLibrary';
            $this->status = 'open';
        }
        parent::setScenario($value);
    }

    public function rules(): array
    {
        return [
            /* SCENARIO_FILTER */
            [[
                'id',
                'user_id',
                'channel_id',
                'title',
                'uri',
                'body',
                'status',
                'created_at',
            ], 'safe', 'on' => self::SCENARIO_FILTER],

            /* SCENARIO_UPDATE */
            [['user_id', 'channel_id', 'title', 'body', 'status'], 'required', 'on' => self::SCENARIO_UPDATE],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'user_id' => 'User',
            'channel_id' => 'Channel',
        ];
    }

    public function search($params): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $this->getQuery($params),
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_ASC,
                ]
            ],
            'pagination' => [
                'pageSize' => self::GRID_SIZE
            ],
        ]);
    }

    public function getQuery($params): ActiveQuery
    {
        /** @var Notification $class */
        $class = get_class();
        $query = $class::find();

        $this->load($params);

        $query->andFilterWhere(['like', 'body', $this->body]);
        $query->andFilterWhere(['=', 'status', $this->status]);

        return $query;
    }
}
