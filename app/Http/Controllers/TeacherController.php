<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Teacher;
use Validator,Redirect,Response,File;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{

    public function index(){
        //return response()->json(Teacher::all(), 200);
        
        $teachers = DB::table('teacher')
                ->select('teacher.*')
                ->orderByRaw('id DESC')
                ->get();
                
        return response()->json($teachers, 200);
    }




    public function store(Request $request){
        try{
            $teacher = Teacher::create($request->all());
            $response=[
                'id' => $teacher->id,
                'result' => true,
            ];
        }catch(\Exception $e){
            $response=[
                'result' => false,
                'message' => $e->getMessage(),
            ];
        }
        return response()->json($response, 200);
    }
    
    
    
    public function save_image(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
        if ($validator->fails()) {
            $response = [
                "result" => false,
                "url" => '',
            ];
            
        }else{
            $uploadFolder = 'images';
            $image = $request->file('image');
            $image_uploaded_path = $image->store($uploadFolder, 'public');
            $response = [
                "result" => true,
                "url" => Storage::disk('public')->url($image_uploaded_path),
            ];
        }
        
        return response()->json($response, 200);
    }
    
    
    
    
    public function teachers_of($id){
        $teachers = DB::table('teacher')
            ->select('teacher.*')
            ->where('teacher.school_id', '=', $id)
            ->orderByRaw("(teacher.name = 'Carmelo') DESC, teacher.id DESC")
            ->get();
        
        return response()->json($teachers, 200);
    }

    
    public function show($id){
        $teacher = Teacher::find($id);
        return response()->json($teacher, 200);
    }



    public function update(Request $request, $id){
        $teacher=Teacher::find($id);
        try{
            $affectedRows=$teacher->update($request->all());
        }catch(\Exception $e){
            $affectedRows=0;
        }
        $response = [
            'result' => ($affectedRows > 0 ? true : false),
        ];
        return response()->json($response, 200);
    }


    public function destroy($id){
        try{
            $affectedRows=Teacher::destroy($id);
        }catch(\Exception $e){
            $affectedRows=0;
        }
        $response = [
            'result' => ($affectedRows > 0 ? true : false),
        ];
        return response()->json($response, 200);
    }
}
