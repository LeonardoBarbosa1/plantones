<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Duty]].
 *
 * @see Duty
 */
class DutyQuery extends \antonyz89\templates\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Duty[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Duty|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function whereUser($id)
    {
        return $this->andWhere([
            sprintf('%s.user_id', Duty::tableName()) => $id,
        ]);
    }

    /**
     * @param $date
     * @return DutyQuery
     */
    public function whereDate($date)
    {
        return $this->andWhere([
            sprintf('%s.date', Duty::tableName()) => $date,
        ]);
    }

    public function whereId(mixed $id)
    {
        return $this->andWhere([
            sprintf('%s.id', Duty::tableName()) => $id,
        ]);
    }
}
