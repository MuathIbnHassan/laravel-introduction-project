<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Employee;
use App\Company;


class EmployeesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO create view

        $employees = Employee::paginate(9);
        return view('employees/employees')->with('employees', $employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $url = \Request::fullUrl();
        parse_str(parse_url($url, PHP_URL_QUERY), $param);
        if (array_key_exists("company_id", $param)) {
            $company_id = $param["company_id"];
        } else {
            $company_id = "";
        }



        //TODO send company_id to view and make it defulte selection



        $companies = Company::all();
        return view('employees/create_employee', compact('companies', 'company_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee = new Employee;

        $validator = Validator::make($request->all(), [
            'first_name'    =>  'required',
            'last_name'     =>  'required',
            'email'         =>  'nullable|email|unique:employees,email',
            'phone'         =>  'nullable|unique:employees,phone|regex:/0?(00966)?(\+966)?5\d{8}/'
        ]);




        if ($validator->fails()) {
            $validator->messages()->keys();

            return redirect('employees/create')->with(['error' => 'The Input Values are not meeting requierments, ' . $validator->messages()->first()])->withInput(
                $request->except($validator->messages()->keys())
            );
        }



        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;

        $employee->company_id = $request->company_id;

        $employee->save();
        response()->json(array('success' => true, 'last_insert_id' => $employee->id), 200);

        return redirect('employees/' . $employee->id)->with(['status' => 'Employee\'s Profile Created successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //TODO create view

        $employee = Employee::findOrFail($id);
        return view('employees/show_employee')->with([
            'employee'  =>  $employee,
            'company'   => $employee->company->name
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view("employees/edit_employee")->with('employee', $employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //TODO

        $employee = Employee::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'first_name'    =>  'required',
            'last_name'     =>  'required',
            'email'         =>  'nullable|email|unique:employees,email',
            'phone'         =>  'nullable|unique:employees,phone|regex:/0?(00966)?(\+966)?5\d{8}/'
        ]);




        if ($validator->fails()) {
            $validator->messages()->keys();

            return redirect('employees/' . $id . '/edit')->with(['error' => 'The Input Values are not meeting requierments, ' . $validator->messages()->first()]);
        }


        try {
            $employee->company_id = $request->company_id;
        } catch (\Throwable $th) {
            return redirect('employees/' . $id . '/edit')->with(['error' => 'Company not Found.']);
        }




        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;



        $employee->save();
        response()->json(array('success' => true, 'last_insert_id' => $employee->id), 200);

        return redirect('employees/' . $employee->id)->with(['status' => 'Employee\'s Profile Created successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Employee::destroy($id);
        return redirect('employees')->with(['status' => 'Employee\'s Profile Deleted successfully.']);
    }
}
