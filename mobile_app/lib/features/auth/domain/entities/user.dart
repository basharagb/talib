import 'package:equatable/equatable.dart';

class User extends Equatable {
  final int id;
  final String name;
  final String email;
  final String? role;
  final String? profileImage;

  const User({
    required this.id,
    required this.name,
    required this.email,
    this.role,
    this.profileImage,
  });

  @override
  List<Object?> get props => [id, name, email, role, profileImage];
}
