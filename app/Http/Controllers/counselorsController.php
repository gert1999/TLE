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

        $studentNumber = DB::table('students')
            ->where('status', 'active')
            ->get();

//        dd($studentID->id);
        if($studentID== Null){
            $students = [];
            $feeling = [];
            $studentNumber = [];
            return view('dashboard', compact('students', 'feeling', 'studentNumber'));
        }else {
            $feelings = DB::table('feelings')
                ->where('student_id', $studentID->id)
                ->get();


            $feelingArray = [];
            $feelingID = [];
            foreach ($studentNumber as $stuff) {
                $studentCount = $stuff->id;
            }
            $feeling = [];
            for ($c = 0; $c < $studentCount+1; $c++) {
                $feeling[] = 0;
            }
            foreach ($feelings as $data) {
                $inbetween = $data->score;
                $IDbetween = $data->student_id;
                $feelingArray[] = $inbetween;
                $feelingID[] = $IDbetween;
            }
            if (count($feelingArray) >= 3) {
                for ($i = count(($feelingArray)) - 3; $i < count($feelingArray); $i++) {
                    if ($feelingArray[$i] < 3) {
                        $feeling[$feelingID[$i]] = $feeling[$feelingID[$i]] + 1;
                    } else {
                        $feeling[$feelingID[$i]] = 0;
                    }

                }
            }


            return view('dashboard', compact('students', 'feeling', 'studentNumber'));
        }
    }
    public function show($id){

//        $feeling = Feelings::find($id);
        $feeling = DB::table('feelings')
            ->where('student_id', $id)
            ->orderBy('id', 'DESC')
            ->paginate(8);

        if($feeling === null){
            abort(404, "Dit pagina is helaas niet gevonden");
        }
        $student = DB::table('students')
            ->where('id', $id)
            ->get();

        return view('show', compact('feeling', 'id', 'student'));
    }

    public function delete($id){

//        $feeling = Feelings::find($id);
        DB::table('students')
            ->where('id', $id)
            ->update(['status' => 'inactive']);

        return redirect('/dashboard');
    }

    public function info($id){

        $students = DB::table('students')
            ->where('id', $id)
            ->get();

        return view('info', compact(  'students'));
    }
}
