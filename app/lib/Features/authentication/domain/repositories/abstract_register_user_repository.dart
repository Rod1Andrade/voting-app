import 'package:app/Features/authentication/domain/entities/user.dart';

/// Repositorio destinado ao registro de usuario.
///
/// author: Rodrigo Andrade
abstract class AbstractRegisterUserRepository {
  Future<void> call(User? user);
}
