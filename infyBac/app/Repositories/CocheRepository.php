<?php

namespace App\Repositories;

use App\Models\Coche;
use App\Repositories\BaseRepository;

/**
 * Class CocheRepository
 * @package App\Repositories
 * @version February 3, 2021, 11:24 pm UTC
*/

class CocheRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'marca',
        'modelo',
        'fecha'
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
