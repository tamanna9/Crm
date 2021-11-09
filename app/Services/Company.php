<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Response;

use App\Models\{
    Company as CompanyModal
};

class Company
{
    //get companies
    public function getCompanies($request)
    {
        try {
            $companies = CompanyModal::paginate(CompanyModal::PAGE_COUNT_10);
            return $companies;

        } catch (\Exception $e) {
            return response()->json([
                'data' => $e->getMessage(),
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
