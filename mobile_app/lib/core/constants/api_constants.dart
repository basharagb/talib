class ApiConstants {
  static const String baseUrl = 'https://talib.live';
  static const String apiBaseUrl = '$baseUrl/api';
  
  static const String login = '/login';
  static const String register = '/register';
  static const String logout = '/logout';
  static const String refreshToken = '/refresh';
  static const String profile = '/profile';
  
  static const int connectionTimeout = 30000;
  static const int receiveTimeout = 30000;
}
