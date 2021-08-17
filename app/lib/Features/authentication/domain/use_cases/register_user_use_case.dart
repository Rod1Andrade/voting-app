import 'package:app/Features/authentication/domain/entities/user.dart';
import 'package:app/Features/authentication/domain/exceptions/authentication_exception.dart';
import 'package:app/Features/authentication/domain/repositories/abstract_user_repository.dart';

/// Caso de uso: registra um usuario.
///
/// author: Rodrigo Andrade
class RegisterUserUseCase {
  AbstractRegisterUserRepository _repository;

  RegisterUserUseCase(this._repository);

  void call(User? user) {
    try {
      _repository(user);
    } catch (error) {
      throw AuthenticationException(error.toString());
    }
  }
}
