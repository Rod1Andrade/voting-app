<?php

namespace Rodri\VotingApp\App\Http\Controllers\VotingSection;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Rodri\VotingApp\Features\VotingSection\Domain\Exceptions\DeleteVotingSectionException;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;
use Rodri\VotingApp\Features\VotingSection\External\Factories\VotingSectionUseCaseFactory;
use Symfony\Component\HttpFoundation\Response;
use Rodri\VotingApp\App\Http\Controllers\Controller;

/**
 * Controller - ShowVotingSectionController
 * @author Rodrigo Andrade
 */
class DeleteVotingSectionController extends Controller
{
    /**
     * @param string $votingUuid
     * @return JsonResponse
     */
    public function invoke(string $votingUuid): JsonResponse
    {
        try {
            $useCase = VotingSectionUseCaseFactory::deleteVotingSectionUseCase();
            $useCase(new VotingUuid($votingUuid), new UserUuid(Auth::id()));
            
            return response()->json()->setStatusCode(Response::HTTP_NO_CONTENT);
        } catch (DeleteVotingSectionException $e) {
            return response()
                ->json(['message' => $e->getMessage()])
                ->setStatusCode(Response::HTTP_BAD_REQUEST);
        }
    }
}
