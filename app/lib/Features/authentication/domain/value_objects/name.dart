/// Objeto valor: Name.
///
/// author: Rodrigo Andrade
class Name {
  final String value;

  final bool durty;

  const Name({
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
  Name doDurty() {
    return Name(value: this.value, durty: true);
  }
}
