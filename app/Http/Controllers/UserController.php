<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserFormRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\StoreUser;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = User::with('department')->get();

            return response()->json(
                $user
            );

        }catch (\Exception $e) {
            throw $e;
            // something went wrong
        }
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserFormRequest $request)
    {
        try {
            DB::beginTransaction(); 
          
            $data = $request->all();

            $check = User::where('email', $data['email'])->first();

            if($check != null){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Employee already exist!'
                ]);  
            }

            $user = new User();
            $user->name = $data['name']; 
            $user->role = $data['role']; 
            $user->location = $data['location']; 
            $user->department_id = $data['department_id']; 
            $user->email = $data['email']; 
            $user->password = Hash::make($data['password']); 
            $user->mobile_no = $data['mobile_no']; 
            $user->birth_date = $data['birth_date']; 
            $user->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Employee added successfully!'
            ]);
          
        } catch (\Exception $e) {
          
          
              DB::rollback();
              throw $e;
              // something went wrong
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
       
        try {
            $request->validate([
              'department_id'
            ]);

            $data = $request->all();

            $user = User::find($id);
            $user->name = $data['name']; 
            $user->role = $data['role']; 
            $user->location = $data['location']; 
            $user->department_id = $data['department_id']; 
            $user->email = $data['email']; 
            $user->mobile_no = $data['mobile_no']; 
            $user->birth_date = $data['birth_date']; 
            $user->save();

            if($user != null){

                $user->update($data);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Employee updated successfully!'
                ]);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Employee not found!'
                ]);
            }

            
          
        } catch (\Exception $e) {
          
          
              DB::rollback();
              throw $e;
              // something went wrong
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
