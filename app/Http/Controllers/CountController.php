<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class CountController extends Controller
{
    public function count_user(){
        try {
            $count_user = User::count();

            return response()->json([
                'message' => 'User count successfully!',
                'total' => $count_user
            ]);
            // all good
        
        } catch (\Exception $e) {
          
            throw $e;
            // something went wrong
        }
        
      
    }

    public function count_department(){

        try {
            $count_department = Department::count();

            return response()->json([
                'message' => 'Department count successfully!',
                'total' => $count_department
            ]);
            // all good
        
        } catch (\Exception $e) {
        
          throw $e;
            // something went wrong
        }
        
       
    }
}
