<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Umkm;
use Cviebrock\EloquentSluggable\Services\SlugService;

class UmkmController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $umkms = Umkm::where([
            ['title', '!=', NULL],
            [ function($query) use ($request){
                if (($term = $request->term)){
                    $query->orWhere('title', 'LIKE', '%'.$term.'%')->get();
                }
            }]
        ])
            ->orderBy('updated_at', 'DESC')->paginate(4);

        return view('umkm.index', compact('umkms'));

        // return view('umkm.index')
        //     ->with('Umkms', Umkm::orderBy('updated_at', 'DESC')->paginate(4));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('umkm.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'phone' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);

        $newImageName = uniqid() . '-' . $request->title . '.' . $request->image->extension();

        $request->image->move(public_path('images-umkm'), $newImageName);

        Umkm::create([
            'title' => $request->input('title'),
            'phone' => $request->input('phone'),
            'description' => $request->input('description'),
            'slug' => SlugService::createSlug(Umkm::class, 'slug', $request->title),
            'image_path' => $newImageName,
            'user_id' => auth()->user()->id
        ]);

        return redirect('/umkm')
            ->with('message', 'Umkm Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  String  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return view('umkm.show')
        ->with('umkm', Umkm::where('slug', $slug)
        ->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  String  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return view('umkm.edit')
            ->with('umkm', Umkm::where('slug', $slug)
            ->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required',
            'phone' => 'required',
            'description' => 'required',
        ]);

        Umkm::where('slug', $slug)
            ->update([
                'title' => $request->input('title'),
                'phone' => $request->input('phone'),
                'description' => $request->input('description'),
                'slug' => SlugService::createSlug(Umkm::class, 'slug', $request->title),
                'user_id' => auth()->user()->id
            ]);

        return redirect('/umkm')
            ->with('message', 'Umkm Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $Umkm = Umkm::where('slug', $slug);
        $Umkm->delete();

        return redirect('/umkm')
            ->with('message', 'Umkm Berhasil Dihapus!');
    }

}
