<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Answer Entity
 *
 * @property int $id
 * @property int|null $instrument_id
 * @property string|null $user_id
 * @property int|null $question_id
 * @property int|null $section_id
 * @property string|null $evaluation_id
 * @property int|null $selected_question_id
 * @property \Cake\I18n\FrozenTime|null $response
 * @property string|null $value
 *
 * @property \App\Model\Entity\Instrument $instrument
 * @property \CakeDC\Users\Model\Entity\User $user
 * @property \App\Model\Entity\Question $question
 * @property \App\Model\Entity\Section $section
 * @property \App\Model\Entity\Evaluation $evaluation
 * @property \App\Model\Entity\SelectedQuestion $selected_question
 */
class Answer extends Entity
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
        'instrument_id' => true,
        'user_id' => true,
        'question_id' => true,
        'section_id' => true,
        'evaluation_id' => true,
        'selected_question_id' => true,
        'response' => true,
        'value' => true,
        'instrument' => true,
        'user' => true,
        'question' => true,
        'section' => true,
        'evaluation' => true,
        'selected_question' => true,
    ];
}
