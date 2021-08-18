import 'package:dio/dio.dart';
import 'package:app/Features/authentication/infra/models/user_mode.dart';
import 'package:app/Features/authentication/infra/datalayers/abstract_register_user_data_layer.dart';
import 'package:app/Features/authentication/external/exceptions/register_user_data_layer_exception.dart';

/// Implementação - AbstractRegisterUserDataLayer
///
/// author: Rodrigo Andrade
class RegisterUserDataLayer implements AbstractRegisterUserDataLayer {
  Dio _dio;
  RegisterUserDataLayer(this._dio);

  @override
  Future<void> call(UserModel userModel) async {
    try {
      var response = await _dio.request(
        '/auth/signUp',
        data: userModel.toJson(),
        options: Options(method: 'POST'),
      );

      if ((response.statusCode ?? 500) >= 400) {
        print(response.data);
        // throw RegisterUserDataLayerException(response.data['message']);
      }
    } on RegisterUserDataLayerException catch (e) {
      throw RegisterUserDataLayerException(e.message);
    } catch (e) {
      throw RegisterUserDataLayerException('Erro desconhecido!');
    }
  }
}
