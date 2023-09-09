<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\PhotoClasse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClasseController extends Controller
{
    public function index()
    {
        $classes = Classe::all();
        return view("classe", compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
        ]);

        Classe::create([
            "name" => $request->name,
        ]);

        return redirect()->route('classe.index');
    }

    public function edit($id)
    {
        $editClasse = Classe::findOrFail($id);
        $classes = Classe::all();
        return view("classe", compact("classes", "editClasse"));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "edit_name" => "required",
        ]);

        $classe = Classe::findOrFail($id);
        $classe->update([
            "name" => $request->edit_name,
        ]);

        return redirect()->route('classe.index');
    }

    public function destroy($id)
    {
        $classe = Classe::find($id);

        if (!$classe) {
            return redirect()->route('classe.index')->with('error', 'Class not found.');
        }

        if ($classe->image) {
            Storage::delete('public/images/' . $classe->image);
        }

        $classe->delete();

        return redirect()->route('classe.index')->with('success', 'Class deleted successfully.');
    }

    
}
