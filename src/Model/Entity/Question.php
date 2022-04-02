<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Question Entity
 *
 * @property int $id
 * @property string|null $identifier
 * @property string|null $type
 * @property array|null $options
 *
 * @property \App\Model\Entity\Answer[] $answers
 * @property \App\Model\Entity\SelectedQuestion[] $selected_questions
 */
class Question extends Entity
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
        'identifier' => true,
        'type' => true,
        'graph' => true,
        'languaje' => true,
        'options' => true,
        'answers' => true,
        'selected_questions' => true,
    ];
}
