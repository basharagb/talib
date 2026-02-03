import 'package:dio/dio.dart';
import '../../../../core/constants/api_constants.dart';
import '../../../../core/error/exceptions.dart';
import '../models/user_model.dart';

abstract class AuthRemoteDataSource {
  Future<UserModel> login({
    required String email,
    required String password,
  });

  Future<void> logout();
}

class AuthRemoteDataSourceImpl implements AuthRemoteDataSource {
  final Dio dio;

  AuthRemoteDataSourceImpl(this.dio);

  @override
  Future<UserModel> login({
    required String email,
    required String password,
  }) async {
    try {
      final response = await dio.post(
        '${ApiConstants.apiBaseUrl}${ApiConstants.login}',
        data: {
          'email': email,
          'password': password,
        },
      );

      if (response.statusCode == 200) {
        final data = response.data;
        if (data['success'] == true) {
          return UserModel.fromJson(data['user']);
        } else {
          throw ServerException(data['message'] ?? 'Login failed');
        }
      } else {
        throw ServerException('Server error: ${response.statusCode}');
      }
    } on DioException catch (e) {
      if (e.type == DioExceptionType.connectionTimeout ||
          e.type == DioExceptionType.receiveTimeout) {
        throw NetworkException('Connection timeout');
      } else if (e.type == DioExceptionType.connectionError) {
        throw NetworkException('No internet connection');
      } else if (e.response != null) {
        final data = e.response?.data;
        if (data is Map<String, dynamic>) {
          throw ServerException(data['message'] ?? 'Login failed');
        }
        throw ServerException('Login failed');
      } else {
        throw NetworkException('Network error occurred');
      }
    } catch (e) {
      throw ServerException('Unexpected error: ${e.toString()}');
    }
  }

  @override
  Future<void> logout() async {
    try {
      await dio.post('${ApiConstants.apiBaseUrl}${ApiConstants.logout}');
    } catch (e) {
      throw ServerException('Logout failed');
    }
  }
}
