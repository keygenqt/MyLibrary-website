<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "users_tokens".
 *
 * @property integer $id
 * @property string $token
 * @property string $message_token
 * @property string $uid
 * @property string $language
 * @property string $user_id
 * @property string $created_at
 * @property string $updated_at
 */
class UserToken extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'users_tokens';
    }

    public function rules(): array
    {
        return [
            [[
                'id',
                'token',
                'message_token',
                'uid',
                'language',
                'user_id',
                'created_at',
                'updated_at',
            ], 'safe'],
        ];
    }
}
