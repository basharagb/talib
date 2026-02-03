part of 'search_bloc.dart';

abstract class SearchState extends Equatable {
  const SearchState();

  @override
  List<Object?> get props => [];
}

class SearchInitial extends SearchState {}

class SearchLoading extends SearchState {}

class SearchLoaded extends SearchState {
  final List<SearchResult> results;
  final String query;
  final FilterOptions filters;

  const SearchLoaded({
    required this.results,
    required this.query,
    required this.filters,
  });

  @override
  List<Object?> get props => [results, query, filters];
}

class SearchError extends SearchState {
  final String message;

  const SearchError({required this.message});

  @override
  List<Object?> get props => [message];
}

class FilterOptionsLoaded extends SearchState {
  final List<Map<String, dynamic>> countries;
  final List<Map<String, dynamic>> subjects;
  final List<Map<String, dynamic>> educationalStages;
  final List<Map<String, dynamic>>? cities;

  const FilterOptionsLoaded({
    required this.countries,
    required this.subjects,
    required this.educationalStages,
    this.cities,
  });

  @override
  List<Object?> get props => [countries, subjects, educationalStages, cities];
}
