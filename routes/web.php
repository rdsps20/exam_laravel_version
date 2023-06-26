<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Branch Routes 
Route::get('/index', [BranchController::class, 'index'])->name('index');
Route::get('/get_branch_lists', [BranchController::class, 'getBranchLists'])->name('get_branch_lists');

Route::get('/add_new_branch', [BranchController::class, 'addNewBranch'])->name('add_new_branch');
Route::post('/add_new_branch_action', [BranchController::class, 'addNewBranchAction'])->name('add_new_branch_action');

Route::get('/edit_branch/{id}', [BranchController::class, 'editBranch'])->name('edit_branch');
Route::post('/update_branch/{id}', [BranchController::class, 'updateBranch'])->name('update_branch');

Route::post('/delete_branch/{id}', [BranchController::class, 'deleteBranch'])->name('delete_branch');

//Employee Routes
Route::get('/employee_list', [EmployeeController::class, 'employeeList'])->name('employee_list');

Route::get('/add_new_employee', [EmployeeController::class, 'addNewEmployee'])->name('add_new_employee');
Route::get('/edit_employee/{id}', [EmployeeController::class, 'editEmployee'])->name('edit_employee');
Route::post('/add_employee_action', [EmployeeController::class, 'addEmployeeAction'])->name('add_employee_action');
Route::post('/delete_employee/{id}', [EmployeeController::class, 'deleteEmployee'])->name('delete_employee');
Route::post('/update_employee/{id}', [EmployeeController::class, 'updateEmployee'])->name('update_employee');

