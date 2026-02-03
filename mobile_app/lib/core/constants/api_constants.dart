class ApiConstants {
  static const String baseUrl = 'https://talib.live/api';
  static const String apiBaseUrl = '$baseUrl';

  static const String login = '/login';
  static const String register = '/register';
  static const String logout = '/logout';
  static const String refreshToken = '/refresh';
  static const String profile = '/profile';

  static const Duration connectionTimeout = Duration(seconds: 30);
  static const Duration receiveTimeout = Duration(seconds: 30);
}
