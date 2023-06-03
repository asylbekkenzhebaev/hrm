<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{

    /**
     *
     */
    public function __construct()
    {
        $this->middleware(['auth'])->except(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $positions = Position::all();
        return view('positions.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $departments = Department::all();

        return view('positions.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePositionRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePositionRequest $request)
    {
        $data = $request->validated();
        $position = new Position($data);
        $position->save();

        return redirect()->route('positions.index')->with('status', ['text' => "{$position->name} position successfully created!", 'color' => 'success']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Position $position)
    {
        $departments = Department::all();

        return view('positions.edit', compact('departments','position'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePositionRequest  $request
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePositionRequest $request, Position $position)
    {
        $data = $request->validated();
        $position->update($data);

        return redirect()->route('positions.index')->with('status', ['text' => "{$position->name} position successfully updated!", 'color' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Position $position)
    {
        $position->delete();

        return redirect()->route('positions.index')->with('status', ['text' => "{$position->name} department successfully deleted!", 'color' => 'danger']);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function positionList(Request $request)
    {
        $department_id = intval($request->department_id);
        $positions = Position::where('department_id', $department_id)->get();

        return $positions;
    }
}
