<?php

namespace App\Http\Controllers;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $testimonials = Testimonial::orderBy('created_at', 'desc')->paginate(12);
        return view('testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    // Validate incoming request
    $validated = $request->validate([
        'name'       => 'required|string|max:255',
        'content'    => 'required|string',
        'image'      => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp,gif',
            'max:2048',
            'dimensions:width=150,height=150', // exact size
        ],
    ]);

    $imagePath = null;

    // Handle image upload
    if ($request->hasFile('image')) {
        $destinationPath = public_path('uploads/testimonials');

        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move($destinationPath, $imageName);

        // Save relative path
        $imagePath = 'uploads/testimonials/' . $imageName;
    }

    // Create the testimonial
    Testimonial::create([
        'name'       => $validated['name'],
        'content'    => $validated['content'] ?? null,
        'image_path' => $imagePath,
        'is_active'  => true,
    ]);

    return redirect()->route('testimonials.index')
                     ->with('success', 'Testimonial created successfully.');
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
public function update(Request $request, Testimonial $testimonial)
{
    // Validate input
    $validated = $request->validate([
        'name'       => ['required','string','max:255'],
        'content'    => ['required','string'],
        'is_active'  => ['required','in:0,1'],
        'image'      => ['nullable','image','mimes:jpg,jpeg,png,webp,gif','max:2048','dimensions:width=150,height=150'],
    ]);

    $imagePath = $testimonial->image_path; // keep old image if not replaced

    // Handle new image upload
    if ($request->hasFile('image')) {
        $destinationPath = public_path('uploads/testimonials');

        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        // Remove old image if exists
        if ($testimonial->image_path && file_exists(public_path($testimonial->image_path))) {
            unlink(public_path($testimonial->image_path));
        }

        // Upload new image
        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move($destinationPath, $imageName);

        $imagePath = 'uploads/testimonials/' . $imageName;
    }

    // Update testimonial
    $testimonial->update([
        'name'       => $validated['name'],
        'content'    => $validated['content'],
        'image_path' => $imagePath,
        'is_active'  => (bool) $validated['is_active'],
    ]);

    return back()->with('success', 'Testimonial updated successfully.');
}


public function destroy(Testimonial $testimonial)
{
    // Delete image from public/uploads if it exists
    if ($testimonial->image_path && file_exists(public_path($testimonial->image_path))) {
        unlink(public_path($testimonial->image_path));
    }

    // Delete the testimonial record
    $testimonial->delete();

    // Return JSON if requested, else redirect back
    if (request()->wantsJson()) {
        return response()->json(['ok' => true]);
    }

    return back()->with('success', 'Testimonial deleted successfully.');
}







}
