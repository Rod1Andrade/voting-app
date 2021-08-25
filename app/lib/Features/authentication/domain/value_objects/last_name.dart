/// Objeto valor: LastName.
///
/// author: Rodrigo Andrade
class LastName {
  final String value;

  final bool durty;

  const LastName({
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
  LastName doDurty() {
    return LastName(value: this.value, durty: true);
  }
}
