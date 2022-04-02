<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\Collection\Collection;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * Evaluation Entity
 *
 * @property string $id
 * @property string|null $user_id
 * @property int|null $instrument_id
 * @property string|null $status
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $sended
 * @property \Cake\I18n\FrozenTime|null $started
 * @property \Cake\I18n\FrozenTime|null $completed
 *
 * @property \CakeDC\Users\Model\Entity\User $user
 * @property \App\Model\Entity\Instrument $instrument
 * @property \App\Model\Entity\Answer[] $answers
 * @property \App\Model\Entity\Result[] $results
 */
class Evaluation extends Entity
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
        'sale_id' => true,
        'email' => true,
        'names' => true,
        'lastnames' => true,
        'instrument_id' => true,
        'status' => true,
        'created' => true,
        'sended' => true,
        'started' => true,
        'completed' => true,
        'anulado' => true,
        'user' => true,
        'instrument' => true,
        'answers' => true,
        'results' => true,
    ];    
    
    protected $_virtual = ['answered', 'total', 'instrument_options'];

    protected function _getInstrumentOptions(){
        $instrumentTable = TableRegistry::get('Instruments');
        $instrument = $instrumentTable->get($this->instrument_id);
        return $instrument->options;
    }

    protected function _getAnswered() {
        $questions = [];
        $completado = 0;
        if(!empty($this->answers)){
            $answers = new Collection($this->answers);
                if(!empty($this->instrument_options['sections'])){
                foreach($this->instrument_options['sections'] as $s){
                    if(isset($s['questions'])){
                        foreach($s['questions'] as $q){
                            // debug($q);
                            $filter = $answers->filter(function ($value, $key, $iterator) use ($q) {
                                return $value['question'] == $q;
                            });
                            // debug($filter);
                            $completado += ($filter->count() > 0);
                        }
                    }
                }
            }
        }

        return $completado;
    }

    protected function _getTotal() {
        $questions = [];
        $total = 0;
        if(!empty($this->instrument_options['sections'])){
            foreach($this->instrument_options['sections'] as $s){
                if(isset($s['questions'])){
                    $total += count($s['questions']);
                }
            }
        }

        return $total;
    }

}
