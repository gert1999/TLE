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

        $feeling = Feelings::find($id);

        if($feeling === null){
            abort(404, "Dit pagina is helaas niet gevonden");
        }

        return view('show', compact('feeling', $feeling));
    }
}
