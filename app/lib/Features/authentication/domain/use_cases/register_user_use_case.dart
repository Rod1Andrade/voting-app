import 'package:dartz/dartz.dart';
import 'package:app/Features/authentication/domain/entities/user.dart';
import 'package:app/Features/authentication/domain/exceptions/authentication_exception.dart';
import 'package:app/Features/authentication/domain/repositories/abstract_user_repository.dart';

/// Caso de uso: registra um usuário.
///
/// author: Rodrigo Andrade
class RegisterUserUseCase {
  AbstractRegisterUserRepository _repository;

  RegisterUserUseCase(this._repository);

  /// Registra uma usuário passado como argumento.
  /// @param user User
  /// @throws AuthenticationException
  Future<Either<AuthenticationException, void>> call(User? user) async {
    try {
      return Right(_repository(user));
    } catch (error) {
      return Left(AuthenticationException(error.toString()));
    }
  }
}
