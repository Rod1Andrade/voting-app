import 'package:app/Features/authentication/domain/value_objects/email.dart';
import 'package:app/Features/authentication/domain/value_objects/password.dart';
import 'package:app/Features/authentication/ui/bloc/create_account/create_account_bloc.dart';
import 'package:app/Features/authentication/ui/bloc/create_account/create_account_event.dart';
import 'package:app/Features/authentication/ui/bloc/create_account/create_account_state.dart';
import 'package:app/Features/authentication/ui/screens/create_account/create_account_last_step.dart';
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
        child: SingleChildScrollView(
          child: BlocListener(
            bloc: context.read<CreateAccountBloc>(),
            listener: (context, state) {
              print(state);
              if (state is CreateAccountStateNext) {
                Navigator.of(context).pushNamed('/create-account-last-step');
              }
            },
            child: Column(
              children: [
                // Title
                Row(
                  children: [
                    Container(
                      margin: EdgeInsets.only(left: 30, top: 50),
                      width: 100,
                      height: 96,
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
                  margin: EdgeInsets.only(top: 10),
                  padding: EdgeInsets.symmetric(horizontal: 30),
                  child: Column(
                    children: [
                      Container(
                        padding: EdgeInsets.symmetric(vertical: 21.0),
                        child:
                            BlocBuilder<CreateAccountBloc, CreateAccountState>(
                          builder: (context, state) => InputLabel(
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
                          ),
                        ),
                      ),
                      Container(
                        padding: EdgeInsets.symmetric(vertical: 21.0),
                        child:
                            BlocBuilder<CreateAccountBloc, CreateAccountState>(
                          builder: (context, state) => InputLabel(
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
                          builder: (context, state) => InputLabel(
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
                      Padding(
                        padding: const EdgeInsets.symmetric(vertical: 8.0),
                        child: Row(
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

class InputLabel extends StatelessWidget {
  final Key key;
  final bool obscureText;
  final String? hintText;
  final String? errorText;
  final String? textLabel;
  final void Function(String)? onChange;

  InputLabel({
    required this.key,
    this.textLabel,
    this.hintText,
    this.errorText,
    this.onChange,
    this.obscureText = false,
  });

  @override
  Widget build(BuildContext context) {
    return BlocBuilder<CreateAccountBloc, CreateAccountState>(
      builder: (context, state) {
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
                keyboardType: TextInputType.emailAddress,
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
      },
    );
  }
}
