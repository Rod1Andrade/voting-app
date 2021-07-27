<?php


namespace Rodri\VotingApp\App\Http\Security;

use DateTime;
use Firebase\JWT\JWT;
use stdClass;

/**
 * Class JWT Generator
 * @package Rodri\VotingApp\App\Http\Security
 * @author Rodrigo Andrade
 */
class JwToken
{

    public const DEFAULT_ALGORITHM = 'H256';

    /**
     * Encode a payload with Json Web token pattern.
     * @param $payload
     * @return string
     */
    public static function encode($payload): string
    {
        $payload['exp'] = (new DateTime('now'))->modify('+1h');

        return JWT::encode($payload, getenv('JWT_KEY'));
    }

    /**
     * Decode and return a jwt.
     * @param $jwt
     * @return stdClass
     */
    public static function decode($jwt): stdClass
    {
        //TODO: Invalid JWT Token exception
        return JWT::decode($jwt, getenv('JWT_KEY'), [JwToken::DEFAULT_ALGORITHM]);
    }
}