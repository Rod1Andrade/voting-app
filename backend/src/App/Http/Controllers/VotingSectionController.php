<?php


namespace Rodri\VotingApp\App\Http\Controllers;


use Exception;
use Rodri\SimpleRouter\Helpers\StatusCode;
use Rodri\SimpleRouter\Request;
use Rodri\SimpleRouter\Response;
use Rodri\VotingApp\App\Database\Connection\PgConnection;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\VotingSection\Domain\ValueObjects\VotingUuid;
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
        $body->userUuid = $request->getValue('userUuid');

        # Validate the body values
        if (!$this->validateCreateVotingBodyRequest($body)) {
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
     * Delete a voting section and all voting options associeted with
     *
     * @param Request $request
     * @return Response
     */
    public function deleteVotingSection(Request $request): Response
    {
        #use case factory
        $deleteVotingUseCase = VotingSectionUseCaseFactory::deleteVotingSectionUseCase(PgConnection::getConnection());

        # Validate
        if (empty($request->param(':votingSectionUuid'))) {
            return new Response([
                'Invalid Request' => 'The voting section uuid is required'
            ], StatusCode::BAD_REQUEST
            );
        }

        try {
            $deleteVotingUseCase(
                new VotingUuid($request->param(':votingSectionUuid')),
                new UserUuid($request->getValue('userUuid'))
            );
        } catch (RuntimeException | Exception $e) {
            return new Response(['message' => $e->getMessage()], StatusCode::BAD_REQUEST);
        }

        return new Response();
    }

    /**
     * Return all voting sections subjects.
     *
     * @param Request $request
     * @return Response
     */
    public function showAllVotingSections(Request $request): Response
    {
        $offset = (int)$request->param(':offset');
        $limit = (int)$request->param(':limit');

        $this->validateLimitAndOffset($offset, $limit);

        # Use case factory
        $showAllVotingSectionsUseCase = VotingSectionUseCaseFactory::showAllVotingSectionUseCase(PgConnection::getConnection());
        $response = $showAllVotingSectionsUseCase($offset, $limit);

        return new Response(array_map(function ($value) {
            if ($value instanceof VotingDTO) {
                return [
                    'votingUuid' => $value->getVotingUuid(),
                    'subject' => $value->getSubject(),
                    'startDate' => $value->getStartDate(),
                    'finishDate' => $value->getFinishDate()
                ];
            } else {
                return null;
            }
        }, $response));
    }

    /**
     * Get a voting section by your uuid
     * @param Request $request
     * @return Response
     */
    public function showVotingSection(Request $request): Response
    {
        $votingSectionUuid = $request->param(':votingSectionUuid');

        #UseCase factory
        $showVotingSectionUseCase = VotingSectionUseCaseFactory::showVotingSectionUseCase(PgConnection::getConnection());
//        var_dump(VotingDTO::parserToAssocArray($showVotingSectionUseCase(new VotingUuid($votingSectionUuid))));

        return new Response(VotingDTO::parserToAssocArray($showVotingSectionUseCase(new VotingUuid($votingSectionUuid))));
    }

    /**
     * @param int $offset
     * @param int $limit
     */
    private function validateLimitAndOffset(int &$offset, int &$limit): void
    {
        $offset = empty($offset) ? 0 : $offset;
        $limit = empty($limit) ? 10 : $limit;
    }

    /**
     * Validate the request expecteds values
     * @param stdClass $body
     * @return bool
     */
    private
    function validateCreateVotingBodyRequest(stdClass $body): bool
    {
        return isset($body->subject)
            && isset($body->startDate)
            && isset($body->finishDate)
            && isset($body->votingOptions)
            && isset($body->userUuid);
    }
}