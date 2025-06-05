<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct(){
        $this->middleware('permission:service index')->only('index');
        $this->middleware('permission:service create')->only(['create','store']);
        $this->middleware('permission:service update')->only(['edit','update']);
        $this->middleware('permission:service delete')->only('destroy');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::latest()->get();        
        return view('services/index', ['services' => $services]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();

        return view('services.create', [
            'services' => $services
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|unique:services,name|max:255',
                'fee' => 'required|numeric|min:0',
            ]);

            // Check if the service name already exists
            $existingService = Service::where('name', $request->input('name'))->first();

            if ($existingService) {
                return redirect()->back()->with('error', 'Service name already exists.');
            }

            // Create a new service
            Service::create([
                'name' => $request->name,
                'fee' => $request->fee,
            ]);
            
            return redirect()->route('services')->with('success', 'Service created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create service: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service, string $id)
    {
        $service = Service::findOrFail($id);
        if (!$service) {
            return redirect()->back()->with('error', 'Service not found.');
        }

        return view('services.view', [ 
            'service' => $service
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);

        return view('services.edit', [
            'service' => $service
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service, string $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'fee' => 'required|numeric|min:0',
            ]);

            $service = Service::findOrFail($id);

            if (!$service) {
                return redirect()->back()->with('error', 'Service not found.');
            }

            // Check if the service name already exists
            $existingService = Service::where('name', $request->input('name'))
                ->where('id', '!=', $service->id)
                ->first();

            if ($existingService) {
                return redirect()->back()->with('error', 'Service name already exists.');
            }
            // Update the service            
            $service->update([
                'name' => $request->name,
                'fee' => $request->fee,
            ]);
            
            return redirect()->route('services')->with('success', 'Service updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update service: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service, string $id)
    {
        try {
            $service = Service::findOrFail($id);
            $service->delete();
    
            return redirect()->back()->with('success', 'Service deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete service: ' . $e->getMessage());
        }
    }
}
