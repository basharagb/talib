import 'package:equatable/equatable.dart';

class FilterOptions extends Equatable {
  final String? type;
  final int? countryId;
  final int? cityId;
  final int? subjectId;
  final int? educationalStageId;

  const FilterOptions({
    this.type,
    this.countryId,
    this.cityId,
    this.subjectId,
    this.educationalStageId,
  });

  FilterOptions copyWith({
    String? type,
    int? countryId,
    int? cityId,
    int? subjectId,
    int? educationalStageId,
  }) {
    return FilterOptions(
      type: type ?? this.type,
      countryId: countryId ?? this.countryId,
      cityId: cityId ?? this.cityId,
      subjectId: subjectId ?? this.subjectId,
      educationalStageId: educationalStageId ?? this.educationalStageId,
    );
  }

  Map<String, dynamic> toQueryParams() {
    final params = <String, dynamic>{};
    if (type != null) params['type'] = type;
    if (countryId != null) params['country_id'] = countryId;
    if (cityId != null) params['city_id'] = cityId;
    if (subjectId != null) params['subject_id'] = subjectId;
    if (educationalStageId != null) {
      params['educational_stage_id'] = educationalStageId;
    }
    return params;
  }

  @override
  List<Object?> get props => [
        type,
        countryId,
        cityId,
        subjectId,
        educationalStageId,
      ];
}
