<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "duty_activities".
 *
 * @property int $id
 * @property int $duty_id
 * @property string $name
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Duty $duty
 */
class DutyActivities extends \yii\db\ActiveRecord
{
    const STATUS_COMPLETED = 1;
    const STATUS_PENDING = 2;
    const STATUS_CANCELED = 3;
    /**
     * @see \m241003_012405_create_duty_activities_table
     */
    public static function tableName()
    {
        return '{{%duty_activities}}';
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
            //duty_id
            ['duty_id', 'required'],
            ['duty_id', 'exist', 'skipOnError' => true, 'targetClass' => Duty::class, 'targetAttribute' => ['duty_id' => 'id']],
            //name
            ['name', 'required'],
            ['name', 'string'],
            //status
            ['status', 'required'],
        ];
    }

    public static function statusValues($value = null)
    {
        $values = [
            self::STATUS_COMPLETED => 'Finalizada',
            self::STATUS_PENDING => 'Pendente',
            self::STATUS_CANCELED => 'Cancelada',
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
            'duty_id' => 'Plantão',
            'name' => 'Atividade',
            'status' => 'Status',
            'created_at' => 'Cadastrado em',
            'updated_at' => 'Atualizado em',
        ];
    }

    /**
     * Gets query for [[Duty]].
     *
     * @return \yii\db\ActiveQuery|DutyQuery
     */
    public function getDuty()
    {
        return $this->hasOne(Duty::class, ['id' => 'duty_id']);
    }

    /**
     * {@inheritdoc}
     * @return DutyActivitiesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DutyActivitiesQuery(get_called_class());
    }
}
