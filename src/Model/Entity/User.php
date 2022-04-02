<?php

namespace App\Model\Entity;

use CakeDC\Users\Model\Entity\User;

/**
 * Application specific User Entity with non plugin conform field(s)
 */
class MyUser extends User
{
    /**
     * Map CakeDC's User.active field to User.is_active when getting
     *
     * @return mixed The value of the mapped property.
     */
    protected function _getActive()
    {
        return $this->_properties['is_active'];
    }

    /**
     * Map CakeDC's User.active field to User.is_active when setting
     *
     * @param mixed $value The value to set.
     * @return static
     */
    protected function _setActive($value)
    {
        $this->set('is_active', $value);
        return $value;
    }
}