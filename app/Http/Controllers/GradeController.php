<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\ViewName;

class GradeController extends Controller
{
   
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::all(); 
        return view('grades.index',['grades'=>$grades]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Grade::create([
            'name'=>$request->name,
        ]);


        return redirect()->route('grades.index')->with('success', 'Record added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $grade = Grade::where('id',$id)->first();
        return view('grades.show', ['grade'=>$grade]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $grade = Grade::where('id',$id)->first();
        return view('grades.edit', ['grade'=>$grade]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:3',
        ]);
        $grade = Grade::find($id);
        $grade->name = $request->name;
        $grade->save(); 

        return redirect()->route('grades.index')->with('success', 'Record edited successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Grade::where('id',$id)->delete();
        return back();

    }


}
