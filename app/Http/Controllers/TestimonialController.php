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
        'content' => 'required|string',
        'image'       => [
        'nullable',
        'image',
        'mimes:jpg,jpeg,png,webp,gif',
        'max:2048',
        'dimensions:width=150,height=150', // ✅ enforce exact size
    ],
    ]);

    // Handle image upload if provided
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('testimonials', 'public');
    }
    // Create the service
    Testimonial::create([
        'name'       => $validated['name'],
        'content' => $validated['content'] ?? null,

        'image_path'  => $imagePath,   // ✅ match your fillable
        'is_active'   => true,         // optional default
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
        $data = $request->validate([
            'name'      => ['required','string','max:255'],
            'content'   => ['required','string'],
            'is_active' => ['required','in:0,1'],
            'image'     => ['nullable','image','mimes:jpg,jpeg,png,webp,gif','max:2048','dimensions:width=150,height=150'],
        ]);

        if ($request->hasFile('image')) {
            if ($testimonial->image_path && Storage::disk('public')->exists($testimonial->image_path)) {
                Storage::disk('public')->delete($testimonial->image_path);
            }
            $data['image_path'] = $request->file('image')->store('testimonials', 'public');
        }

        $data['is_active'] = (int)$request->input('is_active') === 1;
        unset($data['image']);

        $testimonial->update($data);

        return back()->with('success', 'Testimonial updated successfully.');
    }


public function destroy(Testimonial $testimonial)
{
    if ($testimonial->image_path) {
        Storage::disk('public')->delete($testimonial->image_path);
    }
    $testimonial->delete();

    if (request()->wantsJson()) {
        return response()->json(['ok' => true]);
    }
    return back()->with('success','Testimonial deleted.');
}
}
