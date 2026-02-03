import 'package:dio/dio.dart';
import '../../../../core/constants/api_constants.dart';
import '../models/search_result_model.dart';

abstract class SearchRemoteDataSource {
  Future<List<SearchResultModel>> search(
    String query,
    Map<String, dynamic> filters,
  );
  Future<List<Map<String, dynamic>>> getCountries();
  Future<List<Map<String, dynamic>>> getCities(int countryId);
  Future<List<Map<String, dynamic>>> getSubjects();
  Future<List<Map<String, dynamic>>> getEducationalStages();
}

class SearchRemoteDataSourceImpl implements SearchRemoteDataSource {
  final Dio dio;

  SearchRemoteDataSourceImpl({required this.dio});

  @override
  Future<List<SearchResultModel>> search(
    String query,
    Map<String, dynamic> filters,
  ) async {
    try {
      final queryParams = {'query': query, ...filters};
      
      final response = await dio.get(
        '${ApiConstants.baseUrl}/search',
        queryParameters: queryParams,
      );

      if (response.statusCode == 200 && response.data['success'] == true) {
        final data = response.data['data'];
        final results = <SearchResultModel>[];

        if (data['teachers'] != null) {
          final teachers = data['teachers']['data'] as List;
          results.addAll(
            teachers.map((t) => SearchResultModel.fromJson({...t, 'type': 'teacher'})),
          );
        }

        if (data['schools'] != null) {
          final schools = data['schools']['data'] as List;
          results.addAll(
            schools.map((s) => SearchResultModel.fromJson({...s, 'type': 'school'})),
          );
        }

        if (data['educational_centers'] != null) {
          final centers = data['educational_centers']['data'] as List;
          results.addAll(
            centers.map((c) => SearchResultModel.fromJson({...c, 'type': 'educational_center'})),
          );
        }

        if (data['kindergartens'] != null) {
          final kindergartens = data['kindergartens']['data'] as List;
          results.addAll(
            kindergartens.map((k) => SearchResultModel.fromJson({...k, 'type': 'kindergarten'})),
          );
        }

        if (data['nurseries'] != null) {
          final nurseries = data['nurseries']['data'] as List;
          results.addAll(
            nurseries.map((n) => SearchResultModel.fromJson({...n, 'type': 'nursery'})),
          );
        }

        return results;
      }

      throw Exception('Failed to search');
    } catch (e) {
      throw Exception('Search error: $e');
    }
  }

  @override
  Future<List<Map<String, dynamic>>> getCountries() async {
    try {
      final response = await dio.get('${ApiConstants.baseUrl}/countries');

      if (response.statusCode == 200 && response.data['success'] == true) {
        return List<Map<String, dynamic>>.from(response.data['data']);
      }

      throw Exception('Failed to get countries');
    } catch (e) {
      throw Exception('Countries error: $e');
    }
  }

  @override
  Future<List<Map<String, dynamic>>> getCities(int countryId) async {
    try {
      final response = await dio.get(
        '${ApiConstants.baseUrl}/countries/$countryId/cities',
      );

      if (response.statusCode == 200 && response.data['success'] == true) {
        return List<Map<String, dynamic>>.from(response.data['data']);
      }

      throw Exception('Failed to get cities');
    } catch (e) {
      throw Exception('Cities error: $e');
    }
  }

  @override
  Future<List<Map<String, dynamic>>> getSubjects() async {
    try {
      final response = await dio.get('${ApiConstants.baseUrl}/subjects');

      if (response.statusCode == 200 && response.data['success'] == true) {
        return List<Map<String, dynamic>>.from(response.data['data']);
      }

      throw Exception('Failed to get subjects');
    } catch (e) {
      throw Exception('Subjects error: $e');
    }
  }

  @override
  Future<List<Map<String, dynamic>>> getEducationalStages() async {
    try {
      final response = await dio.get(
        '${ApiConstants.baseUrl}/educational-stages',
      );

      if (response.statusCode == 200 && response.data['success'] == true) {
        return List<Map<String, dynamic>>.from(response.data['data']);
      }

      throw Exception('Failed to get educational stages');
    } catch (e) {
      throw Exception('Educational stages error: $e');
    }
  }
}
