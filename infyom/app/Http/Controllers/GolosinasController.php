<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGolosinasRequest;
use App\Http\Requests\UpdateGolosinasRequest;
use App\Repositories\GolosinasRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class GolosinasController extends AppBaseController
{
    /** @var  GolosinasRepository */
    private $golosinasRepository;

    public function __construct(GolosinasRepository $golosinasRepo)
    {
        $this->golosinasRepository = $golosinasRepo;
    }

    /**
     * Display a listing of the Golosinas.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $golosinas = $this->golosinasRepository->all();

        return view('golosinas.index')
            ->with('golosinas', $golosinas);
    }

    /**
     * Show the form for creating a new Golosinas.
     *
     * @return Response
     */
    public function create()
    {
        return view('golosinas.create');
    }

    /**
     * Store a newly created Golosinas in storage.
     *
     * @param CreateGolosinasRequest $request
     *
     * @return Response
     */
    public function store(CreateGolosinasRequest $request)
    {
        $input = $request->all();

        $golosinas = $this->golosinasRepository->create($input);

        Flash::success('Golosinas saved successfully.');

        return redirect(route('golosinas.index'));
    }

    /**
     * Display the specified Golosinas.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $golosinas = $this->golosinasRepository->find($id);

        if (empty($golosinas)) {
            Flash::error('Golosinas not found');

            return redirect(route('golosinas.index'));
        }

        return view('golosinas.show')->with('golosinas', $golosinas);
    }

    /**
     * Show the form for editing the specified Golosinas.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $golosinas = $this->golosinasRepository->find($id);

        if (empty($golosinas)) {
            Flash::error('Golosinas not found');

            return redirect(route('golosinas.index'));
        }

        return view('golosinas.edit')->with('golosinas', $golosinas);
    }

    /**
     * Update the specified Golosinas in storage.
     *
     * @param int $id
     * @param UpdateGolosinasRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGolosinasRequest $request)
    {
        $golosinas = $this->golosinasRepository->find($id);

        if (empty($golosinas)) {
            Flash::error('Golosinas not found');

            return redirect(route('golosinas.index'));
        }

        $golosinas = $this->golosinasRepository->update($request->all(), $id);

        Flash::success('Golosinas updated successfully.');

        return redirect(route('golosinas.index'));
    }

    /**
     * Remove the specified Golosinas from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $golosinas = $this->golosinasRepository->find($id);

        if (empty($golosinas)) {
            Flash::error('Golosinas not found');

            return redirect(route('golosinas.index'));
        }

        $this->golosinasRepository->delete($id);

        Flash::success('Golosinas deleted successfully.');

        return redirect(route('golosinas.index'));
    }
}
