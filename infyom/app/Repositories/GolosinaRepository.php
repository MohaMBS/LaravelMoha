<?php

namespace App\Repositories;

use App\Models\Golosina;
use App\Repositories\BaseRepository;

/**
 * Class GolosinaRepository
 * @package App\Repositories
 * @version March 1, 2021, 4:03 pm UTC
*/

class GolosinaRepository extends BaseRepository
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
        return Golosina::class;
    }
}
