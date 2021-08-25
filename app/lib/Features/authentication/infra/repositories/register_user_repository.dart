import 'package:app/Features/authentication/domain/entities/user.dart';
import 'package:app/Features/authentication/infra/models/user_mode.dart';
import 'package:app/Features/authentication/infra/datalayers/abstract_register_user_data_layer.dart';
import 'package:app/Features/authentication/infra/exceptions/register_user_repository_exception.dart';
import 'package:app/Features/authentication/domain/repositories/abstract_register_user_repository.dart';

/// Implementação - AbstractRegisterUserRepository
////
/// author: Rodrigo Andrade
class RegisterUserRepository implements AbstractRegisterUserRepository {
  AbstractRegisterUserDataLayer _dataLayer;

  RegisterUserRepository(this._dataLayer);

  @override
  Future<void> call(User? user) async {
    try {
      _dataLayer(UserModel.by(user));
    } on Exception catch (error) {
      throw RegisterUserRepositoryException(error.toString());
    }
  }
}
