import 'package:app/Features/authentication/domain/value_objects/email.dart';
import 'package:app/Features/authentication/domain/value_objects/password.dart';
import 'package:app/Features/authentication/ui/bloc/create_account/create_account_bloc.dart';
import 'package:app/Features/authentication/ui/bloc/create_account/create_account_event.dart';
import 'package:app/Features/authentication/ui/bloc/create_account/create_account_state.dart';
import 'package:app/shared/components/arrow_back_circular_button_component.dart';
import 'package:app/shared/components/input_label_component.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_bloc/flutter_bloc.dart';

class CreateAccountFirstStep extends StatelessWidget {
  const CreateAccountFirstStep({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      body: SafeArea(
        child: BlocListener(
          bloc: context.read<CreateAccountBloc>(),
          listener: (context, state) {
            if (state is CreateAccountStateNext) {
              Navigator.of(context).pushNamed(
                '/create-account-last-step',
                arguments: context.read<CreateAccountBloc>(),
              );
            }
          },
          child: SingleChildScrollView(
            child: Column(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              crossAxisAlignment: CrossAxisAlignment.center,
              children: [
                Row(
                  children: [
                    ArrowBackCircularButtonComponenet(
                      onPressed: () => print('back to welcome...'),
                    )
                  ],
                ),
                Row(
                  children: [
                    Container(
                      width: 200,
                      padding: EdgeInsets.symmetric(horizontal: 30),
                      child: Text(
                        'Criar Conta',
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
                  padding: EdgeInsets.symmetric(horizontal: 30),
                  child: Column(
                    children: [
                      Container(
                        padding: EdgeInsets.symmetric(vertical: 21.0),
                        child:
                            BlocBuilder<CreateAccountBloc, CreateAccountState>(
                          builder: (context, state) => InputLabelComponenet(
                            key: Key('key_email_input'),
                            textLabel: 'Email',
                            hintText: 'seu@email.com',
                            errorText: state.email!.isValid()
                                ? null
                                : 'Email Invalido',
                            onChange: (email) => context
                                .read<CreateAccountBloc>()
                                .add(CreateAccountEmailChanged(
                                    Email(value: email))),
                            keyBoardType: TextInputType.emailAddress,
                          ),
                        ),
                      ),
                      Container(
                        padding: EdgeInsets.symmetric(vertical: 21.0),
                        child:
                            BlocBuilder<CreateAccountBloc, CreateAccountState>(
                          builder: (context, state) => InputLabelComponenet(
                            key: Key('key_password_input'),
                            textLabel: 'Senha',
                            hintText: '************',
                            obscureText: true,
                            errorText: state.password!.isValid()
                                ? null
                                : 'Senha Invalida',
                            onChange: (password) {
                              context.read<CreateAccountBloc>().add(
                                    CreateAccountPasswordChanged(
                                      Password(value: password),
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
                            key: Key('key_confirm_password_input'),
                            textLabel: 'Confirmar Senha',
                            hintText: '************',
                            obscureText: true,
                            errorText: state.confirmPassword!.isValid() &&
                                    state.confirmPassword!
                                        .isEquals(state.password)
                                ? null
                                : 'As senhas devem coincidir.',
                            onChange: (confirmPassword) {
                              context.read<CreateAccountBloc>().add(
                                    CreateAccountConfirmPasswordChanged(
                                      Password(value: confirmPassword),
                                    ),
                                  );
                            },
                          ),
                        ),
                      ),
                      Container(
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
                                .add(CreateAccountNext());
                          },
                          child: Text('Avançar'),
                        ),
                      ),
                      Row(
                        children: [
                          Text('Já possuiu uma conta?'),
                          TextButton(
                            onPressed: () {
                              print('entrar...');
                            },
                            child: Text(
                              'Entrar',
                              style: TextStyle(
                                fontWeight: FontWeight.bold,
                                color: Color.fromRGBO(63, 61, 86, 1.0),
                              ),
                            ),
                          )
                        ],
                      ),
                    ],
                  ),
                )
              ],
            ),
          ),
        ),
      ),
    );
  }
}
