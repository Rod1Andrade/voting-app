<?php

namespace Rodri\VotingApp\App\Http\Controllers\VotingSection;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Rodri\VotingApp\App\Http\Controllers\Controller;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;
use Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects\VotingSectionDTO;
use Rodri\VotingApp\Features\VotingSection\Domain\Exceptions\ShowVotingSectionException;
use Rodri\VotingApp\Features\VotingSection\External\Factories\VotingSectionUseCaseFactory;

/**
 * Controller - ShowVotingSectionController
 * @author Rodrigo Andrade
 */
class ShowVotingSectionController extends Controller
{
    /**
     * @param string $votingUuid
     * @return JsonResponse
     */
    public function invoke(string $votingUuid): JsonResponse
    {
        try {
            $useCase = VotingSectionUseCaseFactory::showVotingSectionUseCase();
            $response = $useCase(new VotingUuid($votingUuid));

            return response()->json(VotingSectionDTO::parserVotingToAssocArray($response));
        } catch (ShowVotingSectionException $e) {
            return response()
                ->json(['message' => $e->getMessage()])
                ->setStatusCode(Response::HTTP_BAD_REQUEST);
        }
    }
}
