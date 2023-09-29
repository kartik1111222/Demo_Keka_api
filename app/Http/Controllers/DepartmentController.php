<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function depart_all(){

        try {
            $department = Department::all();

            return response()->json(
               $department
            );
              // all good
          
          } catch (\Exception $e) {
          
          
         
              throw $e;
              // something went wrong
          }
        
    }
}
