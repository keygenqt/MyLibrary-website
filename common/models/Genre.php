<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "genres".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $language
 * @property integer $enabled
 * @property string $created_at
 * @property string $updated_at
 */
class Genre extends ActiveRecord
{
    const GRID_SIZE = 10;

    const LANGUAGE_RU = "ru-RU";
    const LANGUAGE_EN = "en-US";

    const SCENARIO_UPDATE = "SCENARIO_UPDATE";
    const SCENARIO_FILTER = "SCENARIO_FILTER";

    public static function tableName(): string
    {
        return 'genres';
    }

    public function setScenario($value)
    {
        if ($this->isNewRecord && $value == self::SCENARIO_UPDATE) {
            $this->enabled = 1;
        }
        parent::setScenario($value);
    }

    public function behaviors(): array
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    public function rules(): array
    {
        return [
            /* SCENARIO_FILTER */
            [[
                'title',
                'description',
                'language',
                'enabled',
                'created_at',
                'updated_at',
            ], 'safe', 'on' => self::SCENARIO_FILTER],

            /* SCENARIO_UPDATE */
            [['title', 'description', 'language', 'enabled'], 'required', 'on' => self::SCENARIO_UPDATE],

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
        /** @var Genre $class */
        $class = get_class();
        $query = $class::find();

        $this->load($params);

        if ($this->enabled === null) {
            $this->enabled = 1;
        }

        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['=', 'language', $this->language]);
        $query->andFilterWhere(['=', 'enabled', $this->enabled]);

        return $query;
    }
}
