<?php

namespace Rodri\VotingApp\App\Http\Controllers\VotingSection;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects\VotingSectionDTO;
use Symfony\Component\HttpFoundation\Response;
use Rodri\VotingApp\App\Http\Controllers\Controller;
use Rodri\VotingApp\Features\VotingSection\External\Factories\VotingSectionUseCaseFactory;
use Rodri\VotingApp\Features\VotingSection\Domain\Exceptions\ShowAllVotingSectionsException;

/**
 * Controller - ShowAllVotingSectionsController
 * @author Rodrigo Andrade
 */
class ShowAllVotingSectionsController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function invoke(Request $request): JsonResponse
    {
        try {
            $useCase = VotingSectionUseCaseFactory::showAllVotingSectionUseCase();
            $response = $useCase($request->get('offset') ?? 0, $request->get('limit') ?? 10);

            return response()->json(VotingSectionDTO::transformAListOfVotingSectionDTOToAssocArray($response));
        } catch (ShowAllVotingSectionsException $e) {
            return response()
                ->json(['message' => $e->getMessage()])
                ->setStatusCode(Response::HTTP_BAD_REQUEST);
        }
    }
}
