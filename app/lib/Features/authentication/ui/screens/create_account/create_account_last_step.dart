import 'package:app/shared/components/arrow_back_circular_button_component.dart';
import 'package:flutter/material.dart';

class CreateAccountLastStep extends StatelessWidget {
  const CreateAccountLastStep({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      body: SafeArea(
        child: SingleChildScrollView(
          child: Column(
            children: [
              Row(
                children: [
                  ArrowBackCircularButtonComponenet(
                    onPressed: () => Navigator.of(context).pop(),
                  )
                ],
              ),
              // Title
              Row(
                children: [
                  Container(
                    margin: EdgeInsets.only(left: 30, top: 50),
                    width: 210,
                    height: 96,
                    child: Text(
                      'Informações Adicionais',
                      style: TextStyle(
                        fontSize: 36,
                        fontWeight: FontWeight.bold,
                        fontFamily: 'Segoe UI',
                        color: Color.fromRGBO(47, 46, 65, 1.0),
                      ),
                    ),
                  ),
                ],
              ),
            ],
          ),
        ),
      ),
    );
  }
}
