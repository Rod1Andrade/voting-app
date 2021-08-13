<?php

namespace Rodri\VotingApp\App\Http\Controllers\VotingSection;

use stdClass;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Rodri\VotingApp\App\Http\Controllers\Controller;
use Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects\VotingSectionDTO;
use Rodri\VotingApp\Features\VotingSection\Domain\Exceptions\CreateVotingSectionException;
use Rodri\VotingApp\Features\VotingSection\External\Factories\VotingSectionUseCaseFactory;

/**
 * Controller - CreateVotingSectionController
 * @author Rodrigo Andrade
 */
class CreateVotingSectionController extends Controller
{
    /**
     * Create Voting Section
     * @param Request $request
     * @return JsonResponse
     */
    public function invoke(Request $request): JsonResponse
    {
        $votingSection = (object)$request->all();
        $votingSection->userUuid = Auth::id();

        if (!$this->isValid($votingSection)) {
            return response()
                ->json(['message' => 'The body needs have: subject, start date, finish date and voting options.'])
                ->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        $votingSectionDTO = VotingSectionDTO::createVotingDTOfromStdClass($votingSection);
        $useCase = VotingSectionUseCaseFactory::createVotingSectionUseCase();

        try {
            $useCase(VotingSectionDTO::createVotingFromVotingDTO($votingSectionDTO));
            return response()->json()->setStatusCode(Response::HTTP_ACCEPTED);
        } catch (CreateVotingSectionException $e) {
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
     * Validate the request expected values
     * @param stdClass $body
     * @return bool
     */
    private
    function isValid(stdClass $body): bool
    {
        return isset($body->subject)
            && isset($body->startDate)
            && isset($body->finishDate)
            && isset($body->votingOptions)
            && isset($body->userUuid);
    }
}
