<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CocheRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CocheCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CocheCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Coche::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/coche');
        CRUD::setEntityNameStrings('coche', 'coches');
        $this->crud->enableExportButtons();
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        //CRUD::setFromDb(); // columns
        $this->crud->column('marca');
        $this->crud->column('modelo');
        $this->crud->column('fecha');
        $this->crud->addColumn([  
            // any type of relationship
            'name'         => 'cliente', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'Nom', // Table column heading
            // OPTIONAL
            // 'entity'    => 'tags', // the method that defines the relationship in your Model
            // 'attribute' => 'name', // foreign key attribute that is shown to user
            // 'model'     => App\Models\Category::class, // foreign key model
         ]);

        /**<
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {   
        CRUD::setValidation(CocheRequest::class);
        
        $this->crud->addField([    
            'name'  => 'marca',
            'type'  => 'text',
            'label' => 'Marca',
        ]);
        $this->crud->addField([    
            'name'  => 'modelo',
            'type'  => 'text',
            'label' => 'Modelo',
        ]);
        $this->crud->addField([    
            'name'  => 'fecha',
            'type'  => 'datetime',
            'label' => 'Fecha',
        ]); 
        $this->crud->addField([
            'label' => 'Ciliente',
            'type' => 'select2',
            'name' => 'id_ciliente', // the db column for the foreign key
            'entity' => 'cliente', // the method that defines the relationship in your Model
            'attribute' => 'nom', // foreign key attribute that is shown to user
            'model' => 'App\Models\Ciliente' // foreign key model
        ]);
        //CRUD::setFromDb(); // fields
        //$this->crud->addField("test");
        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
