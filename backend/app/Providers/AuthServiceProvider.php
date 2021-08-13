<?php

namespace Rodri\VotingApp\App\Providers;

use Exception;
use Illuminate\Auth\GenericUser;
use Illuminate\Support\ServiceProvider;
use Rodri\VotingApp\App\Http\Security\JwToken;
use Rodri\VotingApp\Features\Auth\Domain\ValueObjects\UserUuid;
use Rodri\VotingApp\Features\Auth\External\Factories\AuthUseCaseFactory;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['auth']->viaRequest('api', function ($request) {
            try {
                $token = $request->bearerToken();
                if (!empty($token)) {
                    $decodedToken = JwToken::decode($token);
                    if ($this->validateUser($decodedToken->sub))
                        return new GenericUser(['id' => $decodedToken->sub]);
                }
            } catch (Exception) {
                return null;
            }
            return null;
        });
    }

    /**
     * Validate if user exists.
     * @param string $userUuid
     * @return bool
     */
    private function validateUser(string $userUuid): bool
    {
        $checkUserExistsUseCase = AuthUseCaseFactory::checkUserExistsUseCase();
        return $checkUserExistsUseCase(new UserUuid($userUuid));
    }
}
