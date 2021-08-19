import 'package:bloc/bloc.dart';
import 'package:app/Features/authentication/ui/bloc/create_account/create_account_event.dart';
import 'package:app/Features/authentication/ui/bloc/create_account/create_account_state.dart';

/// Bloc - Criar conta.
///
/// author: Rodrigo Andrade
class CreateAccountBloc extends Bloc<CreateAccountEvent, CreateAccountState> {
  CreateAccountBloc() : super(CreateAccountState());

  @override
  Stream<CreateAccountState> mapEventToState(CreateAccountEvent event) async* {
    if (event is CreateAccountEmailChanged) {
      yield _mapEmailChangedToState(event, state);
    } else if (event is CreateAccountPasswordChanged) {
      yield _mapPasswordChangedToState(event, state);
    } else if (event is CreateAccountConfirmPasswordChanged) {
      yield _mapConfirmPasswordChangedToState(event, state);
    } else if (event is CreateAccounBirthDateChanged) {
      yield _mapBirthDateChangedToState(event, state);
    } else if (event is CreateAccountNameChanged) {
      yield _mapNameChangedToState(event, state);
    } else if (event is CreateAccountLastNameChanged) {
      yield _mapLastNameChangedToState(event, state);
    } else if (event is CreateAccountNext) {
      yield _mapCreateAccountNextToState(event, state); //TODO implementar
    } else if (event is CreateAccountSubmitted) {
      yield state; //TODO implementar
    }
  }

  /// Evento Email alterado para estado
  CreateAccountState _mapEmailChangedToState(
    CreateAccountEmailChanged event,
    CreateAccountState state,
  ) {
    final email = event.email.doDurty();
    return state.copyWith(
      email: email,
    );
  }

  /// Evento Senha alterada para estado
  CreateAccountState _mapPasswordChangedToState(
    CreateAccountPasswordChanged event,
    CreateAccountState state,
  ) {
    final password = event.password.doDurty();
    return state.copyWith(
      password: password,
    );
  }

  /// Evento Senha alterada para estado
  CreateAccountState _mapConfirmPasswordChangedToState(
    CreateAccountConfirmPasswordChanged event,
    CreateAccountState state,
  ) {
    final confirmPassword = event.confirmPassword.doDurty();
    return state.copyWith(
      confirmPassword: confirmPassword,
    );
  }

  /// Evento Data de Nascimento alterada para estado
  CreateAccountState _mapBirthDateChangedToState(
    CreateAccounBirthDateChanged event,
    CreateAccountState state,
  ) {
    final birthDate = event.birthDate.doDurty();
    return state.copyWith(
      birthDate: birthDate,
    );
  }

  /// Evento nome alterada para estado
  CreateAccountState _mapNameChangedToState(
    CreateAccountNameChanged event,
    CreateAccountState state,
  ) {
    final name = event.name.doDurty();
    return state.copyWith(
      name: name,
    );
  }

  /// Evento sobrenome alterado para estado
  CreateAccountState _mapLastNameChangedToState(
    CreateAccountLastNameChanged event,
    CreateAccountState state,
  ) {
    final lastName = event.lastName.doDurty();
    return state.copyWith(
      lastName: lastName,
    );
  }

  /// Event avançar alterado para estado
  CreateAccountState _mapCreateAccountNextToState(
    CreateAccountNext event,
    CreateAccountState state,
  ) {
    if (state.selfValidate(event))
      return CreateAccountStateNext.byState(state);
    else
      return CreateAccountStateFailure.byState(state);
  }
}
