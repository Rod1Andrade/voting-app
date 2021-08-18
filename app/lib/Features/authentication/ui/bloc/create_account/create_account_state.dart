import 'package:app/Features/authentication/domain/value_objects/birth_date.dart';
import 'package:app/Features/authentication/domain/value_objects/email.dart';
import 'package:app/Features/authentication/domain/value_objects/last_name.dart';
import 'package:app/Features/authentication/domain/value_objects/name.dart';
import 'package:app/Features/authentication/domain/value_objects/password.dart';

/// Estado de criacao de conta
///
/// author: Rodrigo Andrade
class CreateAccountState {
  final Email? email;
  final Password? password;
  final BirthDate? birthDate;
  final Name? name;
  final LastName? lastName;

  CreateAccountState({
    this.email = const Email(),
    this.password = const Password(),
    this.birthDate,
    this.name,
    this.lastName,
  });

  /// Cria nova instancia, mas somente com os
  /// valoers alterados.
  CreateAccountState copyWith({
    Email? email,
    Password? password,
    BirthDate? birthDate,
    Name? name,
    LastName? lastName,
  }) {
    return CreateAccountState(
      email: email ?? this.email,
      password: password ?? this.password,
      birthDate: birthDate ?? this.birthDate,
      name: name ?? this.name,
      lastName: lastName ?? this.lastName,
    );
  }
}
