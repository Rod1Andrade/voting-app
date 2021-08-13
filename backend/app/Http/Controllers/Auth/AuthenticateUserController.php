<?php

namespace Rodri\VotingApp\App\Http\Controllers\Auth;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Rodri\VotingApp\App\Http\Security\JwToken;
use Rodri\VotingApp\App\Http\Controllers\Controller;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Email;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\Password;
use Rodri\VotingApp\Features\Auth\External\Factories\AuthUseCaseFactory;
use Rodri\VotingApp\Features\Auth\Domain\Exceptions\AuthenticateUserException;

/**
 * Controller - AuthenticateUserController
 * @author Rodrigo Andrade
 */
class AuthenticateUserController extends Controller
{
    public function invoke(Request $request): JsonResponse
    {
        $useCase = AuthUseCaseFactory::authenticateUserUseCase();
        try {
            $userUuid = $useCase(new Email($request->input('email')), new Password($request->input('password')));

            return response()->json([
                'token' => JwToken::encode([
                    'sub' => $userUuid->getValue()
                ])
            ]);

        } catch (AuthenticateUserException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (Exception) {
            return response()->json('Unknown Error: Contact TI responsible', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
