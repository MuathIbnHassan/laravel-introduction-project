<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;
use App\Company;
use App\Employee;

class CompaniesController extends Controller
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
        $companies = Company::paginate(6);
        return view('companies/companies')->with('companies', $companies);
    }

    /**
     * Show the form for creting a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view("companies/create_company");
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $company = new Company;
        $company->name = $request->name;





        $validator = Validator::make($request->all(), [
            'name'      =>  'required|unique:companies,name',
            'email'     =>  'nullable|email|unique:companies,email',
            'logo'      =>  'nullable|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
            'website'   =>  'nullable|regex:/.*\..*/'
        ]);

        if ($validator->fails()) {
            return redirect('companies/create')->with(['error' => 'The Input Values are not meeting requierments, ' . $validator->messages()->first()])->withInput(
                $request->except($validator->messages()->keys())
            );
        }

        if ($request->has('logo')) {
            $fileName = $request->name . '.' .  $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->storeAs(
                'public',
                $fileName
            );
            $company->logo = $fileName;
        }



        $company->email = $request->email;

        $company->website = $request->website;

        $company->save();
        response()->json(array('success' => true, 'last_insert_id' => $company->id), 200);

        return redirect('companies/' . $company->id)->with(['status' => 'Companies\'s Profile Created successfully.']);
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

        $company = Company::findOrFail($id);

        return view('companies/show_company')->with('company', $company);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //TODO
        $company = Company::findOrFail($id);
        return view("companies/edit_company")->with('company', $company);
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
        //TODO: add other Company attribute, handle partially updates, optimizing the code

        $company = Company::findOrFail($id);


        $validator = Validator::make($request->all(), [
            'name'              =>  'required',
            'logo'      =>  'mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100'
        ]);

        if ($validator->fails()) {
            return redirect('companies/create')->with(['error' => 'The Input Values are not meeting requierments, ' . $validator->messages()->first()]);
        }



        if ($request->has('logo')) {

            if (($company->logo != NULL) and (file_exists(("/home/vagrant/FirstTask2.0/storage/app/public/" . $company->logo)))) {
                unlink(("/home/vagrant/FirstTask2.0/storage/app/public/" . $company->logo));
            }

            $fileName = $request->name . '.' .  $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->storeAs(
                'public',
                $fileName
            );

            $company->logo = $fileName;
        }
        $company->name = $request->name;
        $company->email = $request->email;

        $company->website = $request->website;

        $company->save();
        return redirect('companies/' . $company->id)->with(['status' => 'Companies\'s Profile Updated successfully.']);
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
        $company = Company::findOrFail($id);


        if (file_exists(("/home/vagrant/FirstTask2.0/storage/app/public/" . $company->logo))) {
            unlink(("/home/vagrant/FirstTask2.0/storage/app/public/" . $company->logo));
        }

        Employee::destroy($company->employees->pluck('id'));
        Company::destroy($id);

        return redirect('companies')->with(['status' => 'Companies\'s Profile Deleted successfully.']);
    }
}
