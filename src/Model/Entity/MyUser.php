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
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'is_superuser' => false,
        'role' => true,
    ];
}