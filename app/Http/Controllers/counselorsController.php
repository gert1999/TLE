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

        $studentID = DB::table('counselors')
            ->join('students', 'counselors.id', '=', 'students.counselor_id')
            ->where('students.counselor_id', auth()->user()->id)
            ->first();



        $feelings = DB::table('feelings')
            ->where('student_id', $studentID->id)
            ->get();
$feelingArray = [];

        $feeling = 0;
foreach ($feelings as $data) {
    $inbetween = $data->score;

    $feelingArray[] = $inbetween;
}
        if(count($feelingArray)>=3) {
            for ($i = count(($feelingArray)) - 3; $i < count($feelingArray); $i++) {
                if ($feelingArray[$i] < 3) {
                    $feeling++;
                }

            }
        }


        return view('dashboard', compact('students', 'feeling'));

    }
    public function show($id){

//        $feeling = Feelings::find($id);
        $feeling = DB::table('feelings')
            ->where('student_id', $id)
            ->orderBy('id', 'DESC')
            ->get();

        if($feeling === null){
            abort(404, "Dit pagina is helaas niet gevonden");
        }
        $student = DB::table('students')
            ->where('id', $id)
            ->get();

        return view('show', compact('feeling', 'id', 'student'));
    }
    public function info($id){

        $students = DB::table('students')
            ->where('id', $id)
            ->get();

        return view('info', compact(  'students'));
    }
}
