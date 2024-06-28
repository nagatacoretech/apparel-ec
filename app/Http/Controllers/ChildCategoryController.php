<?php

namespace App\Http\Controllers;

use App\Models\ChildCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $parentCategories = DB::table('parent_categories')
        ->select('id', 'name')
        ->get();

        return view("admin.child_category_add",compact("parentCategories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|string|max:255|unique:child_categories',
            'gender' => 'required',
        ]);

        ChildCategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'gender' => $request->gender,
        ]);

        return redirect(route("admin.dashboard"));
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
        //
    }
}
