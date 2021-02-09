<?php

namespace App\Repositories;

use App\Models\Coche;
use App\Repositories\BaseRepository;

/**
 * Class CocheRepository
 * @package App\Repositories
 * @version February 8, 2021, 5:55 pm UTC
*/

class CocheRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'marca',
        'modelo',
        'fecha',
        'id_ciliente'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Coche::class;
    }
}
