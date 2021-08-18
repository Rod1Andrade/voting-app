import 'package:app/Features/authentication/domain/exceptions/authentication_exception.dart';

class RegisterUserRepositoryException extends AuthenticationException {
  RegisterUserRepositoryException(String? message) : super(message);
}
