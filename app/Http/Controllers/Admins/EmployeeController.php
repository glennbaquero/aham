<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Employee;
use DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.employee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
            $employee = Employee::store($request);
        DB::commit();
        
        return response()->json([
            'message' => 'You have successfully create the employee info',
            'redirect' => $employee->renderView(),
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.employee.edit', [
            'employee' => Employee::withTrashed()->find($id)
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::withTrashed()->find($id);

        DB::beginTransaction();
            $employee = Employee::store($request, $employee);
        DB::commit();

        return response()->json([
            'message' => "You have successfully updated the employee info",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();

        return response()->json([
            'message' => "You have successfully archived this item",
        ]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $employee = Employee::onlyTrashed()->find($id);
        $employee->restore();

        return response()->json([
            'message' => "You have successfully restored the employee",
        ]);
    }
}
