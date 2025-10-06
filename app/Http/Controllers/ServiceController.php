<?php

namespace App\Http\Controllers;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
       $services = Service::orderBy('created_at', 'desc')->paginate(12);
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
  public function create()
{
    return view('services.create');
}

    /**
     * Store a newly created resource in storage.
     */

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


 public function store(Request $request)
{
    // Validate input
    $validated = $request->validate([
        'title'       => 'required|string|max:255',
        'description' => 'nullable|string',
        'price'       => 'required|numeric|min:0',
        'image' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp,gif',
            'max:2048',
            'dimensions:width=350,height=200',
        ],
    ]);

    $imagePath = null;

    // Handle image upload
    if ($request->hasFile('image')) {
        $destinationPath = public_path('uploads/services');

        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move($destinationPath, $imageName);

        // ✅ Save relative path (no "storage/" prefix)
        $imagePath = 'uploads/services/' . $imageName;
    }

    // Save record
    Service::create([
        'title'       => $validated['title'],
        'description' => $validated['description'] ?? null,
        'price'       => $validated['price'],
        'image_path'  => $imagePath,
        'is_active'   => true,
    ]);

    return redirect()->route('services.index')
                     ->with('success', 'Service created successfully.');
}



 public function update(Request $request, Service $service)
{
    // Validate input
    $validated = $request->validate([
        'title'       => 'required|string|max:255',
        'description' => 'nullable|string',
        'price'       => 'required|numeric|min:0',
        'image' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp,gif',
            'max:2048',
            'dimensions:width=350,height=200',
        ],
        'is_active'   => 'required|in:0,1',
    ]);

    $imagePath = $service->image_path; // Keep old image if not replaced

    // Handle new image upload
    if ($request->hasFile('image')) {
        $destinationPath = public_path('uploads/services');

        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        // Remove old image if exists
        if ($service->image_path && file_exists(public_path($service->image_path))) {
            unlink(public_path($service->image_path));
        }

        // Upload new image
        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move($destinationPath, $imageName);

        // Save relative path (no storage prefix)
        $imagePath = 'uploads/services/' . $imageName;
    }

    // Update record
    $service->update([
        'title'       => $validated['title'],
        'description' => $validated['description'] ?? null,
        'price'       => $validated['price'],
        'image_path'  => $imagePath,
        'is_active'   => (bool) $validated['is_active'],
    ]);

    return redirect()->route('services.index')
                     ->with('success', 'Service updated successfully.');
}





public function destroy(Service $service)
{
    // Delete image if exists
    if ($service->image_path && file_exists(public_path($service->image_path))) {
        unlink(public_path($service->image_path));
    }

    // Delete the service record
    $service->delete();

    // Return JSON if requested
    if (request()->wantsJson()) {
        return response()->json(['ok' => true]);
    }

    return back()->with('success', 'Service deleted.');
}




}
