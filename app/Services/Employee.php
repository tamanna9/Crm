<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Response;

class Employee
{
    //get companies
    public function getCompanies($request)
    {
        try {
        } catch (\Exception $e) {
            return response()->json([
                'data' => $e->getMessage(),
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
