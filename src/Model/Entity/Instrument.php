<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Instrument Entity
 *
 * @property int $id
 * @property int|null $script_id
 * @property string|null $name
 * @property string|null $descrirption
 * @property string|null $language
 *
 * @property \App\Model\Entity\Script $script
 * @property \App\Model\Entity\Answer[] $answers
 * @property \App\Model\Entity\Evaluation[] $evaluations
 * @property \App\Model\Entity\Result[] $results
 * @property \App\Model\Entity\Section[] $sections
 */
class Instrument extends Entity
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
        'name' => true,
        'descrirption' => true,
        'language' => true,
        'script' => true,
        'answers' => true,
        'evaluations' => true,
        'results' => true,
        'options' => true,
        'individual' => true,
        'grupal' => true,
    ];
}
