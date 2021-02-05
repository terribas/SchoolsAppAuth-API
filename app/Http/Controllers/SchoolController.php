<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\School;

class SchoolController extends Controller
{
    public function index(){
        //return response()->json(School::all(), 200);
        //Orden ascendente
        
        
        
        $schools = DB::table('school')
                ->select('school.*')
                ->orderByRaw('id DESC')
                ->get();
                
        return response()->json($schools, 200);
        
        //Prefiero devolver en orden descendente, para que el usuario pueda ver
        //en la primera posición del RecyclerView lo que recién haya creado 
    }
    
    
    public function school_and_teachers(){
        
        $schools = School::all();
        
        foreach($schools as $school){
            $school->teachers;
        }
        
        return response()->json($schools, 200);
    }
    

    
    
    public function store(Request $request){
        try{
            $school = School::create($request->all());
            $response=[
                'id' => $school->id,
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


    public function show($id){
        $school = School::find($id);
        return response()->json($school, 200);
    }

    

    public function update(Request $request, $id){
        $school=School::find($id);
        try{
            $affectedRows=$school->update($request->all());
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
            $affectedRows=School::destroy($id);
        }catch(\Exception $e){
            $affectedRows=0;
        }
        $response = [
            'result' => ($affectedRows > 0 ? true : false),
        ];
        return response()->json($response, 200);
    }
}
