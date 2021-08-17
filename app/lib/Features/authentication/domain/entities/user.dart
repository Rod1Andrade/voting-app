/// Entidade Usuario
///
///author: Rodrigo Andrade
class User {
  String? userUuid;
  String? email;
  String? password;
  DateTime? birthDate;
  String? name;
  String? lastName;

  User({
    this.userUuid,
    this.email,
    this.password,
    this.birthDate,
    this.name,
    this.lastName,
  });
}
