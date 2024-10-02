<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "duty".
 *
 * @property int $id
 * @property int $user_id
 * @property int $date
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $user
 */
class Duty extends \yii\db\ActiveRecord
{

    const STATUS_DUTY = 1;
    const STATUS_SLACK = 2;

    /**
     * @see \m241002_004637_create_duty_table
     */
    public static function tableName()
    {
        return '{{%duty}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //user_id
            ['user_id', 'required'],
            ['user_id', 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            //date
            ['date', 'required'],
            //status
            ['status', 'required'],
        ];
    }

    /**
     * @param $value
     * @return string|string[]
     */
    public static function statusValues($value = null)
    {
        $values = [
            self::STATUS_DUTY => 'Plantão',
            self::STATUS_SLACK => 'Folga',
        ];

        if ($value !== null) {
            return $values[$value];
        }

        return $values;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Usuário',
            'date' => 'Data',
            'status' => 'Status',
            'created_at' => 'Cadastrado em',
            'updated_at' => 'Atualizado em',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return DutyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DutyQuery(get_called_class());
    }
}
