<?php

namespace App\Http\Controllers;

use App\Models\RobotKit;
use Illuminate\Http\Request;

class RobotKitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $robotKits = RobotKit::all();
        return view('robot-kits.index', compact('robotKits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('robot-kits.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'model' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        RobotKit::create($request->all());

        return redirect()->route('robot-kits.index')
            ->with('success', 'Kit de robótica creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RobotKit $robotKit)
    {
        return view('robot-kits.show', compact('robotKit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RobotKit $robotKit)
    {
        return view('robot-kits.edit', compact('robotKit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RobotKit $robotKit)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'model' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $robotKit->update($request->all());

        return redirect()->route('robot-kits.index')
            ->with('success', 'Kit de robótica actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RobotKit $robotKit)
    {
        $robotKit->delete();

        return redirect()->route('robot-kits.index')
            ->with('success', 'Kit de robótica eliminado exitosamente.');
    }
}