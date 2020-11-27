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

        DB::table('appointments')->insert([
            ['student_id' => 2, 'counselor_id' => auth()->user()->id, 'attending' => 0, 'subject' => '', 'start_time' => $datum_tijd_start, 'end_time' => $datum_tijd_end]
        ]);
    }

    function fetch(Request $request){
        if($request->get('query')){
            $query = $request->get('query');

            $data = DB::table('students')
                    ->where('first_name', 'LIKE', $query)
                    ->get();

            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';

            foreach($data as $row){
                $output .= '<a href="#"><li>' .$row->first_name. ' ' .$row->last_name. '</li></a><input value="' .$row->id. '" name="student_id">';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
}
