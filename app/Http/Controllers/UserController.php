<?php

namespace App\Http\Controllers;
use Aws\S3\S3Client;
use App\Models\Name;
use App\Models\MyModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Http;
class UserController extends Controller
{
    public function index(){
        $response=Http::withOptions(['verify' => false])->get('https://jsonplaceholder.typicode.com/posts');
        return $response->json();
    }

    public function getPostById($id){
        $post=Http::withOptions(['verify' => false])->get('https://jsonplaceholder.typicode.com/posts/'.$id);
            return $post->json();

    }

    public function signUp(Request $request){
        $user=new Name;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->hometown=$request->hometown;

        $response=$user->save();
        return $response;


    }

    public function getData(){
        $employees=Name::all();
        return $employees;
    }

    public function deleteData($id){
        // Find the record you want to delete
$user = Name::find($id);


$user->delete();

return $user;


    }
    public function updateData($id){
        $user=Name::find($id);
        return $user;
    }
    public function updateIt(Request $request){
        $affected = Name::
              where('id', $request->id)
              ->update(['name' => $request->name,'email'=>$request->email,'hometown'=>$request->hometown]);
              return $affected;
    }
    public function postfile(Request $request){
        //$file= $request->file('image');
        //$name = $file->getClientOriginalName();
//$extension = $file->getClientOriginalExtension();
   $post= new MyModel;
   $name = $request->file('image');
   //$path = $name->store('uploads', 'public');
//    $path = Storage::disk('s3')->put('uploads', $name, 'public');

   $path = $request->file('image')->store('uploads', 'public');
   //$name= $request->file('image')->store('uploads');
   $character = "/";
   $index=strpos($path,$character);
   $new=substr($path,$index+1 );
   
   
   $post->name="sal";
   $post->filename=$new;
   $response=$post->save();
   return $new;
    }


    public function downloadfile($name){

        // $filePath = 'uploads/' . $name; // Replace with the actual path to the file in your S3 bucket

         $fileContents = Storage::disk('s3')->get('uploads/'.$name);
        // $fileName = basename($filePath);

        // $headers = [
        //     'Content-Type' => 'attachment/pdf',
        //     'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        // ];

        // return response($fileContents, 200, $headers);
        // // return $name;
        // // return $fileContents;
        //$pathToFile =$name; // path to the file you want to download in S3
        //$fileName = $name; // name of the file that will be downloaded
    
        // $fileStream = Storage::disk('s3')->readStream($pathToFile);
    
        //return Download::create($fileStream, $fileName);
        //return $fileStream;
//         $filePath ='samadhan-development/uploads/'.$name;
//     $temporaryUrl = Storage::temporaryUrl(
//         $filePath,now()->addMinutes(5)
//    );

// //     return \Response::make(Storage::disk('s3')->download(' ',$name));
//     return response()->download($temporaryUrl);


return response($fileContents, 200, [
    'Content-Type' => 'image/jpg',
    'Content-Disposition' => 'attachment; name="' . $name . '"',
]);

//return $fileContents;
        
    }

}
