<?php

namespace App\Http\Controllers;

use App\Models\records;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportsController extends Controller
{
  private $data;

  public function show_reports(){
    $this->show_user_reg_history();
    $this->show_verified_user_data();
    //dd($this->data);
    return view('report', $this->data);
  }

  public function show_user_reg_history()
  {
    $record = records::select(DB::raw("COUNT(*) as count"), DB::raw("DAYNAME(created_at) as day_name"), DB::raw("DAY(created_at) as day"))
      ->where('created_at', '>', Carbon::today()->subDay(6))
      ->groupBy('day_name', 'day')
      ->orderBy('day')
      ->get();

    $user_reg_history = [];

    foreach ($record as $row) {
      $user_reg_history['label'][] = $row->day_name;
      $user_reg_history['data'][] = (int) $row->count;
    }

    $this->data['chart_data'] = json_encode($user_reg_history);
  }

  public function show_verified_user_data(){

    $query = DB::raw("(CASE WHEN is_email_verified='1' THEN 'Verified'  ELSE 'Un-Verified' END) as status");
    $record = DB::table('records')->select(DB::raw("COUNT(*) as count"), $query)->groupBy('status')->get();

    $verified_user_data = [];

    foreach ($record as $row) {
      $verified_user_data['label'][] = $row->status;
      $verified_user_data['data'][] = (int) $row->count;
    }

    $this->data['isEmailVerified_data'] = json_encode($verified_user_data);    
  }

  public function user_login_report(){
    //dd($_SERVER['REMOTE_ADDR']);
  }
}
