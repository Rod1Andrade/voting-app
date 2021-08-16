<?php

namespace Rodri\VotingApp\App\Http\Controllers\Vote;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Rodri\VotingApp\App\Http\Controllers\Controller;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\VotingUuid;
use Rodri\VotingApp\Features\Vote\Infra\DataTransferObjects\VoteDTO;
use Rodri\VotingApp\Features\Vote\External\Factories\VoteUseCaseFactory;
use Rodri\VotingApp\Features\Vote\Domain\Exceptions\VoteResultException;

/**
 * Controller - VoteResultController
 * @author Rodrigo Andrade
 */
class VoteResultController extends Controller
{
    /**
     * @param string $votingUuid
     * @return JsonResponse
     */
    public function invoke(string $votingUuid): JsonResponse
    {
        try {
            $voteResultUseCase = VoteUseCaseFactory::voteResultUseCase();
            $response = $voteResultUseCase(new VotingUuid($votingUuid));

            return response()
                ->json(VoteDTO::parserVoteToAssocArray($response))
                ->setStatusCode(Response::HTTP_OK);
        } catch (VoteResultException $e) {
            return response()
                ->json(['message' => $e->getMessage()])
                ->setStatusCode(Response::HTTP_BAD_REQUEST);
        } catch (Exception) {
            return response()
                ->json(['message' => 'Unknown Error: Contact TI responsible'])
                ->setStatusCode(Response::HTTP_BAD_GATEWAY);
        }
    }
}
