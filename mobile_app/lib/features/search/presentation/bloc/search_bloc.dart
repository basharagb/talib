import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:equatable/equatable.dart';
import '../../domain/entities/search_result.dart';
import '../../domain/entities/filter_options.dart';
import '../../data/datasources/search_remote_data_source.dart';

part 'search_event.dart';
part 'search_state.dart';

class SearchBloc extends Bloc<SearchEvent, SearchState> {
  final SearchRemoteDataSource remoteDataSource;

  SearchBloc({required this.remoteDataSource}) : super(SearchInitial()) {
    on<SearchQueryChanged>(_onSearchQueryChanged);
    on<SearchFilterChanged>(_onSearchFilterChanged);
    on<LoadFilterOptions>(_onLoadFilterOptions);
    on<LoadCities>(_onLoadCities);
  }

  Future<void> _onSearchQueryChanged(
    SearchQueryChanged event,
    Emitter<SearchState> emit,
  ) async {
    if (event.query.isEmpty) {
      emit(SearchInitial());
      return;
    }

    emit(SearchLoading());

    try {
      final filters = state is SearchLoaded
          ? (state as SearchLoaded).filters.toQueryParams()
          : <String, dynamic>{};

      final results = await remoteDataSource.search(event.query, filters);

      emit(SearchLoaded(
        results: results,
        query: event.query,
        filters: state is SearchLoaded
            ? (state as SearchLoaded).filters
            : const FilterOptions(),
      ));
    } catch (e) {
      emit(SearchError(message: e.toString()));
    }
  }

  Future<void> _onSearchFilterChanged(
    SearchFilterChanged event,
    Emitter<SearchState> emit,
  ) async {
    final currentState = state;
    if (currentState is! SearchLoaded) return;

    emit(SearchLoading());

    try {
      final results = await remoteDataSource.search(
        currentState.query,
        event.filters.toQueryParams(),
      );

      emit(SearchLoaded(
        results: results,
        query: currentState.query,
        filters: event.filters,
      ));
    } catch (e) {
      emit(SearchError(message: e.toString()));
    }
  }

  Future<void> _onLoadFilterOptions(
    LoadFilterOptions event,
    Emitter<SearchState> emit,
  ) async {
    try {
      final countries = await remoteDataSource.getCountries();
      final subjects = await remoteDataSource.getSubjects();
      final stages = await remoteDataSource.getEducationalStages();

      emit(FilterOptionsLoaded(
        countries: countries,
        subjects: subjects,
        educationalStages: stages,
      ));
    } catch (e) {
      emit(SearchError(message: 'Failed to load filter options'));
    }
  }

  Future<void> _onLoadCities(
    LoadCities event,
    Emitter<SearchState> emit,
  ) async {
    try {
      final cities = await remoteDataSource.getCities(event.countryId);
      
      if (state is FilterOptionsLoaded) {
        final currentState = state as FilterOptionsLoaded;
        emit(FilterOptionsLoaded(
          countries: currentState.countries,
          subjects: currentState.subjects,
          educationalStages: currentState.educationalStages,
          cities: cities,
        ));
      }
    } catch (e) {
      emit(SearchError(message: 'Failed to load cities'));
    }
  }
}
