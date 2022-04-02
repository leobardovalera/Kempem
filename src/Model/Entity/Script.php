<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Script Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $location
 * @property string|null $command
 *
 * @property \App\Model\Entity\Instrument[] $instruments
 * @property \App\Model\Entity\Result[] $results
 */
class Script extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'description' => true,
        'location' => true,
        'command' => true,
        'in_file' => true,
        'out_file' => true,
        'instruments' => true,
        'results' => true,
    ];
}
