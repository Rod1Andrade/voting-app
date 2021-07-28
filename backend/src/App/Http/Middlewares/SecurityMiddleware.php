<?php


namespace Rodri\VotingApp\App\Http\Middlewares;


use Rodri\SimpleRouter\Helpers\StatusCode;
use Rodri\SimpleRouter\Middlewares\MiddlewareInterface;
use Rodri\SimpleRouter\Request;
use Rodri\SimpleRouter\Response;
use Rodri\VotingApp\App\Http\Exceptions\InvalidTokenException;
use Rodri\VotingApp\App\Http\Security\JwToken;

/**
 * Class SecurityMiddleware
 * @package Rodri\VotingApp\App\Http\Middlewares
 * @author Rodrigo Andrade
 */
class SecurityMiddleware implements MiddlewareInterface
{

    public function run(Request $request): bool|Response
    {
        try {
            $payload = JwToken::decode($request->authorization());
            $request->addValue('userUuid', $payload->sub);
        } catch (InvalidTokenException) {
            return new Response(Response::NONE_RESPONSE, StatusCode::FORBIDDEN);
        }

        return true;
    }
}