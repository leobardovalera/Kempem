<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Result Entity
 *
 * @property int $id
 * @property int|null $script_id
 * @property string|null $user_id
 * @property \Cake\I18n\FrozenTime|null $processed
 * @property int|null $instrument_id
 * @property string|null $evaluation_id
 * @property array|null $data
 *
 * @property \App\Model\Entity\Script $script
 * @property \CakeDC\Users\Model\Entity\User $user
 * @property \App\Model\Entity\Instrument $instrument
 * @property \App\Model\Entity\Evaluation $evaluation
 * @property \App\Model\Entity\ResultData[] $result_data
 */
class Result extends Entity
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
        'script_id' => true,
        'user_id' => true,
        'processed' => true,
        'instrument_id' => true,
        'evaluation_id' => true,
        'data' => true,
        'script' => true,
        'user' => true,
        'instrument' => true,
        'evaluation' => true,
        'result_data' => true,
    ];
}
