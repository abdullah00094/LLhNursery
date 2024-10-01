<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subject = Subject::all();
        return view('subjects.index',['subjects'=>$subject]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        validator([
            'name' => 'required|string|max:255',
        ]);
        Subject::create([
            'name'=>$request->name,
        ]);

        return redirect()->route('subjects.index')->with('success', 'Subject saved successfully!');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subject = Subject::findOrFail($id);
        return view('subjects.show' , ['subject'=> $subject]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subject = Subject::where('id',$id)->first();
        return view('subjects.edit', ['subject'=>$subject]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=> 'required|string|max:255|min:3',
        ]);


        $subject=Subject::findOrFail($id);
        $subject->name = $request->name;
        $subject->save();
        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Subject::where('id',$id)->delete();
        return back();
    }

}
