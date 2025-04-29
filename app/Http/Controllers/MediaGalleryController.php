<?php
namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MediaGalleryController extends Controller{

	public function uploadFile(Request $request){
		$input = $request->all();
		// Log::info($input);
		if( isset($input["id"]) && $input["name"]){
			if ( $request->hasFile('uploaded_file') && $request->file('uploaded_file')->isValid()) {
				$file = $request->file('uploaded_file');
				// Uploaded file meta
				$path = $file->store('uploads');
				// Store the file
				$media = new Media();
				$media->object_name = $input["name"];
				$media->object_id = $input["id"];
				$media->name = $file->getClientOriginalName();
				$media->url = $path;
				$media->extension = $file->getClientOriginalExtension();
				$media->size = $file->getSize();
				// Need to rearrange it
				$media->sequence_no = 0;
				$media->created_by = Auth::id();
				$media->save();
				return response()->json(["status" => 1, "id" => $media->id]);
			}
			else
				return response()->json(["status" => -1]);
		}
		else
			return response()->json(["status" => -1]);
	}

	public function viewFile($mediaId, $randomId){
		$media = Media::find($mediaId);
		if( $media !== null && $media->id > 0 ){
			$filePath = $media->url;
			if( strlen($filePath) > 0 && Storage::exists($filePath) ){
				return response()->file(Storage::path($filePath), ['Content-Type', 'image/'.strtolower($media->extension)]);
			}
			else 
				return response()->json(["file" => $filePath]);
		}
	}

	public function deleteFile(Request $request){
		$input = $request->all();
		if( isset($input["image_id"]) ){
			$media = Media::find($input["image_id"]);
			$filePath = $media->url;
			if( strlen($filePath) > 0 && Storage::exists($filePath) ){
				Storage::delete($filePath);
				$media->delete();
				return response()->json(["status" => 1]);
			}
			else
				return response()->json(["status" => -1]);	
		}
		else
			return response()->json(["status" => -1]);
	}

	public function getImages(Request $request){
		$input = $request->all();
		if( isset($input["object_id"]) && isset($input["object_name"])){
			$images = Media::where('object_id', $input["object_id"])->where('object_name', $input["object_name"])->get();
			return response()->json($images);
		}
		else
			return response()->json([]);
	}
}
