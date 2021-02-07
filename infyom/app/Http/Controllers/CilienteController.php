<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCilienteRequest;
use App\Http\Requests\UpdateCilienteRequest;
use App\Repositories\CilienteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CilienteController extends AppBaseController
{
    /** @var  CilienteRepository */
    private $cilienteRepository;

    public function __construct(CilienteRepository $cilienteRepo)
    {
        $this->cilienteRepository = $cilienteRepo;
    }

    /**
     * Display a listing of the Ciliente.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $cilientes = $this->cilienteRepository->all();

        return view('cilientes.index')
            ->with('cilientes', $cilientes);
    }

    /**
     * Show the form for creating a new Ciliente.
     *
     * @return Response
     */
    public function create()
    {
        return view('cilientes.create');
    }

    /**
     * Store a newly created Ciliente in storage.
     *
     * @param CreateCilienteRequest $request
     *
     * @return Response
     */
    public function store(CreateCilienteRequest $request)
    {
        $input = $request->all();

        $ciliente = $this->cilienteRepository->create($input);

        Flash::success('Ciliente saved successfully.');

        return redirect(route('cilientes.index'));
    }

    /**
     * Display the specified Ciliente.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $ciliente = $this->cilienteRepository->find($id);

        if (empty($ciliente)) {
            Flash::error('Ciliente not found');

            return redirect(route('cilientes.index'));
        }

        return view('cilientes.show')->with('ciliente', $ciliente);
    }

    /**
     * Show the form for editing the specified Ciliente.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $ciliente = $this->cilienteRepository->find($id);

        if (empty($ciliente)) {
            Flash::error('Ciliente not found');

            return redirect(route('cilientes.index'));
        }

        return view('cilientes.edit')->with('ciliente', $ciliente);
    }

    /**
     * Update the specified Ciliente in storage.
     *
     * @param int $id
     * @param UpdateCilienteRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCilienteRequest $request)
    {
        $ciliente = $this->cilienteRepository->find($id);

        if (empty($ciliente)) {
            Flash::error('Ciliente not found');

            return redirect(route('cilientes.index'));
        }

        $ciliente = $this->cilienteRepository->update($request->all(), $id);

        Flash::success('Ciliente updated successfully.');

        return redirect(route('cilientes.index'));
    }

    /**
     * Remove the specified Ciliente from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $ciliente = $this->cilienteRepository->find($id);

        if (empty($ciliente)) {
            Flash::error('Ciliente not found');

            return redirect(route('cilientes.index'));
        }

        $this->cilienteRepository->delete($id);

        Flash::success('Ciliente deleted successfully.');

        return redirect(route('cilientes.index'));
    }
}
