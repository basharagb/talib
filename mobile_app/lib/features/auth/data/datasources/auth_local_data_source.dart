import 'package:flutter_secure_storage/flutter_secure_storage.dart';
import 'package:shared_preferences/shared_preferences.dart';
import '../../../../core/error/exceptions.dart';
import '../models/user_model.dart';
import 'dart:convert';

abstract class AuthLocalDataSource {
  Future<void> cacheUser(UserModel user);
  Future<UserModel> getCachedUser();
  Future<void> cacheToken(String token);
  Future<String?> getCachedToken();
  Future<void> clearCache();
  Future<bool> isLoggedIn();
}

class AuthLocalDataSourceImpl implements AuthLocalDataSource {
  final SharedPreferences sharedPreferences;
  final FlutterSecureStorage secureStorage;

  static const String cachedUserKey = 'CACHED_USER';
  static const String cachedTokenKey = 'CACHED_TOKEN';
  static const String isLoggedInKey = 'IS_LOGGED_IN';

  AuthLocalDataSourceImpl({
    required this.sharedPreferences,
    required this.secureStorage,
  });

  @override
  Future<void> cacheUser(UserModel user) async {
    try {
      final userJson = json.encode(user.toJson());
      await sharedPreferences.setString(cachedUserKey, userJson);
      await sharedPreferences.setBool(isLoggedInKey, true);
    } catch (e) {
      throw CacheException('Failed to cache user');
    }
  }

  @override
  Future<UserModel> getCachedUser() async {
    try {
      final userJson = sharedPreferences.getString(cachedUserKey);
      if (userJson != null) {
        return UserModel.fromJson(json.decode(userJson));
      } else {
        throw CacheException('No cached user found');
      }
    } catch (e) {
      throw CacheException('Failed to get cached user');
    }
  }

  @override
  Future<void> cacheToken(String token) async {
    try {
      await secureStorage.write(key: cachedTokenKey, value: token);
    } catch (e) {
      throw CacheException('Failed to cache token');
    }
  }

  @override
  Future<String?> getCachedToken() async {
    try {
      return await secureStorage.read(key: cachedTokenKey);
    } catch (e) {
      throw CacheException('Failed to get cached token');
    }
  }

  @override
  Future<void> clearCache() async {
    try {
      await sharedPreferences.remove(cachedUserKey);
      await sharedPreferences.setBool(isLoggedInKey, false);
      await secureStorage.delete(key: cachedTokenKey);
    } catch (e) {
      throw CacheException('Failed to clear cache');
    }
  }

  @override
  Future<bool> isLoggedIn() async {
    return sharedPreferences.getBool(isLoggedInKey) ?? false;
  }
}
