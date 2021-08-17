import 'package:app/Features/authentication/domain/entities/user.dart';
import 'package:app/Features/authentication/domain/repositories/abstract_user_repository.dart';
import 'package:app/Features/authentication/domain/use_cases/register_user_use_case.dart';
import 'package:flutter_test/flutter_test.dart';
import 'package:mockito/mockito.dart';

class MockRepository extends Mock implements AbstractRegisterUserRepository {}

main() {
  test('Should register a user calling once the Register User Repository.', () {
    var userMock = User();

    var repository = MockRepository();
    var useCase = RegisterUserUseCase(repository);
    useCase(userMock);

    expect(verify(repository(captureAny)).captured.single, userMock);
  });
}
