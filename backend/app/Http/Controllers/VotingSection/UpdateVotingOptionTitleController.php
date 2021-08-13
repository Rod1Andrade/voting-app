<?php

namespace Rodri\VotingApp\App\Http\Controllers\VotingSection;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Rodri\VotingApp\Features\VotingSection\Domain\Exceptions\UpdateVotingTitleException;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\Title;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingOptionUuid;
use Rodri\VotingApp\Features\VotingSection\External\Factories\VotingSectionUseCaseFactory;
use Symfony\Component\HttpFoundation\Response;
use Rodri\VotingApp\App\Http\Controllers\Controller;

/**
 * Controller - UpdateVotingOptionTitleController
 * @author Rodrigo Andrade
 */
class UpdateVotingOptionTitleController extends Controller
{
    /**
     * @param string  $votingOptionUuid
     * @param Request $request
     * @return JsonResponse
     */
    public function invoke(string $votingOptionUuid, Request $request): JsonResponse
    {
        if(!$this->isValid($votingOptionUuid, $request)) {
            return response()
                ->json(['message' => 'Please. Send the require values: Voting Option Uuid and title.'])
                ->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        try {
            $useCase = VotingSectionUseCaseFactory::updateVotingOptionTitleUseCase();
            $useCase(
                new Title($request->input('title')),
                new VotingOptionUuid($votingOptionUuid),
                new UserUuid(Auth::id())
            );
            return response()->json()->setStatusCode(Response::HTTP_NO_CONTENT);
        } catch (UpdateVotingTitleException $e) {
            return response()
                ->json(['message' => $e->getMessage()])
                ->setStatusCode(Response::HTTP_BAD_REQUEST);
        } catch (\Exception) {
            return response()
                ->json(['message' => 'Unknown Error: Contact TI responsible'])
                ->setStatusCode(Response::HTTP_BAD_GATEWAY);
        }
    }

    /**
     * @param string  $votingOptionUuid
     * @param Request $request
     * @return bool
     */
    private function isValid(string $votingOptionUuid, Request $request): bool
    {
        return !empty($votingOptionUuid) && $request->has('title');
    }
}
