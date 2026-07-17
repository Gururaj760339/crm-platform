<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use Illuminate\Http\Request;

class CompanyController extends BaseController
{
    public function addCompany(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'industry' => 'required',
            'website' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'annual_revenue' => 'required',
            'employee_count' => 'required',
            'owner_id' => 'required'
        ]);

        try {
            Company::create([
                'name' => $request->name,
                'industry' => $request->industry,
                'website' => $request->website,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'country' => $request->country,
                'annual_revenue' => $request->annual_revenue,
                'employee_count' => $request->employee_count,
                'owner_id' => $request->owner_id
            ]);

            return $this->successMessage(true, 'Company Add Successfully', null);
        } catch (\Exception $e) {
            return $this->errorMessage(false, $e->getMessage());
        }
    }

    public function allCompanyShow()
    {
        try {
            $companyes = Company::get();
            return $this->successMessage(true, 'All Company Data Retrieve Successfully', $companyes);
        } catch (\Exception $e) {
            return $this->errorMessage(false, $e->getMessage());
        }
    }

    public function singleCompanyShow($companyId)
    {
        try {
            $companyes = Company::where('id', $companyId)->get();
            return $this->successMessage(true, 'Company Data Retrieve Successfully', $companyes);
        } catch (\Exception $e) {
            return $this->errorMessage(false, $e->getMessage());
        }
    }

    public function companyUpdate(Request $request, $companyId)
    {
        $request->validate([
            'name' => 'required',
            'industry' => 'required',
            'website' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'annual_revenue' => 'required',
            'employee_count' => 'required',
            'owner_id' => 'required'
        ]);

        try {
            Company::where('id', $companyId)->update([
                'name' => $request->name,
                'industry' => $request->industry,
                'website' => $request->website,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'country' => $request->country,
                'annual_revenue' => $request->annual_revenue,
                'employee_count' => $request->employee_count,
                'owner_id' => $request->owner_id
            ]);

            return $this->successMessage(true, 'Company Details Update Successfully', null);
        } catch (\Exception $e) {
            return $this->errorMessage(false, $e->getMessage());
        }
    }

    public function deleteCompany($comapnyId)
    {
        try {
            Company::destroy($comapnyId);
            return $this->successMessage(true, 'Company Delete Successfully', null);
        } catch (\Exception $e) {
            return $this->errorMessage(false, $e->getMessage());
        }
    }

    public function addCompanyContact(Request $request)
    {
        $request->validate([
            'company_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'job_title' => 'required',
            'address' => 'required',
            'owner_id' => 'required',
            'source' => 'required'
        ]);

        try {
            Contact::create([
                'company_id' => $request->company_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'job_title' => $request->job_title,
                'address' => $request->address,
                'owner_id' => $request->owner_id,
                'source' => $request->source
            ]);

            return $this->successMessage(true, 'Company Contact Add Successfully', null);
        } catch (\Exception $e) {
            return $this->errorMessage(false, $e->getMessage());
        }
    }
}
