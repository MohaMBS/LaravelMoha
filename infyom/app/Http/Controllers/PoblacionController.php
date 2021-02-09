<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePoblacionRequest;
use App\Http\Requests\UpdatePoblacionRequest;
use App\Repositories\PoblacionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PoblacionController extends AppBaseController
{
    /** @var  PoblacionRepository */
    private $poblacionRepository;

    public function __construct(PoblacionRepository $poblacionRepo)
    {
        $this->poblacionRepository = $poblacionRepo;
    }

    /**
     * Display a listing of the Poblacion.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $poblacions = $this->poblacionRepository->all();

        return view('poblacions.index')
            ->with('poblacions', $poblacions);
    }

    /**
     * Show the form for creating a new Poblacion.
     *
     * @return Response
     */
    public function create()
    {
        return view('poblacions.create');
    }

    /**
     * Store a newly created Poblacion in storage.
     *
     * @param CreatePoblacionRequest $request
     *
     * @return Response
     */
    public function store(CreatePoblacionRequest $request)
    {
        $input = $request->all();

        $poblacion = $this->poblacionRepository->create($input);

        Flash::success('Poblacion saved successfully.');

        return redirect(route('poblacions.index'));
    }

    /**
     * Display the specified Poblacion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $poblacion = $this->poblacionRepository->find($id);

        if (empty($poblacion)) {
            Flash::error('Poblacion not found');

            return redirect(route('poblacions.index'));
        }

        return view('poblacions.show')->with('poblacion', $poblacion);
    }

    /**
     * Show the form for editing the specified Poblacion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $poblacion = $this->poblacionRepository->find($id);

        if (empty($poblacion)) {
            Flash::error('Poblacion not found');

            return redirect(route('poblacions.index'));
        }

        return view('poblacions.edit')->with('poblacion', $poblacion);
    }

    /**
     * Update the specified Poblacion in storage.
     *
     * @param int $id
     * @param UpdatePoblacionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePoblacionRequest $request)
    {
        $poblacion = $this->poblacionRepository->find($id);

        if (empty($poblacion)) {
            Flash::error('Poblacion not found');

            return redirect(route('poblacions.index'));
        }

        $poblacion = $this->poblacionRepository->update($request->all(), $id);

        Flash::success('Poblacion updated successfully.');

        return redirect(route('poblacions.index'));
    }

    /**
     * Remove the specified Poblacion from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $poblacion = $this->poblacionRepository->find($id);

        if (empty($poblacion)) {
            Flash::error('Poblacion not found');

            return redirect(route('poblacions.index'));
        }

        $this->poblacionRepository->delete($id);

        Flash::success('Poblacion deleted successfully.');

        return redirect(route('poblacions.index'));
    }
}
