<?php


namespace App\Providers;


use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AppointmentsComposer
{
    public function compose(View $view)
    {
        if(Auth::check()) {
            $appointments = DB::table('appointments')
                ->join('students', 'appointments.student_id', '=', 'students.id')
                ->where('appointments.counselor_id', Auth::user()->id)
                ->get();


            $appointments2 = DB::table('appointments')
                ->join('students', 'appointments.student_id', '=', 'students.id')
                ->where('appointments.counselor_id', Auth::user()->id)
                ->count();
            //        $appointments = Carbon::createFromFormat('Y-m-d H:i:s', $appointments)->format('d/m/Y');

            $counselors = Auth::user()->id;
            $avatar = //AVATAR HERE
            $view->with('appointments', $appointments);
            $view->with('appointments2', $appointments2);
            $view->with('counselors', $counselors);
        }
    }
}
