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
    // Validate incoming request
    $validated = $request->validate([
        'title'       => 'required|string|max:255',
        'description' => 'nullable|string',
        'price'       => 'required|numeric|min:0',
        'image' => [
        'nullable',
        'image',
        'mimes:jpg,jpeg,png,webp,gif',
        'max:2048',
        'dimensions:width=350,height=200', // ✅ enforce exact size
    ],
    ]);

    // Handle image upload if provided
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('services', 'public');
    }

    // Create the service
    Service::create([
        'title'       => $validated['title'],
        'description' => $validated['description'] ?? null,
        'price'       => $validated['price'],
        'image_path'  => $imagePath,   // ✅ match your fillable
        'is_active'   => true,         // optional default
    ]);

    return redirect()->route('services.index')
                     ->with('success', 'Service created successfully.');
}



  public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'title'       => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'price'       => ['required','numeric','min:0'],
            // name MUST match the form file input below
        'image'       => [
        'nullable',
        'image',
        'mimes:jpg,jpeg,png,webp,gif',
        'max:2048',
        'dimensions:width=350,height=200', // ✅ enforce exact size
    ],
            // select sends "1"/"0" -> we'll cast explicitly
            'is_active'   => ['required','in:0,1'],
        ]);

        // Handle image upload & old image removal
        if ($request->hasFile('image')) {
            // remove old if present
            if ($service->image_path && Storage::disk('public')->exists($service->image_path)) {
                Storage::disk('public')->delete($service->image_path);
            }

            // store new
            $data['image_path'] = $request->file('image')->store('services', 'public');
        }

        // Cast is_active to boolean (since select sends string)
        $data['is_active'] = (int) $request->input('is_active') === 1;

        // We don't want to save 'image' key itself
        unset($data['image']);

        $service->update($data);

        if ($request->wantsJson()) {
            return response()->json(['ok' => true]);
        }

        return back()->with('success', 'Service updated.');
    }



public function destroy(Service $service)
{
    if ($service->image_path) {
        Storage::disk('public')->delete($service->image_path);
    }
    $service->delete();

    if (request()->wantsJson()) {
        return response()->json(['ok' => true]);
    }
    return back()->with('success','Service deleted.');
}
}
