/// Objeto valor: Password.
///
/// author: Rodrigo Andrade
class Password {
  final String value;

  final bool durty;

  const Password({
    this.value = "",
    this.durty = false,
  });

  /// Verify if the value object is valid
  bool isValid() {
    if (!this.durty) {
      return true;
    }

    return this.value.length > 3;
  }

  /// Check if the password are equals
  bool isEquals(Password? password) {
    if (password == null) return false;
    return password.value.compareTo(this.value) == 0;
  }

  /// Make the field durty
  Password doDurty() {
    return Password(value: this.value, durty: true);
  }
}
