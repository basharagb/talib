part of 'search_bloc.dart';

abstract class SearchEvent extends Equatable {
  const SearchEvent();

  @override
  List<Object?> get props => [];
}

class SearchQueryChanged extends SearchEvent {
  final String query;

  const SearchQueryChanged(this.query);

  @override
  List<Object?> get props => [query];
}

class SearchFilterChanged extends SearchEvent {
  final FilterOptions filters;

  const SearchFilterChanged(this.filters);

  @override
  List<Object?> get props => [filters];
}

class LoadFilterOptions extends SearchEvent {
  const LoadFilterOptions();
}

class LoadCities extends SearchEvent {
  final int countryId;

  const LoadCities(this.countryId);

  @override
  List<Object?> get props => [countryId];
}
