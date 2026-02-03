import '../../domain/entities/search_result.dart';

class SearchResultModel extends SearchResult {
  const SearchResultModel({
    required super.id,
    required super.name,
    required super.type,
    super.bio,
    super.profileImage,
    super.country,
    super.city,
    super.subjects,
    super.rating,
    super.reviewCount,
  });

  factory SearchResultModel.fromJson(Map<String, dynamic> json) {
    return SearchResultModel(
      id: json['id'] ?? 0,
      name: json['full_name'] ?? json['name'] ?? '',
      type: json['type'] ?? 'teacher',
      bio: json['bio'] ?? json['description'] ?? '',
      profileImage: json['profile_image'] ?? json['logo'],
      country: json['country']?['name_ar'],
      city: json['city']?['name_ar'],
      subjects: (json['subjects'] as List?)
              ?.map((s) => s['name_ar'] as String)
              .toList() ??
          [],
      rating: (json['rating'] ?? 0.0).toDouble(),
      reviewCount: json['review_count'] ?? 0,
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'name': name,
      'type': type,
      'bio': bio,
      'profile_image': profileImage,
      'country': country,
      'city': city,
      'subjects': subjects,
      'rating': rating,
      'review_count': reviewCount,
    };
  }
}
