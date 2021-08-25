/// Objeto valor: Email.
///
/// author: Rodrigo Andrade
class Email {
  final String value;

  final bool durty;

  const Email({
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

  /// Make the field durty
  Email doDurty() {
    return Email(value: this.value, durty: true);
  }
}
