/// Objeto valor: BirthDate.
///
/// author: Rodrigo Andrade
class BirthDate {
  final String value;

  final bool durty;

  const BirthDate({
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
  BirthDate doDurty() {
    return BirthDate(value: this.value, durty: true);
  }
}
