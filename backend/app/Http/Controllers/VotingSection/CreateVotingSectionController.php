<?php

namespace Rodri\VotingApp\App\Http\Controllers\VotingSection;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateVotingSectionController
{
    public function invoke(Request $request): JsonResponse
    {
        return response()->json()->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
