import 'package:flutter/material.dart';

class ArrowBackCircularButtonComponenet extends StatelessWidget {
  final void Function()? onPressed;
  const ArrowBackCircularButtonComponenet({
    Key? key,
    required this.onPressed,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Container(
      decoration: BoxDecoration(
        color: Color.fromRGBO(240, 245, 255, 1.0),
        borderRadius: BorderRadius.circular(30),
      ),
      margin: EdgeInsets.symmetric(horizontal: 10, vertical: 15),
      child: IconButton(
        onPressed: onPressed,
        icon: Icon(Icons.arrow_back),
      ),
    );
  }
}
