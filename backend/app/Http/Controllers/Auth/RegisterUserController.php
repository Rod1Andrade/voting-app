<?php

namespace Rodri\VotingApp\App\Http\Controllers\Auth;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Rodri\VotingApp\App\Http\Controllers\Controller;
use Rodri\VotingApp\Features\Auth\Domain\Exceptions\RegisterUserException;
use Rodri\VotingApp\Features\Auth\External\Factories\AuthUseCaseFactory;
use Rodri\VotingApp\Features\Auth\Infra\DataTransferObjects\UserDTO;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/**
 * Controller - RegisterUserController
 * @author Rodrigo Andrade
 */
class RegisterUserController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function invoke(Request $request): JsonResponse
    {
        $userDTO = UserDTO::factoryUserDTOFromStdClass((object) $request->all());
        $useCase = AuthUseCaseFactory::registerUserUseCase();

        try {
            $useCase(UserDTO::FactoryUserFromDTO($userDTO));

            return response()
                ->json()
                ->setStatusCode(ResponseAlias::HTTP_CREATED);

        } catch (RegisterUserException $e) {
            return response()->json(['message' => $e->getMessage()], ResponseAlias::HTTP_BAD_REQUEST);
        } catch (Exception) {
            return response()->json('Unknown Error: Contact TI responsible', ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
