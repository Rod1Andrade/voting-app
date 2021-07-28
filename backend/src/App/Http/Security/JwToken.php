<?php


namespace Rodri\VotingApp\App\Http\Security;

use DateInterval;
use DateTime;
use DateTimeInterface;
use Exception;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
use InvalidArgumentException;
use Rodri\VotingApp\App\Http\Exceptions\InvalidTokenException;
use RuntimeException;
use stdClass;
use UnexpectedValueException;

/**
 * Class JWT Generator
 * @package Rodri\VotingApp\App\Http\Security
 * @author Rodrigo Andrade
 */
class JwToken
{

    /**
     * Default algorithm H256
     */
    public const DEFAULT_ALGORITHM = 'HS256';

    /**
     * Token request default
     */
    public const DEFAULT_TOKEN = 'Bearer ';

    /**
     * Encode a payload with Json Web token pattern.
     * @param array $payload
     * @return string
     */
    public static function encode(array $payload): string
    {
        $expirationDate = (new DateTime('now'))->add(new DateInterval('PT2H'));
        $payload['exp'] = $expirationDate->format(DateTimeInterface::ISO8601);

        return JWT::encode($payload, getenv('JWT_KEY'));
    }

    /**
     * Decode and return a jwt.
     * @param string $jwt
     * @return stdClass
     */
    public static function decode(string $jwt): stdClass
    {
        try {
            return JWT::decode(
                str_replace(JwToken::DEFAULT_TOKEN, '', $jwt),
                getenv('JWT_KEY'),
                [JwToken::DEFAULT_ALGORITHM]
            );
        } catch (
            InvalidArgumentException |
            UnexpectedValueException |
            BeforeValidException |
            SignatureInvalidException |
            ExpiredException |
            RuntimeException |
            Exception $e
        ) {
            throw new InvalidTokenException($e);
        }
    }
}