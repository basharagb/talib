import 'package:dio/dio.dart';
import '../../../../core/constants/api_constants.dart';

abstract class ProfileRemoteDataSource {
  Future<Map<String, dynamic>> getProfile(String token);
  Future<Map<String, dynamic>> updateProfile(
    String token,
    Map<String, dynamic> data,
  );
}

class ProfileRemoteDataSourceImpl implements ProfileRemoteDataSource {
  final Dio dio;

  ProfileRemoteDataSourceImpl({required this.dio});

  @override
  Future<Map<String, dynamic>> getProfile(String token) async {
    try {
      final response = await dio.get(
        '${ApiConstants.baseUrl}/me',
        options: Options(
          headers: {'Authorization': 'Bearer $token'},
        ),
      );

      if (response.statusCode == 200 && response.data['success'] == true) {
        return response.data['data'];
      }

      throw Exception('Failed to get profile');
    } catch (e) {
      throw Exception('Profile error: $e');
    }
  }

  @override
  Future<Map<String, dynamic>> updateProfile(
    String token,
    Map<String, dynamic> data,
  ) async {
    try {
      final response = await dio.put(
        '${ApiConstants.baseUrl}/profile',
        data: data,
        options: Options(
          headers: {'Authorization': 'Bearer $token'},
        ),
      );

      if (response.statusCode == 200 && response.data['success'] == true) {
        return response.data['data'];
      }

      throw Exception('Failed to update profile');
    } catch (e) {
      throw Exception('Update profile error: $e');
    }
  }
}
