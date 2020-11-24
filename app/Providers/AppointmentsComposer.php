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
        $appointments = DB::table('appointments')
            ->join('students', 'appointments.student_id', '=', 'students.id')
            ->where('appointments.counselor_id', Auth::user()->id)
            ->get();
//        $appointments = Carbon::createFromFormat('Y-m-d H:i:s', $appointments)->format('d/m/Y');

        $avatar = //AVATAR HERE
        $view->with('appointments', $appointments);
    }
}
