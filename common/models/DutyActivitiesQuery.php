<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[DutyActivities]].
 *
 * @see DutyActivities
 */
class DutyActivitiesQuery extends \antonyz89\templates\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return DutyActivities[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return DutyActivities|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
