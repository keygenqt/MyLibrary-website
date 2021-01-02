<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $genre_id
 * @property string $image
 * @property string $title
 * @property string $author
 * @property string $publisher
 * @property string $isbn
 * @property string $year
 * @property string $number_of_pages
 * @property string $description
 * @property string $cover_type // 'Soft', 'Solid', 'Other'
 * @property string $sale
 * @property integer $enabled
 * @property string $created_at
 * @property string $updated_at
 */
class Book extends ActiveRecord
{
    const GRID_SIZE = 10;

    const SCENARIO_UPDATE = "SCENARIO_UPDATE";
    const SCENARIO_FILTER = "SCENARIO_FILTER";

    public static function tableName(): string
    {
        return 'books';
    }

    public function rules(): array
    {
        /* SCENARIO_FILTER */
        return [
            [[
                'id',
                'user_id',
                'genre_id',
                'image',
                'title',
                'author',
                'publisher',
                'isbn',
                'year',
                'number_of_pages',
                'description',
                'cover_type',
                'sale',
                'enabled',
                'created_at',
                'updated_at',
            ], 'safe', 'on' => self::SCENARIO_FILTER],

            /* SCENARIO_UPDATE */
            [['author', 'publisher', 'isbn', 'year', 'number_of_pages', 'description', 'number_of_pages'], 'safe', 'on' => self::SCENARIO_UPDATE],
            [['image', 'user_id', 'genre_id', 'title', 'cover_type'], 'required', 'on' => self::SCENARIO_UPDATE],
            [['title', 'author', 'publisher'], 'string', 'length' => [2, 250], 'on' => self::SCENARIO_UPDATE],
            [['description'], 'string', 'length' => [2, 5000], 'on' => self::SCENARIO_UPDATE],
            [['user_id', 'genre_id', 'year', 'number_of_pages'], 'integer', 'on' => self::SCENARIO_UPDATE],
        ];
    }

    public function setScenario($value)
    {
        if ($this->isNewRecord && $value == self::SCENARIO_UPDATE) {
            $this->enabled = 1;
        }
        parent::setScenario($value);
    }

    public function attributeLabels(): array
    {
        return [
            'user_id' => 'User',
            'genre_id' => 'Genre',
        ];
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
        /** @var Book $class */
        $class = get_class();
        $query = $class::find();

        $this->load($params);

        if ($this->enabled === null) {
            $this->enabled = 1;
        }

        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['=', 'enabled', $this->enabled]);

        return $query;
    }
}
