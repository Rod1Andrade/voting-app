import 'package:app/Features/authentication/domain/entities/user.dart';

/// Modelo que extende as funcionalidades de usuario.
///
/// author: Rodrigo Andrade
class UserModel extends User {
  /// Contrutor padrao
  UserModel({
    String? userUuid,
    String? email,
    String? password,
    DateTime? birthDate,
    String? name,
    String? lastName,
  }) : super(
          userUuid: userUuid,
          email: email,
          password: password,
          birthDate: birthDate,
          name: name,
          lastName: lastName,
        );

  /// Construtor a partir da entidade User
  UserModel.by(User? user) {
    this.userUuid = user?.userUuid;
    this.email = user?.email;
    this.password = user?.password;
    this.name = user?.name;
    this.lastName = user?.lastName;
    this.birthDate = user?.birthDate;
  }

  /// Parser to json
  Map<String, dynamic> toJson() => {
        'userUuid': this.userUuid,
        'email': this.email,
        'password': this.password,
        'name': this.name,
        'lastName': this.lastName,
        'birthDate': this.birthDate,
      };
}
