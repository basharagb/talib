import 'package:equatable/equatable.dart';

class UserProfile extends Equatable {
  final int id;
  final String name;
  final String email;
  final String? phone;
  final String userType;
  final bool isActive;
  final String? profileImage;
  final DateTime? createdAt;

  const UserProfile({
    required this.id,
    required this.name,
    required this.email,
    this.phone,
    required this.userType,
    required this.isActive,
    this.profileImage,
    this.createdAt,
  });

  @override
  List<Object?> get props => [
        id,
        name,
        email,
        phone,
        userType,
        isActive,
        profileImage,
        createdAt,
      ];
}
