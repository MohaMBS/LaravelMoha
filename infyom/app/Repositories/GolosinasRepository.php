<?php

namespace App\Repositories;

use App\Models\Golosinas;
use App\Repositories\BaseRepository;

/**
 * Class GolosinasRepository
 * @package App\Repositories
 * @version March 15, 2021, 4:45 pm UTC
*/

class GolosinasRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'sabor',
        'calorias',
        'precio'
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
        return Golosinas::class;
    }
}
