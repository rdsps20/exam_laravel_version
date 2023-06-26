<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BranchList;
use App\Models\EmployeeList;

class BranchController extends Controller
{
    public function index(){

        return view('branch.branch_lists');
    }

    public function getBranchLists(){
        $lists = BranchList::get();

        return $lists;
    }

    public function addNewBranch(){
        $employee_lists = EmployeeList::get();

        return view('branch.add_new_branch', ['employee_lists' => $employee_lists]);
    }

    public function addNewBranchAction(Request $request){
        $valid = $request->validate([
            "branch_code" => "required|string",
            "branch_name" => "required|string",
            "address" => "required|string",
            "barangay" => "required|string",
            "city" => "required|string",
            "permit_no" => "",
            "branch_manager" => "",
            "date_opened" => "",
            "active_flag" => "",
        ]);

        DB::beginTransaction();

        try{
            $branch = BranchList::create([
                "branch_code" => $valid['branch_code'],
                "branch_name" => $valid['branch_name'],
                "address" => $valid['address'],
                "barangay" => $valid['barangay'],
                "city" => $valid['city'],
                "permit_no" => $valid['permit_no'],
                "branch_manager" => $valid['branch_manager'],
                "date_opened" => $valid['date_opened'],
                "active_flag" => $valid['active_flag'],
            ]);

            DB::commit();
            return response()->json(array('message' => 'Branch Added'), 201);
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json(array('errors' => 'Error'), 500);
        }
    }

    public function editBranch($id){
        
        $branch = BranchList::where('id', '=', $id)->first();
        $employee_lists = EmployeeList::get();

        return view('branch.edit_branch', ['branch' => $branch, 'employee_lists' => $employee_lists]);
    }

    public function updateBranch(Request $request, $id){

        $branch = BranchList::find($id);

        $valid = $request->validate([
            "branch_code" => "required|string",
            "branch_name" => "required|string",
            "address" => "required|string",
            "barangay" => "required|string",
            "city" => "required|string",
            "permit_no" => "",
            "branch_manager" => "",
            "date_opened" => "",
            "active_flag" => "",
        ]);

        DB::beginTransaction();

        try{
            $branch->update([
                "branch_code" => $valid['branch_code'],
                "branch_name" => $valid['branch_name'],
                "address" => $valid['address'],
                "barangay" => $valid['barangay'],
                "city" => $valid['city'],
                "permit_no" => $valid['permit_no'],
                "branch_manager" => $valid['branch_manager'],
                "date_opened" => $valid['date_opened'],
                "active_flag" => $valid['active_flag'],
            ]);

            DB::commit();
            return response()->json(array('message' => 'Branch Updated'), 200);
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json(array('error' => 'Error'), 500);
        }
    }

    public function deleteBranch($id){
        $branch = BranchList::find($id);

        $branch->delete();

        return response()->json(array('message' => "Branch Deleted"), 200);
    }
}
