<?php

namespace Rodri\VotingApp\App\Http\Controllers\Vote;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Rodri\VotingApp\App\Http\Controllers\Controller;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\VotingUuid;
use Rodri\VotingApp\Features\Vote\Domain\Exceptions\UserVoteException;
use Rodri\VotingApp\Features\Vote\Domain\ValueObjects\VotingOptionUuid;
use Rodri\VotingApp\Features\Vote\External\Factories\VoteUseCaseFactory;

/**
 * Controller - UseVoteController
 * @author Rodrigo Andrade
 */
class UserVoteController extends Controller
{
    /**
     * @param string $votingUuid
     * @param string $votingOptionUuid
     * @return JsonResponse
     */
    public function invoke(string $votingUuid, string $votingOptionUuid): JsonResponse
    {
        try {
            $useCase = VoteUseCaseFactory::userVoteUseCase();

            $useCase(
                new UserUuid(Auth::id()),
                new VotingUuid($votingUuid),
                new VotingOptionUuid($votingOptionUuid)
            );

            return response()->json(['message' => 'Vote registered with success.']);
        } catch (UserVoteException $e) {
            return response()
                ->json(['message' => $e->getMessage()])
                ->setStatusCode(Response::HTTP_BAD_REQUEST);
        } catch (\Exception) {
            return response()
                ->json(['message' => 'Unknown Error: Contact TI responsible'])
                ->setStatusCode(Response::HTTP_BAD_GATEWAY);
        }
    }
}
