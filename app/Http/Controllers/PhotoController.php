<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\PhotoClasse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Intervention\Image\Facades\File;


class PhotoController extends Controller
{

    // for upload imagess
    public function uploadImages(Request $request, $classeId)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,gif,webp,bmp,tiff,svg,ico,ai,jfif|max:2048',
        ]);

        $classe = Classe::findOrFail($classeId);

        foreach ($request->file('images') as $image) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imageName);

            PhotoClasse::create([
                'name' => $imageName,
                'classe_id' => $classe->id,
            ]);
        }

        return redirect()->route('classe.index')->with('success', 'Images uploaded successfully.');
    }

    // for delete the image in the modal 

    public function destroy($classeId, $photoId)
    {
        $photo = PhotoClasse::findOrFail($photoId);

        if ($photo->classe_id != $classeId) {
            return redirect()->back()->with('error', 'Invalid photo for the class');
        }
        Storage::delete('public/images/' . $photo->name);

        $photo->delete();

        return redirect()->back()->with('success', 'Photo deleted successfully');
    }




    // function for update the image in the modal
    public function update(Request $request, Classe $classe, PhotoClasse $photo)
    {
        $request->validate([
            'update_image' => 'required|image|mimes:jpeg,png,gif,webp|max:2048',
        ]);

        // handle the image update 
        if ($request->hasFile('update_image')) {
            // this is for delete the old image from storage
            Storage::delete('public/images/' . $photo->name);

            // store the new image
            $imagePath = $request->file('update_image')->store('public/images');
            $photo->name = basename($imagePath);
            $photo->save();

            return back()->with('success', 'Image updated successfully.');
        }
        // in case the image didn't not upload
        return back()->with('error', 'Failed to update the image.');
    }


}