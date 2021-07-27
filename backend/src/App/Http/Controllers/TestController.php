<?php


namespace Rodri\VotingApp\App\Http\Controllers;


use Rodri\SimpleRouter\Request;
use Rodri\SimpleRouter\Response;

class TestController
{
    public function test(Request $request): Response
    {
        return new Response([
            'message' => 'Hello authenticate user',
            'userUuid' => $request->userUuid
        ]);
    }
}