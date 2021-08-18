import 'package:app/Features/authentication/ui/bloc/create_account/create_account_bloc.dart';
import 'package:flutter/material.dart';
import 'package:app/Features/authentication/ui/screens/create_account/create_account_first_step.dart';
import 'package:flutter_bloc/flutter_bloc.dart';

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Voting',
      theme: ThemeData(
        primarySwatch: Colors.blue,
      ),
      home: BlocProvider(
        create: (context) => CreateAccountBloc(),
        child: CreateAccountFirstStep(),
      ),
    );
  }
}
