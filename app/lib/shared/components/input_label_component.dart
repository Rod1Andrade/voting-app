import 'package:flutter/material.dart';

/// InputLabelComponenet é um componente de entrada
/// de dados padronizado, comumente utilizado para
/// telas de autenticacao.
///
/// author: Rodrigo Andrade
class InputLabelComponenet extends StatelessWidget {
  final Key key;
  final bool obscureText;
  final String? hintText;
  final String? errorText;
  final String? textLabel;
  final void Function(String)? onChange;
  final TextInputType? keyBoardType;

  InputLabelComponenet({
    required this.key,
    this.textLabel,
    this.hintText,
    this.errorText,
    this.onChange,
    this.obscureText = false,
    this.keyBoardType,
  });

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Container(
          width: double.infinity,
          child: Text(
            '$textLabel',
            style: TextStyle(
              fontSize: 16,
              fontWeight: FontWeight.bold,
              fontFamily: 'Segoe UI',
              color: Color.fromRGBO(47, 46, 65, 1.0),
            ),
          ),
        ),
        Padding(
          padding: const EdgeInsets.only(top: 8.0),
          child: TextField(
            obscureText: obscureText,
            key: key,
            onChanged: onChange,
            keyboardType: keyBoardType,
            decoration: InputDecoration(
              filled: true,
              hintText: '$hintText',
              enabledBorder: OutlineInputBorder(
                borderSide: BorderSide(
                  color: Color.fromRGBO(240, 245, 255, 1.0),
                  style: BorderStyle.none,
                ),
                borderRadius: BorderRadius.all(Radius.circular(15.0)),
              ),
              border: OutlineInputBorder(
                borderSide: BorderSide(
                  color: Color.fromRGBO(240, 245, 255, 1.0),
                  style: BorderStyle.none,
                ),
                borderRadius: BorderRadius.all(Radius.circular(15.0)),
              ),
              fillColor: Color.fromRGBO(240, 245, 255, 1.0),
              errorText: errorText,
            ),
          ),
        ),
      ],
    );
  }
}
