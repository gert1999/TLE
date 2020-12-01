<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class calendarController extends Controller
{
    public function index(){

        return view('agenda.calendar');
    }

    public function load(){
        $data = array();

        $events= DB::table('appointments')
            ->join('students', 'appointments.student_id', '=', 'students.id')
            ->where('appointments.counselor_id', auth()->user()->id)
//            ->select('students.*')
            ->get();

        foreach($events as $row)
        {
            $data[] = array(
                'id'   => $row->id,
                'title'   => $row->first_name. ' ' .$row->last_name,
                'start'   => $row->start_time,
                'end'   => $row->end_time
            );
        }

        echo json_encode($data);
//        dd($json_data);
    }

    public function insert(Request $request ){
        $datum = $request->input('datum');
        $start_time = $request->input('start_time');
        $end_time = $request->input('end_time');

        $datum_tijd_start = $datum. ' ' .$start_time;
        $datum_tijd_end = $datum. ' ' .$end_time;

        $student = $request->input('student');

        $student_id = DB::table('students')
                        ->select("*", DB::raw("CONCAT('first_name', 'last_name') AS $student"))
//                        ->where('first_name', $request->input('student'))
                        ->get();

        foreach($student_id as $row) {
            DB::table('appointments')->insert([
                ['student_id' => $row->id, 'counselor_id' => auth()->user()->id, 'attending' => 0, 'subject' => '', 'start_time' => $datum_tijd_start, 'end_time' => $datum_tijd_end]
            ]);
        }
    }

    function fetch(Request $request){
        if($request->get('query')){
            $query = $request->get('query');

            $data = DB::table('students')
                    ->where('first_name', 'LIKE', "%{$query}%")
                    ->orWhere('last_name', 'LIKE', "%{$query}%")
                    ->get();

            $output = '<ul class="dropdown-menu" style="display:block;position: absolute;margin-top:-313px;width:94%;margin-left:10px;padding-left:10px;">';

            foreach($data as $row){
                $output .= '<li style="cursor:pointer;">' .$row->first_name. ' ' .$row->last_name. '</li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    function edit(Request $request){

        $start_time = $request->input('datum2'). ' ' .$request->input('start_time2');

        $end_time = $request->input('datum2'). ' ' .$request->input('end_time2');

        $student_id = $request->input('student_id');

        DB::table('appointments')
            ->where('student_id',  $student_id)
            ->update(['start_time' => $start_time, 'end_time' => $end_time]);
    }

    function delete(Request $request){
        DB::table('appointments')->where('student_id', $request->input('student_id2'))->delete();
    }
}
