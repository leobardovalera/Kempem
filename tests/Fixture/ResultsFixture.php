<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ResultsFixture
 */
class ResultsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'script_id' => ['type' => 'integer', 'length' => null, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_id' => ['type' => 'uuid', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'processed' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => null, 'comment' => ''],
        'instrument_id' => ['type' => 'integer', 'length' => null, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'evaluation_id' => ['type' => 'uuid', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'data' => ['type' => 'json', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fk_results_evaluations_1' => ['type' => 'index', 'columns' => ['evaluation_id'], 'length' => []],
            'fk_results_instruments_1' => ['type' => 'index', 'columns' => ['instrument_id'], 'length' => []],
            'fk_results_scripts_1' => ['type' => 'index', 'columns' => ['script_id'], 'length' => []],
            'fk_results_users_1' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_results_evaluations_1' => ['type' => 'foreign', 'columns' => ['evaluation_id'], 'references' => ['evaluations', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_results_instruments_1' => ['type' => 'foreign', 'columns' => ['instrument_id'], 'references' => ['instruments', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_results_scripts_1' => ['type' => 'foreign', 'columns' => ['script_id'], 'references' => ['scripts', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_results_users_1' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'script_id' => 1,
                'user_id' => '0ea30c90-8d73-4b0d-b0f3-a5a3ca61caec',
                'processed' => '2020-10-18 21:55:42',
                'instrument_id' => 1,
                'evaluation_id' => 'bf0d80b4-a6db-4375-9564-9e7a0b07193d',
                'data' => '',
            ],
        ];
        parent::init();
    }
}
