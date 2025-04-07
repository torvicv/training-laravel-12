<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyController extends Controller
{
    public function index()
    {
        // Logic to display a list of companies
        $companies = Company::all();
        return Inertia('Company/Index', [
            'companies' => $companies->load(['users', 'user']),
        ]);
    }

    public function create()
    {
        // Logic to show the form for creating a new company
        return Inertia('Company/Create', [
            'users' => User::all(),
        ]);
    }

    public function store(StoreCompanyRequest $request)
    {
        // Logic to store a new company
        $validated = $request->validated();
        $company = Company::create($validated);
        return to_route('companies.index');
    }

    public function show(Company $company)
    {
        // Logic to display a specific company
        return Inertia('Company/Show', [
            'company' => $company->load(['users', 'user']),
        ]);
    }

    public function edit(Company $company)
    {
        // Logic to show the form for editing a specific company
        return Inertia('Company/Edit', [
            'company' => $company->load(['users', 'user']),
            'users' => User::all(),
        ]);
    }

    public function update(UpdateCompanyRequest $request, $id)
    {
        // Logic to update a specific company
        $validated = $request->validated();
        $company = Company::findOrFail($id);
        $company->update($validated);
        return to_route('companies.index');
    }

    public function destroy(Company $company)
    {
        // Logic to delete a specific company
        $company->delete();
        return to_route('companies.index');
    }
}
