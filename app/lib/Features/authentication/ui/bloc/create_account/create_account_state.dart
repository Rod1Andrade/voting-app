import 'package:app/Features/authentication/domain/value_objects/birth_date.dart';
import 'package:app/Features/authentication/domain/value_objects/email.dart';
import 'package:app/Features/authentication/domain/value_objects/last_name.dart';
import 'package:app/Features/authentication/domain/value_objects/name.dart';
import 'package:app/Features/authentication/domain/value_objects/password.dart';
import 'package:app/Features/authentication/ui/bloc/create_account/create_account_event.dart';

/// Estado de criacao de conta
///
/// author: Rodrigo Andrade
class CreateAccountState {
  final Email? email;
  final Password? password;
  final Password? confirmPassword;
  final BirthDate? birthDate;
  final Name? name;
  final LastName? lastName;

  const CreateAccountState({
    this.email = const Email(),
    this.password = const Password(),
    this.confirmPassword = const Password(),
    this.birthDate = const BirthDate(),
    this.name = const Name(),
    this.lastName = const LastName(),
  });

  /// Cria nova instancia, mas somente com os
  /// valoers alterados.
  CreateAccountState copyWith({
    Email? email,
    Password? password,
    Password? confirmPassword,
    BirthDate? birthDate,
    Name? name,
    LastName? lastName,
  }) {
    return CreateAccountState(
      email: email ?? this.email,
      password: password ?? this.password,
      confirmPassword: confirmPassword ?? this.confirmPassword,
      birthDate: birthDate ?? this.birthDate,
      name: name ?? this.name,
      lastName: lastName ?? this.lastName,
    );
  }

  /// Valida de acordo com o estado.
  bool selfValidate(CreateAccountEvent event) {
    if (event is CreateAccountNext) {
      return this.email!.value.isNotEmpty &&
          this.password!.value.isNotEmpty &&
          this.confirmPassword!.value.isNotEmpty &&
          this.confirmPassword!.isEquals(this.password);
    }

    return false;
  }
}

class CreateAccountStateNext extends CreateAccountState {
  CreateAccountStateNext({
    Email? email,
    Password? password,
    Password? confirmPassword,
    BirthDate? birthDate,
    Name? name,
    LastName? lastName,
  }) : super(
          email: email,
          password: password,
          confirmPassword: confirmPassword,
          birthDate: birthDate,
          name: name,
          lastName: lastName,
        );

  static CreateAccountStateNext byState(CreateAccountState state) {
    return CreateAccountStateNext(
      email: state.email,
      password: state.password,
      confirmPassword: state.confirmPassword,
      birthDate: state.birthDate,
      name: state.name,
      lastName: state.lastName,
    );
  }
}

class CreateAccountStateFailure extends CreateAccountState {
  CreateAccountStateFailure({
    Email? email,
    Password? password,
    Password? confirmPassword,
    BirthDate? birthDate,
    Name? name,
    LastName? lastName,
  }) : super(
          email: email,
          password: password,
          confirmPassword: confirmPassword,
          birthDate: birthDate,
          name: name,
          lastName: lastName,
        );

  static CreateAccountStateFailure byState(CreateAccountState state) {
    return CreateAccountStateFailure(
      email: state.email,
      password: state.password,
      confirmPassword: state.confirmPassword,
      birthDate: state.birthDate,
      name: state.name,
      lastName: state.lastName,
    );
  }
}
