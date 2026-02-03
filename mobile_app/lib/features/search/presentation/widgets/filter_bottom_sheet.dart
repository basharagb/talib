import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import '../../../../core/constants/app_colors.dart';
import '../../domain/entities/filter_options.dart';
import '../bloc/search_bloc.dart';

class FilterBottomSheet extends StatefulWidget {
  final Function(FilterOptions) onApplyFilters;

  const FilterBottomSheet({
    super.key,
    required this.onApplyFilters,
  });

  @override
  State<FilterBottomSheet> createState() => _FilterBottomSheetState();
}

class _FilterBottomSheetState extends State<FilterBottomSheet> {
  String? selectedType;
  int? selectedCountryId;
  int? selectedCityId;
  int? selectedSubjectId;
  int? selectedStageId;

  @override
  void initState() {
    super.initState();
    context.read<SearchBloc>().add(const LoadFilterOptions());
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      decoration: const BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.vertical(top: Radius.circular(20)),
      ),
      padding: EdgeInsets.only(
        bottom: MediaQuery.of(context).viewInsets.bottom,
      ),
      child: Column(
        mainAxisSize: MainAxisSize.min,
        children: [
          Container(
            margin: const EdgeInsets.symmetric(vertical: 12),
            width: 40,
            height: 4,
            decoration: BoxDecoration(
              color: Colors.grey[300],
              borderRadius: BorderRadius.circular(2),
            ),
          ),
          Padding(
            padding: const EdgeInsets.symmetric(horizontal: 16),
            child: Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                const Text(
                  'فلترة النتائج',
                  style: TextStyle(
                    fontSize: 20,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                TextButton(
                  onPressed: () {
                    setState(() {
                      selectedType = null;
                      selectedCountryId = null;
                      selectedCityId = null;
                      selectedSubjectId = null;
                      selectedStageId = null;
                    });
                  },
                  child: const Text('إعادة تعيين'),
                ),
              ],
            ),
          ),
          const Divider(),
          Flexible(
            child: SingleChildScrollView(
              padding: const EdgeInsets.all(16),
              child: BlocBuilder<SearchBloc, SearchState>(
                builder: (context, state) {
                  if (state is! FilterOptionsLoaded) {
                    return const Center(
                      child: CircularProgressIndicator(),
                    );
                  }

                  return Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      _buildTypeFilter(),
                      const SizedBox(height: 16),
                      _buildCountryFilter(state.countries),
                      if (selectedCountryId != null) ...[
                        const SizedBox(height: 16),
                        _buildCityFilter(state.cities ?? []),
                      ],
                      const SizedBox(height: 16),
                      _buildSubjectFilter(state.subjects),
                      const SizedBox(height: 16),
                      _buildStageFilter(state.educationalStages),
                    ],
                  );
                },
              ),
            ),
          ),
          Padding(
            padding: const EdgeInsets.all(16),
            child: SizedBox(
              width: double.infinity,
              child: ElevatedButton(
                onPressed: () {
                  final filters = FilterOptions(
                    type: selectedType,
                    countryId: selectedCountryId,
                    cityId: selectedCityId,
                    subjectId: selectedSubjectId,
                    educationalStageId: selectedStageId,
                  );
                  widget.onApplyFilters(filters);
                  Navigator.pop(context);
                },
                style: ElevatedButton.styleFrom(
                  padding: const EdgeInsets.symmetric(vertical: 16),
                ),
                child: const Text('تطبيق الفلاتر'),
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildTypeFilter() {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        const Text(
          'النوع',
          style: TextStyle(
            fontSize: 16,
            fontWeight: FontWeight.bold,
          ),
        ),
        const SizedBox(height: 8),
        Wrap(
          spacing: 8,
          runSpacing: 8,
          children: [
            _buildChip('الكل', null),
            _buildChip('معلم', 'teacher'),
            _buildChip('مدرسة', 'school'),
            _buildChip('مركز تعليمي', 'educational_center'),
            _buildChip('روضة', 'kindergarten'),
            _buildChip('حضانة', 'nursery'),
          ],
        ),
      ],
    );
  }

  Widget _buildChip(String label, String? value) {
    final isSelected = selectedType == value;
    return FilterChip(
      label: Text(label),
      selected: isSelected,
      onSelected: (selected) {
        setState(() {
          selectedType = selected ? value : null;
        });
      },
      selectedColor: AppColors.primary.withOpacity(0.2),
      checkmarkColor: AppColors.primary,
    );
  }

  Widget _buildCountryFilter(List<Map<String, dynamic>> countries) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        const Text(
          'الدولة',
          style: TextStyle(
            fontSize: 16,
            fontWeight: FontWeight.bold,
          ),
        ),
        const SizedBox(height: 8),
        DropdownButtonFormField<int>(
          value: selectedCountryId,
          decoration: const InputDecoration(
            hintText: 'اختر الدولة',
            border: OutlineInputBorder(),
          ),
          items: countries.map((country) {
            return DropdownMenuItem<int>(
              value: country['id'],
              child: Text(country['name_ar'] ?? country['name_en']),
            );
          }).toList(),
          onChanged: (value) {
            setState(() {
              selectedCountryId = value;
              selectedCityId = null;
            });
            if (value != null) {
              context.read<SearchBloc>().add(LoadCities(value));
            }
          },
        ),
      ],
    );
  }

  Widget _buildCityFilter(List<Map<String, dynamic>> cities) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        const Text(
          'المدينة',
          style: TextStyle(
            fontSize: 16,
            fontWeight: FontWeight.bold,
          ),
        ),
        const SizedBox(height: 8),
        DropdownButtonFormField<int>(
          value: selectedCityId,
          decoration: const InputDecoration(
            hintText: 'اختر المدينة',
            border: OutlineInputBorder(),
          ),
          items: cities.map((city) {
            return DropdownMenuItem<int>(
              value: city['id'],
              child: Text(city['name_ar'] ?? city['name_en']),
            );
          }).toList(),
          onChanged: (value) {
            setState(() {
              selectedCityId = value;
            });
          },
        ),
      ],
    );
  }

  Widget _buildSubjectFilter(List<Map<String, dynamic>> subjects) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        const Text(
          'المادة',
          style: TextStyle(
            fontSize: 16,
            fontWeight: FontWeight.bold,
          ),
        ),
        const SizedBox(height: 8),
        DropdownButtonFormField<int>(
          value: selectedSubjectId,
          decoration: const InputDecoration(
            hintText: 'اختر المادة',
            border: OutlineInputBorder(),
          ),
          items: subjects.map((subject) {
            return DropdownMenuItem<int>(
              value: subject['id'],
              child: Text(subject['name_ar'] ?? subject['name_en']),
            );
          }).toList(),
          onChanged: (value) {
            setState(() {
              selectedSubjectId = value;
            });
          },
        ),
      ],
    );
  }

  Widget _buildStageFilter(List<Map<String, dynamic>> stages) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        const Text(
          'المرحلة الدراسية',
          style: TextStyle(
            fontSize: 16,
            fontWeight: FontWeight.bold,
          ),
        ),
        const SizedBox(height: 8),
        DropdownButtonFormField<int>(
          value: selectedStageId,
          decoration: const InputDecoration(
            hintText: 'اختر المرحلة',
            border: OutlineInputBorder(),
          ),
          items: stages.map((stage) {
            return DropdownMenuItem<int>(
              value: stage['id'],
              child: Text(stage['name_ar'] ?? stage['name_en']),
            );
          }).toList(),
          onChanged: (value) {
            setState(() {
              selectedStageId = value;
            });
          },
        ),
      ],
    );
  }
}
