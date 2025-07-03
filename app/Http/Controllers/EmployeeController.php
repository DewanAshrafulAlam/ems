<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
   public function index()
    {
        return response()->json(Employee::all());
    }

  public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'designation' => 'required|string',
        'organization' => 'required|string',
        'email' => 'required|string',
        'mobile' => 'required|string',
    ]);

    $employee = new Employee();
    $employee->name = $request->name;
    $employee->designation = $request->designation;
    $employee->organization = $request->organization;
    $employee->email = $request->email;
    $employee->mobile = $request->mobile;
    $employee->save();

    return response()->json(['message' => 'Employee created successfully'], 201);
}
public function show($id)
{
    $employee = Employee::findOrFail($id);
    return response()->json($employee);
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'designation' => 'required|string|max:255',
        'organization' => 'required|string|max:255',
        'email' => 'required|email',
        'mobile' => 'required|string|max:20',
    ]);

    $employee = Employee::findOrFail($id);
    $employee->update($request->all());

    return response()->json(['message' => 'Employee updated successfully']);
}
}
