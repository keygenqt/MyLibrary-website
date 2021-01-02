<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $email
 * @property string $nickname
 * @property string $image
 * @property string $website
 * @property string $location
 * @property string $bio
 * @property string $password
 * @property boolean $enabled
 * @property string $role
 * @property string $avatar
 * @property string $created_at
 * @property string $updated_at
 */
class User extends ActiveRecord implements IdentityInterface
{
    const GRID_SIZE = 10;

    const SCENARIO_FILTER = "filter";
    const SCENARIO_LOGIN = "login";
    const SCENARIO_CREATE = "create";
    const SCENARIO_UPDATE = "update";
    /**
     * @var mixed|bool|null
     */
    public $rememberMe = true;
    /**
     * @var mixed|string|null
     */
    public $_password;
    /**
     * @var mixed|null
     */
    private $_user;

    public static function tableName(): string
    {
        return 'users';
    }

    public static function avatars(): array
    {
        return [
            "avatar_0" => 'Happy',
            "avatar_1" => 'Surprised',
            "avatar_2" => 'Tired',
            "avatar_3" => 'Upset',
            "avatar_4" => 'Overwhelmed',
            "avatar_5" => 'Deer',
            "avatar_6" => 'Enamored',
            "avatar_7" => 'Birdie',
            "avatar_8" => 'What',
            "avatar_9" => 'Shocked',
            "avatar_10" => 'Touched',
            "avatar_11" => 'Angry',
            "avatar_12" => 'Zombie',
            "avatar_13" => 'Playful',
            "avatar_14" => 'Sleepy'
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    public static function findUserLogin($email)
    {
        return static::find()->where('email = :email AND enabled=1', [
            'email' => $email,
        ])->one();
    }

    public static function findIdentityByAccessToken($token, $type = null): ?IdentityInterface
    {
        return null;
    }

    public function setScenario($value)
    {
        if ($this->isNewRecord && $value == self::SCENARIO_CREATE && $this->_password === null) {
            $this->_password = random_int(10000000, 99999999);
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

    public function beforeSave($insert): bool
    {
        if ($this->_password) {
            $this->password = Yii::$app->security->generatePasswordHash($this->_password);
        }

        return parent::beforeSave($insert);
    }

    public function rules(): array
    {
        return [
            /* SCENARIO_FILTER */
            [[
                'id',
                'email',
                'nickname',
                'image',
                'website',
                'location',
                'bio',
                'password',
                'enabled',
                'role',
                'avatar',
                'created_at',
                'updated_at',
            ], 'safe', 'on' => self::SCENARIO_FILTER],

            /* SCENARIO_LOGIN */
            [['email', 'password'], 'required', 'on' => self::SCENARIO_LOGIN],
            [['email'], 'email', 'on' => self::SCENARIO_LOGIN],
            [['email'], 'findUser', 'on' => self::SCENARIO_LOGIN],

            /* SCENARIO_CREATE */
            [['website', 'location', 'bio'], 'safe', 'on' => self::SCENARIO_CREATE],
            [['avatar', 'email', 'nickname', 'enabled', 'role', '_password'], 'required', 'on' => self::SCENARIO_CREATE],
            [['_password'], 'string', 'length' => [5, 30], 'on' => self::SCENARIO_CREATE],
            [['_password'], 'integer', 'on' => self::SCENARIO_CREATE],
            [['email'], 'email', 'on' => self::SCENARIO_CREATE],
            [['email'], 'unique', 'on' => self::SCENARIO_CREATE],

            /* SCENARIO_UPDATE */
            [['website', 'location', 'bio'], 'safe', 'on' => self::SCENARIO_UPDATE],
            [['avatar', 'email', 'nickname', 'enabled', 'role'], 'required', 'on' => self::SCENARIO_UPDATE],
            [['_password'], 'string', 'length' => [5, 30], 'on' => self::SCENARIO_UPDATE],
            [['_password'], 'integer', 'on' => self::SCENARIO_UPDATE],
            [['email'], 'email', 'on' => self::SCENARIO_UPDATE],
            [['email'], 'unique', 'on' => self::SCENARIO_UPDATE],

        ];
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey(): string
    {
        return "";
    }

    public function validateAuthKey($authKey): bool
    {
        return false;
    }

    public function findUser($attribute)
    {
        if ($this->password) {
            $this->_user = User::find()->where(['email' => $this->$attribute, 'role' => 'ADMIN', 'enabled' => 1])->one();
            if ($this->_user === null) {
                $this->addError('email', 'User not found.');
            } else if ($this->_user === null || !$this->validatePassword($this->getPassword($this->_user))) {
                $this->addError('password', 'Password invalid.');
            }
        }
    }

    public function validatePassword($password): bool
    {
        return Yii::$app->security->validatePassword($this->password, $password);
    }

    public function getPassword(User $model): string
    {
        return $model->password;
    }

    public function login(): bool
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->_user);
        } else {
            return false;
        }
    }

    public function search($params): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $this->getQuery($params),
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            'pagination' => [
                'pageSize' => self::GRID_SIZE
            ],
        ]);
    }

    public function getQuery($params): ActiveQuery
    {
        /** @var User $class */
        $class = get_class();
        $query = $class::find();

        $this->load($params);

        if ($this->enabled === null) {
            $this->enabled = 1;
        }

        $query->andFilterWhere(['like', 'nickname', $this->nickname]);
        $query->andFilterWhere(['like', 'email', $this->email]);
        $query->andFilterWhere(['=', 'role', $this->role]);
        $query->andFilterWhere(['=', 'enabled', $this->enabled]);

        return $query;
    }
}
