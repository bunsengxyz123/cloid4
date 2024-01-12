<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use App\Models\SpaceImage;
use App\Models\BlockImage;
use App\Models\User;

class FileController extends Controller
{
    public function uploadFile(Request $request)
    {
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $folderName = "images";
            $fileName = $file->getClientOriginalName();

            // Store the file on the 'spaces' disk
            $path = Storage::disk('spaces')->putFileAs($folderName, $file, $fileName);

            if($path) {
                return response()->json(['success' => true, 'path' => $path]);
            } else {
                return response()->json(['success' => false, 'message' => 'File could not be uploaded.']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'No file was provided.']);
        }
    }


    public function store(Request $request)
    {
        $data = $request->all(); // Get all input data
        $messages = [
            'firstName.required' => 'First name is required',
            'lastName.required' => 'Last name is required',
            'image.required' => 'Image is required',
            'storageType.required' => 'Storage type is required',
        ];
        
        $validatedData = $request->validate([
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'storageType' => 'required|in:space,block',
        ], $messages);

        if ($data['storageType'] === 'space') {
            $file = $request->file('image');
            $folderName = "images";
            $fileName = $file->getClientOriginalName();

            // Store the file on the 'spaces' disk
            $path = Storage::disk('spaces')->putFileAs($folderName, $file, $fileName);
            if ($path === null) {
                // Handle error, e.g., return a response or throw an exception
                return response()->json(['success' => false, 'message' => 'Path is null.']);
            }
            
            $user = User::create([
                'first_name' => $data['firstName'],
                'last_name' => $data['lastName'],
                'storage_type' => $data['storageType'],
                'image_url' => $path,
            ]);

            if(!$user) {
                return response()->json(['success' => false, 'message' => 'Cannot add']);
            }
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $user->id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'image_url' => $user->image_url,
                    'storage_type' => $user->storage_type,
                ],
                'message' => 'User created successfully.',
            ], 200);
            
            
        }
        else if ($data['storageType'] === 'block') {
            BlockImage::create([
                'image_url' => $path,
            ]);
        }
     // Redirect back to the home page
    }

    public function delete(User $user)
    {
        // Delete the file from DigitalOcean Spaces
        Storage::disk('spaces')->delete($user->image_url);

        // Delete the user from the database
        $user->delete();

        // Redirect back with a success message
        return back()->with('success', 'User deleted successfully.');
    }

    public function getuser()
    {
        $users = User::where('storage_type', 'space')->get();
        return view('file', ['users' => $users]);
    }
}