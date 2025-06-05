<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trainer;

class TrainerController extends Controller
{
    public function __construct(){
        $this->middleware('permission:trainer index')->only('index');
        $this->middleware('permission:trainer create')->only(['create','store']);
        $this->middleware('permission:trainer update')->only(['edit','update']);
        $this->middleware('permission:trainer delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$trainers = Trainer::all();        
        $trainers = Trainer::withTrashed()->get();       
        return view('trainers/index', ['trainers' => $trainers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $trainers = Trainer::all();

        return view('trainers.create', [
            'trainers' => $trainers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            /* $trainer = Trainer::findOrFail($id);
            $trainer->delete(); */
            $trainer = Trainer::find($id)->delete();
    
            return redirect()->back()->with('success', 'Trainer deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete member: ' . $e->getMessage());
        }
    }

    public function restore($id)
    {
        $trainer = Trainer::onlyTrashed()->findOrFail($id);
        $trainer->restore();

        return redirect()->back()->with('success', 'Trainer restored successfully.');
    }

}
