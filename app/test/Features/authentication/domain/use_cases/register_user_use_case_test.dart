import 'package:mockito/mockito.dart';
import 'package:flutter_test/flutter_test.dart';
import 'package:app/Features/authentication/domain/entities/user.dart';
import 'package:app/Features/authentication/domain/use_cases/register_user_use_case.dart';
import 'package:app/Features/authentication/domain/exceptions/authentication_exception.dart';
import 'package:app/Features/authentication/domain/repositories/abstract_register_user_repository.dart';

class MockRepository extends Mock implements AbstractRegisterUserRepository {}

main() {
  var userMock = User();
  var repository = MockRepository();
  var useCase = RegisterUserUseCase(repository);

  test('Should register a user calling once the Register User Repository.',
      () async {
    useCase(userMock);
    expect(verify(repository(captureAny)).captured.single, userMock);
  });

  test(
      'Should throw a authentication exception when its not possible use repository',
      () async {
    when(repository(userMock)).thenThrow(Exception());
    var response = await useCase(userMock);
    expect(response.fold((l) => l, (r) => null),
        isInstanceOf<AuthenticationException>());
  });
}
