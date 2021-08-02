<?php


namespace Rodri\VotingApp\App\Http\Controllers;


use Exception;
use Rodri\SimpleRouter\Helpers\StatusCode;
use Rodri\SimpleRouter\Request;
use Rodri\SimpleRouter\Response;
use Rodri\VotingApp\App\Database\Connection\PgConnection;
use Rodri\VotingApp\Features\VotingSection\External\Factories\VotingSectionUseCaseFactory;
use Rodri\VotingApp\Features\VotingSection\Infra\DataTransferObjects\VotingDTO;
use RuntimeException;
use stdClass;

/**
 * Class VotingSectionController
 * @package Rodri\VotingApp\App\Http\Controllers
 * @author Rodrigo Andrade
 */
class VotingSectionController
{
    /**
     * Create a Voting Section and Store it.
     * @param Request $request
     * @return Response
     */
    public function createVotingSection(Request $request): Response
    {
        $body = json_decode($request->body());

        # Validate the body values
        if(!$this->validateCreateVotingBodyRequest($body)) {
            return new Response([
                'Invalid Request' => 'The body needs have: subject, start date, finish date and voting options.'],
                StatusCode::BAD_REQUEST
            );
        }

        # Body DTO conversion
        $votingDTO = VotingDTO::createVotingDTOfromStdClass($body);

        # Use case factory
        $createVotingUseCase = VotingSectionUseCaseFactory::createVotingSectionUseCase(PgConnection::getConnection());

        try {
            $createVotingUseCase(VotingDTO::createVotingFromVotingDTO($votingDTO));
        } catch (RuntimeException | Exception $e) {
            return new Response([
                'message' => $e->getMessage()],
                StatusCode::BAD_REQUEST
            );
        }

        return new Response();
    }

    /**
     * Validate the request expecteds values
     * @param stdClass $body
     * @return bool
     */
    private function validateCreateVotingBodyRequest(stdClass $body): bool
    {
        return isset($body->subject)
            && isset($body->startDate)
            && isset($body->finishDate)
            && isset($body->votingOptions);
    }
}