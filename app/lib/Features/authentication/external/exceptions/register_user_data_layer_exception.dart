import 'package:app/Features/authentication/domain/exceptions/authentication_exception.dart';

class RegisterUserDataLayerException extends AuthenticationException {
  RegisterUserDataLayerException(String? message) : super(message);
}
