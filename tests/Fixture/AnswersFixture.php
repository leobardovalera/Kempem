<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AnswersFixture
 */
class AnswersFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'instrument_id' => ['type' => 'integer', 'length' => null, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_id' => ['type' => 'uuid', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'question_id' => ['type' => 'integer', 'length' => null, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'section_id' => ['type' => 'integer', 'length' => null, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'evaluation_id' => ['type' => 'uuid', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'selected_question_id' => ['type' => 'integer', 'length' => null, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'response' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => null, 'comment' => ''],
        'value' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8_spanish2_ci', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fk_answers_instruments_1' => ['type' => 'index', 'columns' => ['instrument_id'], 'length' => []],
            'fk_answers_sections_1' => ['type' => 'index', 'columns' => ['section_id'], 'length' => []],
            'fk_answers_questions_1' => ['type' => 'index', 'columns' => ['question_id'], 'length' => []],
            'fk_answers_selected_questions_1' => ['type' => 'index', 'columns' => ['selected_question_id'], 'length' => []],
            'fk_answers_evaluations_1' => ['type' => 'index', 'columns' => ['evaluation_id'], 'length' => []],
            'fk_answers_users_1' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_answers_evaluations_1' => ['type' => 'foreign', 'columns' => ['evaluation_id'], 'references' => ['evaluations', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_answers_instruments_1' => ['type' => 'foreign', 'columns' => ['instrument_id'], 'references' => ['instruments', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_answers_questions_1' => ['type' => 'foreign', 'columns' => ['question_id'], 'references' => ['questions', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_answers_sections_1' => ['type' => 'foreign', 'columns' => ['section_id'], 'references' => ['sections', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_answers_selected_questions_1' => ['type' => 'foreign', 'columns' => ['selected_question_id'], 'references' => ['selected_questions', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_answers_users_1' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_spanish2_ci'
        ],
    ];
    // phpcs:enable
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'instrument_id' => 1,
                'user_id' => '35a50d98-9331-479e-b943-26f7fdccaa03',
                'question_id' => 1,
                'section_id' => 1,
                'evaluation_id' => '5473f89a-096a-4eb1-af4c-ca36c28ac524',
                'selected_question_id' => 1,
                'response' => '2020-10-18 21:56:34',
                'value' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            ],
        ];
        parent::init();
    }
}
