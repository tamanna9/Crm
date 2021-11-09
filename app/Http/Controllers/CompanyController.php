<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{
    Company as CompanyModal
};
use Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = CompanyModal::paginate(CompanyModal::PAGE_COUNT_10);
        return view('company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required'], ['name.required' => trans('message.name_is_requried')]);

        $status = '';
        if ($request->get('type') == 'update') {
            $this->update($request);
        } else {
            if ($request->has('logo')) {

                $fileName = time() . '.' . $request->logo->extension();
                $file = $request->file('logo');
                $uploadedFile = $request->file('logo');
                if ($uploadedFile->isValid()) {
                    $uploadedFile->storeAs('logos', $fileName, 'public');
                }
            }
            $companyCreated = CompanyModal::create([
                "name" => $request->get('name'),
                "email" => $request->get('email'),
                "website" => $request->get('website'),
                "address" => $request->get('address'),
                'logo' => $request->logo != NULL ?  public_path('logo') . $fileName : null
            ]);
            if ($companyCreated) {
                $status = "Success";
            }
        }



        $companies = CompanyModal::paginate(CompanyModal::PAGE_COUNT_10);

        $html = view('company.table', compact('companies'))->render();
        return [
            'html' => $html,
            'status' => $status ? $status : 'danger',
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = CompanyModal::find($id);
        $html = view('company.edit_modal', compact('company'))->render();
        return [
            'html' => $html,
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($request)
    {
        if ($request->has('logo')) {
            $fileName = time() . '.' . $request->logo->extension();
            $file = $request->file('logo');
            $uploadedFile = $request->file('logo');
            if ($uploadedFile->isValid()) {
                $uploadedFile->storeAs('logos', $fileName, 'public');
            }
        }
        $companyUpdated = CompanyModal::where('id', $request->companyId)->update([
            "name" => $request->get('name'),
            "email" => $request->get('email'),
            "website" => $request->get('website'),
            "address" => $request->get('address'),
            'logo' => $request->logo != NULL ?  public_path('logo') . $fileName : null
        ]);
        if ($companyUpdated) {
            $status = "Success";
        }
        $companies = CompanyModal::paginate(CompanyModal::PAGE_COUNT_10);

        $html = view('company.table', compact('companies'))->render();
        return [
            'html' => $html,
            'status' => $status ? $status : 'danger',
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = CompanyModal::find($id);
        if ($company) {
            $companyDeleted = $company->delete();
            if ($companyDeleted) {
                $status = "Success";
            }
        }
        $companies = CompanyModal::paginate(CompanyModal::PAGE_COUNT_10);

        $html = view('company.table', compact('companies'))->render();
        return [
            'html' => $html,
            'status' => $status ? $status : 'danger',
        ];
    }
}
