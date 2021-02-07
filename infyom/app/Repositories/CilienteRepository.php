<?php

namespace App\Repositories;

use App\Models\Ciliente;
use App\Repositories\BaseRepository;

/**
 * Class CilienteRepository
 * @package App\Repositories
 * @version February 7, 2021, 6:12 pm UTC
*/

class CilienteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nom',
        'cognom',
        'nif'
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
        return Ciliente::class;
    }
}
