<?php

namespace App\Repositories;

use App\Models\Poblacion;
use App\Repositories\BaseRepository;

/**
 * Class PoblacionRepository
 * @package App\Repositories
 * @version February 8, 2021, 6:03 pm UTC
*/

class PoblacionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ciudad',
        'poblacion',
        'cp'
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
        return Poblacion::class;
    }
}
