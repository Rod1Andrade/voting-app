import 'package:app/Features/authentication/domain/value_objects/birth_date.dart';
import 'package:app/Features/authentication/domain/value_objects/email.dart';
import 'package:app/Features/authentication/domain/value_objects/last_name.dart';
import 'package:app/Features/authentication/domain/value_objects/name.dart';
import 'package:app/Features/authentication/domain/value_objects/password.dart';

/// Evento de criacao de conta
///
/// author: Rodrigo Andrade
abstract class CreateAccountEvent {
  const CreateAccountEvent();
}

/// Evento: Email alterado.
class CreateAccountEmailChanged extends CreateAccountEvent {
  final Email email;

  CreateAccountEmailChanged(this.email);
}

/// Evento: Senha alterada.
class CreateAccountPasswordChanged extends CreateAccountEvent {
  final Password password;

  CreateAccountPasswordChanged(this.password);
}

/// Evento: Confirmar Senha alterada.
class CreateAccountConfirmPasswordChanged extends CreateAccountEvent {
  final Password confirmPassword;

  CreateAccountConfirmPasswordChanged(this.confirmPassword);
}

/// Evento: Nome alteado.
class CreateAccountNameChanged extends CreateAccountEvent {
  final Name name;

  CreateAccountNameChanged(this.name);
}

/// Evento: Sobrenome alteado.
class CreateAccountLastNameChanged extends CreateAccountEvent {
  final LastName lastName;

  CreateAccountLastNameChanged(this.lastName);
}

/// Evento: Data de nascimento alteado.
class CreateAccounBirthDateChanged extends CreateAccountEvent {
  final BirthDate birthDate;

  CreateAccounBirthDateChanged(this.birthDate);
}

/// Evento: Avancar para a proxima tela.
class CreateAccountNext extends CreateAccountEvent {}

/// Evento: Submeter criacao de conta.
class CreateAccountSubmitted extends CreateAccountEvent {}
