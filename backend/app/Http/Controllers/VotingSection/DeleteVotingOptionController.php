<?php

namespace Rodri\VotingApp\App\Http\Controllers\VotingSection;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Rodri\VotingApp\Features\VotingSection\Domain\Exceptions\DeleteVotingOptionException;
use Symfony\Component\HttpFoundation\Response;
use Rodri\VotingApp\App\Http\Controllers\Controller;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;
use Rodri\VotingApp\Features\VotingSection\External\Factories\VotingSectionUseCaseFactory;

/**
 * Controller - DeleteVotingOptionController
 * @author Rodrigo Andrade
 */
class DeleteVotingOptionController extends Controller
{
    /**
     * @param string $votingOptionUuid
     * @return JsonResponse
     */
    public function invoke(string $votingOptionUuid): JsonResponse
    {
        try {
            $useCase = VotingSectionUseCaseFactory::deleteVotingOptionUseCase();
            $useCase(new VotingOptionUuid($votingOptionUuid), new UserUuid(Auth::id()));
            return response()->json()->setStatusCode(Response::HTTP_NO_CONTENT);
        } catch (DeleteVotingOptionException $e) {
            return response()
                ->json(['message' => $e->getMessage()])
                ->setStatusCode(Response::HTTP_BAD_REQUEST);
        } catch (Exception) {
            return response()
                ->json(['message' => 'Unknown Error: Contact TI responsible'])
                ->setStatusCode(Response::HTTP_BAD_REQUEST);
        }
    }
}
