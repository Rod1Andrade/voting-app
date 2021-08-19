import 'package:app/Features/authentication/domain/value_objects/birth_date.dart';
import 'package:app/Features/authentication/domain/value_objects/last_name.dart';
import 'package:app/Features/authentication/domain/value_objects/name.dart';
import 'package:app/Features/authentication/ui/bloc/create_account/create_account_bloc.dart';
import 'package:app/Features/authentication/ui/bloc/create_account/create_account_event.dart';
import 'package:app/Features/authentication/ui/bloc/create_account/create_account_state.dart';
import 'package:app/shared/components/arrow_back_circular_button_component.dart';
import 'package:app/shared/components/input_label_component.dart';
import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';

class CreateAccountLastStep extends StatelessWidget {
  const CreateAccountLastStep({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      body: SafeArea(
        child: SingleChildScrollView(
          child: BlocListener<CreateAccountBloc, CreateAccountState>(
            listener: (context, state) {
              if (state is CreateAccountStateBack) {
                Navigator.of(context).pop();
              }
            },
            child: Column(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Row(
                  children: [
                    ArrowBackCircularButtonComponenet(
                      onPressed: () => context
                          .read<CreateAccountBloc>()
                          .add(CreateAccountBack()),
                    )
                  ],
                ),
                // Title
                Row(
                  children: [
                    Container(
                      margin: EdgeInsets.only(left: 30, top: 50),
                      width: 210,
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
                Container(
                  margin: EdgeInsets.only(top: 10),
                  padding: EdgeInsets.symmetric(horizontal: 30),
                  child: Column(
                    children: [
                      Container(
                        padding: EdgeInsets.symmetric(vertical: 21.0),
                        child:
                            BlocBuilder<CreateAccountBloc, CreateAccountState>(
                          builder: (context, state) => InputLabelComponenet(
                            key: Key('key_name_input'),
                            textLabel: 'Nome',
                            hintText: 'digite seu nome',
                            errorText:
                                state.name!.isValid() ? null : 'Nome inválido',
                            onChange: (name) => context
                                .read<CreateAccountBloc>()
                                .add(CreateAccountNameChanged(
                                    Name(value: name))),
                            keyBoardType: TextInputType.name,
                          ),
                        ),
                      ),
                      Container(
                        padding: EdgeInsets.symmetric(vertical: 21.0),
                        child:
                            BlocBuilder<CreateAccountBloc, CreateAccountState>(
                          builder: (context, state) => InputLabelComponenet(
                            key: Key('key_last_name_input'),
                            textLabel: 'Sobrenome',
                            hintText: 'digite seu sobrenome',
                            errorText: state.lastName!.isValid()
                                ? null
                                : 'Sobrenome inválido',
                            onChange: (lastName) {
                              context.read<CreateAccountBloc>().add(
                                    CreateAccountLastNameChanged(
                                      LastName(value: lastName),
                                    ),
                                  );
                            },
                          ),
                        ),
                      ),
                      Container(
                        padding: EdgeInsets.symmetric(vertical: 21.0),
                        child:
                            BlocBuilder<CreateAccountBloc, CreateAccountState>(
                          builder: (context, state) => InputLabelComponenet(
                            key: Key('key_birth_date_input'),
                            textLabel: 'Data de Nascimento',
                            hintText: 'exemplo: 23/07/1912',
                            errorText: state.birthDate!.isValid()
                                ? null
                                : 'Data de nascimento inválida.',
                            onChange: (birthDate) {
                              context.read<CreateAccountBloc>().add(
                                    CreateAccounBirthDateChanged(
                                      BirthDate(value: birthDate),
                                    ),
                                  );
                            },
                          ),
                        ),
                      ),
                      Container(
                        child: Column(
                          children: [
                            Row(
                              children: [
                                Checkbox(value: false, onChanged: null),
                                Text('Eu concordo com os'),
                                TextButton(
                                  onPressed: () => {},
                                  child: Text('Termos & Condições.'),
                                ),
                              ],
                            ),
                          ],
                        ),
                      ),
                      Container(
                        margin: EdgeInsets.only(bottom: 19),
                        width: double.infinity,
                        height: 60,
                        child: OutlinedButton(
                          style: ButtonStyle(
                            textStyle: MaterialStateProperty.all(TextStyle(
                              fontSize: 16,
                              fontFamily: 'Segoe UI',
                              fontWeight: FontWeight.bold,
                            )),
                            foregroundColor: MaterialStateProperty.all(
                              Colors.white,
                            ),
                            backgroundColor: MaterialStateProperty.all(
                              Color.fromRGBO(47, 46, 65, 1.0),
                            ),
                            side: MaterialStateProperty.all<BorderSide>(
                              BorderSide(
                                width: 1,
                                color: Color.fromRGBO(63, 61, 86, 1.0),
                              ),
                            ),
                          ),
                          onPressed: () {
                            context
                                .read<CreateAccountBloc>()
                                .add(CreateAccountBack());
                          },
                          child: Text('Criar Conta'),
                        ),
                      )
                    ], // Widgets
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
