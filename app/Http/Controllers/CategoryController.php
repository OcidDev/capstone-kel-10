<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
Use DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Category::query();
            return Datatables::of($query)
                ->editColumn('image',function($item){
                    return $item->image ? '<img class=" w-100 img-thumbnail" src="'.Storage::url($item->image).'">' : '';
                })
                ->addColumn('action', function ($item) {
                    return '<a class="btn btn btn-warning" href="'.Route('category.edit',$item->id).'" role="button">Edit</a>
                            <a class="btn btn btn-danger" href="'.Route('category.destroy',$item->id).'" role="button" data-confirm-delete="true">Hapus</a>';})
                ->rawColumns(['image','action'])
                ->make();
            }
        $title = 'Delete Category!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('pages.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image',
        ]);
        $data['image'] = $request->file('image')->store('assets/image', 'public');
        Category::create($data);
        Alert::success('Success Add Data', 'Create data has been success');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::FindOrFail($id);
        return view('pages.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'image',
        ]);

        $category = Category::findOrFail($id);

        if ($request->hasFile('image')) {
            Storage::delete('public/'.$category->image);
            $data['image'] = $request->file('image')->store('assets/image', 'public');
        } else {
            $data['image'] = $category->image;
        }

        $category->update($data);

        Alert::success('Success Update Data', 'Update data has been success');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Category::findOrFail($id);
        $item->delete();
        toast()->error('Deleted data has been success');
        return redirect()->route('category.index');
    }
}
