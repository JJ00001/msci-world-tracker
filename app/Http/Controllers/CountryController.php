<?php

namespace App\Http\Controllers;

use App\Http\Services\WeightHistory\CountryWeightHistoryStrategy;
use App\Http\Services\WeightHistory\WeightHistoryService;
use App\Models\Country;
use Inertia\Inertia;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::withStats()
            ->orderByDesc('weight')
            ->get();

        return inertia('Country/CountryIndex', [
            'countries' => $countries,
        ]);
    }

    public function show(Country $country)
    {
        $weightHistoryService = new WeightHistoryService(new CountryWeightHistoryStrategy());
        $weightHistory = $weightHistoryService->getWeightHistory($country->id);

        $countryCompanies = $country
            ->companies()
            ->orderBy('rank')
            ->paginate();

        return inertia('Country/CountryShow', [
            'country' => $country,
            'weightHistory' => $weightHistory,
            'companies' => Inertia::merge($countryCompanies),
            'nextCompaniesPage' => request()->input('page', 1) + 1,
        ]);
    }
}
