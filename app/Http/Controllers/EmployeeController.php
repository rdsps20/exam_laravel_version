<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeList;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function employeeList(){
        $lists = EmployeeList::get();

        return view('employee.employee_list', ['lists' => $lists]);
    }

    public function addNewEmployee(){
        return view('employee.add_new_employee');
    }

    public function addEmployeeAction(Request $request){
        $valid = $request->validate([
            "last_name" => "required|string",
            "first_name" => "required|string",
            "middle_name" => "",
            "date_hired" => "required",
            "image_upload" => "required|image",
        ]);

        DB::beginTransaction();
        
        try{
            $image = $valid['image_upload'];
            $image_name = $image->getClientOriginalName();
            $extension = pathinfo($image_name, PATHINFO_EXTENSION);
            $filename = "storage/images/uploaded_" . time() . "." . $extension;
    
            \File::copy($image->getPathName(),$filename);

            $employee = EmployeeList::create([
                "last_name" => $valid['last_name'],
                "first_name" => $valid['first_name'],
                "middle_name" => $valid['middle_name'],
                "date_hired" => $valid['date_hired'],
                "image" => $filename,
            ]);

            DB::commit();
            return response()->json(array('message' => 'Employee Created'), 201);
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json(array('error' => 'Server Error'), 500);
        }
        
    }

    public function deleteEmployee($id){
        $employee = EmployeeList::find($id);

        $employee->delete();

        return response()->json(array('message' => 'Employee Deleted'), 200);
    }

    public function editEmployee($id){
        $employee = EmployeeList::find($id);

        return view('employee.employee_edit', ['employee' => $employee]);
    }

    public function updateEmployee(Request $request, $id){
        $valid = $request->validate([
            "last_name" => "required|string",
            "first_name" => "required|string",
            "middle_name" => "",
            "date_hired" => "required",
            "image_alter" => "",
        ]);
        $image = request('image_upload');

        $employee = EmployeeList::find($id);

        DB::beginTransaction();

        try{
            if($image){
                $image_name = $image->getClientOriginalName();
                $extension = pathinfo($image_name, PATHINFO_EXTENSION);
                $filename = "storage/images/uploaded_" . time() . "." . $extension;

                \File::copy($image->getPathName(),$filename);
            }
            else{
                $filename = $valid['image_alter'];
            }

            $employee->update([
                "last_name" => $valid['last_name'],
                "first_name" => $valid['first_name'],
                "middle_name" => $valid['middle_name'],
                "date_hired" => $valid['date_hired'],
                "image" => $filename,
            ]);

            DB::commit();
            return response()->json(array('message' => "Employee Update"), 200);
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json(array('error' => 'Server Error'), 500);
        }
    }
}
