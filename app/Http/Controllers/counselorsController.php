<?php

namespace App\Http\Controllers;

use App\Feelings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class counselorsController extends Controller
{
    function index(){

        $students = DB::table('counselors')
            ->join('students', 'counselors.id', '=', 'students.counselor_id')
            ->where('students.counselor_id', auth()->user()->id)
            ->select('students.*')
            ->get();

        return view('dashboard', compact('students', $students));
    }
    public function show($id){

//        $feeling = Feelings::find($id);
        $feeling = DB::table('feelings')
            ->where('student_id', $id)
            ->get();

        if($feeling === null){
            abort(404, "Dit pagina is helaas niet gevonden");
        }


//        $data1 = '';

//        $sql = DB::table('feelings')
//            ->where('student_id', 2)
//            ->get();
//
////        dd($sql);
//        foreach($sql as $sql1){
//
//            $data1 = $sql1->score;
//
////            $data1 = $sql1->score.'",';
////            dd($data1);
//
//        }

//        $data1 = trim($data1,",");



        return view('show', compact('feeling', 'id'));
    }
}
