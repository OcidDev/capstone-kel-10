<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use DataTables;
class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Halaman Inventory';
        $judul = 'Inventory';
        $sub_menu = 'Inventory';
        $menu = 'master';
        // $query = Inventory::with('supplier','user','product');
        // dd($query);
        if (request()->ajax()) {
            $query = Inventory::with('supplier','user','product');
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
        confirmDelete('Delete Category!',"Are you sure you want to delete?");
        return view('inventory.index',compact('title','judul','sub_menu','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
