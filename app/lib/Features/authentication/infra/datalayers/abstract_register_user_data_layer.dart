import 'package:app/Features/authentication/infra/models/user_mode.dart';

abstract class AbstractRegisterUserDataLayer {
  Future<void> call(UserModel userModel);
}
