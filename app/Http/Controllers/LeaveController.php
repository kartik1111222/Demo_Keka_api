<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Requests\Addleaverequest;

class LeaveController extends Controller
{
  public function add_leave(Addleaverequest $request)
  {
    try {
      DB::beginTransaction(); 
      $data = $request->all();

      $role = $data['is_role'];
  
      if ($role == '0') {
  
        $leave = new Leave();
        $leave->start_date = Carbon::parse($data['start_date']);
        $leave->end_date = Carbon::parse($data['end_date']);
        $leave->reason = $data['reason'];
        $leave->user_id = $data['user_id'];
        $leave->status = '1';
        $leave->save();
      } else {
  
        $leave = new Leave();
        $leave->start_date = $data['start_date'];
        $leave->end_date = $data['end_date'];
        $leave->reason = $data['reason'];
        $leave->user_id = $data['user_id'];
        $leave->status = '0';
        $leave->save();
      }
  
        DB::commit();
        // all good

        return response()->json([
          'message' => 'Leave added successfully!'
        ]);
    
    } catch (\Exception $e) {
    
    
        DB::rollback();
        throw $e;
        // something went wrong
    }

  }


  public function all_leaves()
  {
    try {
      $leaves = Leave::with('user')->where('status', '0')->get();

    return response()->json(
      $leaves
    );
        // all good
    
    } catch (\Exception $e) {
    
    
       
        throw $e;
        // something went wrong
    }



  
  }

  public function update_leave_status(Request $request, $id)
  {


    try {
      DB::beginTransaction(); 

      $data = $request->validate([
       'status' => 'required'
      ]);

      $data = $request->all();

      $leave = Leave::find($id);
      $leave->status = $data['status'];
      $leave->save();
  
      return response()->json([
        'message' => 'Leave status updated!'
      ]);
        DB::commit();
        // all good
    
    } catch (\Exception $e) {
    
    
        DB::rollback();
        throw $e;
        // something went wrong
    }



 
  }

  public function today_leave_list()
  {

    try {
      $current_date = date('Y-m-d');
      // dd($current_date);
      $today_leave = Leave::whereRaw('"' . $current_date . '" between `start_date` and `End_date`')->with('user')->get();
    
      return response()->json(
          $today_leave
        );
        // all good
    
    } catch (\Exception $e) {
     
      throw $e;
        // something went wrong
    }

  
   
  }

  public function filter_leave_date(Request $request){

    try {
      $date = $request->input('date');
      $leave_date =  Leave::whereRaw('"' . $date . '" between `start_date` and `End_date`')->with('user')->get();
  
      return response()->json(
        $leave_date
      );
        // all good
    
    } catch (\Exception $e) {
    
      throw $e;
        // something went wrong
    }
    
   
  }
}
