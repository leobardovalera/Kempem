<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Sale Entity
 *
 * @property int $id
 * @property int $company_id
 * @property int|null $instruments
 * @property \Cake\I18n\FrozenDate|null $max_date
 * @property string|null $sale_url
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\Company $company
 * @property \App\Model\Entity\Evaluation[] $evaluations
 */
class Sale extends Entity
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
        'company_id' => true,
        'instrument_id' => true,
        'instruments' => true,
        'max_date' => true,
        'created' => true,
        'company' => true,
        'country' => true,
        'evaluations' => true,
    ];
}
