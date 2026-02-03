import 'package:equatable/equatable.dart';

class SearchResult extends Equatable {
  final int id;
  final String name;
  final String type;
  final String? bio;
  final String? profileImage;
  final String? country;
  final String? city;
  final List<String> subjects;
  final double rating;
  final int reviewCount;

  const SearchResult({
    required this.id,
    required this.name,
    required this.type,
    this.bio,
    this.profileImage,
    this.country,
    this.city,
    this.subjects = const [],
    this.rating = 0.0,
    this.reviewCount = 0,
  });

  @override
  List<Object?> get props => [
        id,
        name,
        type,
        bio,
        profileImage,
        country,
        city,
        subjects,
        rating,
        reviewCount,
      ];
}
