import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import '../../../../core/constants/app_colors.dart';
import '../../../../core/widgets/loading_widget.dart';
import '../../../../core/widgets/error_widget.dart';
import '../../../../core/utils/animations.dart';
import '../bloc/search_bloc.dart';
import '../widgets/search_bar_widget.dart';
import '../widgets/search_result_card.dart';
import '../widgets/filter_bottom_sheet.dart';

class SearchPage extends StatefulWidget {
  const SearchPage({super.key});

  @override
  State<SearchPage> createState() => _SearchPageState();
}

class _SearchPageState extends State<SearchPage> {
  final TextEditingController _searchController = TextEditingController();

  @override
  void dispose() {
    _searchController.dispose();
    super.dispose();
  }

  void _showFilterSheet() {
    showModalBottomSheet(
      context: context,
      isScrollControlled: true,
      backgroundColor: Colors.transparent,
      builder: (context) => FilterBottomSheet(
        onApplyFilters: (filters) {
          context.read<SearchBloc>().add(SearchFilterChanged(filters));
        },
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('البحث'),
        actions: [
          IconButton(
            icon: const Icon(Icons.filter_list),
            onPressed: _showFilterSheet,
          ),
        ],
      ),
      body: Column(
        children: [
          SearchBarWidget(
            controller: _searchController,
            onSearch: (query) {
              context.read<SearchBloc>().add(SearchQueryChanged(query));
            },
          ),
          Expanded(
            child: BlocBuilder<SearchBloc, SearchState>(
              builder: (context, state) {
                if (state is SearchInitial) {
                  return const EmptyStateWidget(
                    message: 'ابحث عن معلمين، مدارس، مراكز تعليمية وأكثر',
                    icon: Icons.search,
                  );
                }

                if (state is SearchLoading) {
                  return const LoadingWidget(message: 'جاري البحث...');
                }

                if (state is SearchError) {
                  return ErrorDisplayWidget(
                    message: state.message,
                    onRetry: () {
                      if (_searchController.text.isNotEmpty) {
                        context.read<SearchBloc>().add(
                              SearchQueryChanged(_searchController.text),
                            );
                      }
                    },
                  );
                }

                if (state is SearchLoaded) {
                  if (state.results.isEmpty) {
                    return const EmptyStateWidget(
                      message: 'لا توجد نتائج للبحث',
                      icon: Icons.search_off,
                    );
                  }

                  return ListView.builder(
                    padding: const EdgeInsets.all(16),
                    itemCount: state.results.length,
                    itemBuilder: (context, index) {
                      return AppAnimations.fadeSlideIn(
                        child: SearchResultCard(
                          result: state.results[index],
                          onTap: () {
                            // Navigate to details page
                          },
                        ),
                      );
                    },
                  );
                }

                return const SizedBox();
              },
            ),
          ),
        ],
      ),
    );
  }
}
