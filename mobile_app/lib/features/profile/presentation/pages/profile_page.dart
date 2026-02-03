import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import '../../../../core/constants/app_colors.dart';
import '../../../../core/widgets/loading_widget.dart';
import '../../../../core/widgets/error_widget.dart';
import '../../../../core/utils/animations.dart';
import '../../../../core/utils/formatters.dart';
import '../bloc/profile_bloc.dart';
import '../../../auth/presentation/bloc/auth_bloc.dart';
import '../../../auth/presentation/bloc/auth_event.dart';

class ProfilePage extends StatelessWidget {
  const ProfilePage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('الملف الشخصي'),
        actions: [
          IconButton(
            icon: const Icon(Icons.edit),
            onPressed: () {
              // Navigate to edit profile page
            },
          ),
        ],
      ),
      body: BlocBuilder<ProfileBloc, ProfileState>(
        builder: (context, state) {
          if (state is ProfileLoading) {
            return const LoadingWidget(message: 'جاري تحميل الملف الشخصي...');
          }

          if (state is ProfileError) {
            return ErrorDisplayWidget(
              message: state.message,
              onRetry: () {
                context.read<ProfileBloc>().add(const LoadProfile());
              },
            );
          }

          if (state is ProfileLoaded || state is ProfileUpdating) {
            final profile = state is ProfileLoaded
                ? state.profile
                : (state as ProfileUpdating).profile;

            return AppAnimations.fadeSlideIn(
              child: SingleChildScrollView(
                padding: const EdgeInsets.all(16),
                child: Column(
                  children: [
                    _buildProfileHeader(profile),
                    const SizedBox(height: 24),
                    _buildInfoCard(profile),
                    const SizedBox(height: 16),
                    _buildAccountStatusCard(profile),
                    const SizedBox(height: 24),
                    _buildActionButtons(context),
                  ],
                ),
              ),
            );
          }

          return const SizedBox();
        },
      ),
    );
  }

  Widget _buildProfileHeader(profile) {
    return Column(
      children: [
        CircleAvatar(
          radius: 60,
          backgroundColor: AppColors.primary.withOpacity(0.1),
          backgroundImage: profile.profileImage != null
              ? NetworkImage(profile.profileImage!)
              : null,
          child: profile.profileImage == null
              ? Text(
                  Formatters.getInitials(profile.name),
                  style: const TextStyle(
                    fontSize: 32,
                    fontWeight: FontWeight.bold,
                    color: AppColors.primary,
                  ),
                )
              : null,
        ),
        const SizedBox(height: 16),
        Text(
          profile.name,
          style: const TextStyle(
            fontSize: 24,
            fontWeight: FontWeight.bold,
            color: AppColors.textPrimary,
          ),
        ),
        const SizedBox(height: 4),
        Text(
          profile.email,
          style: const TextStyle(
            fontSize: 16,
            color: AppColors.textSecondary,
          ),
        ),
      ],
    );
  }

  Widget _buildInfoCard(profile) {
    return Card(
      elevation: 2,
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(12),
      ),
      child: Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const Text(
              'معلومات الحساب',
              style: TextStyle(
                fontSize: 18,
                fontWeight: FontWeight.bold,
                color: AppColors.textPrimary,
              ),
            ),
            const Divider(height: 24),
            _buildInfoRow(
              Icons.phone,
              'رقم الهاتف',
              profile.phone ?? 'غير محدد',
            ),
            const SizedBox(height: 12),
            _buildInfoRow(
              Icons.person_outline,
              'نوع الحساب',
              _getUserTypeLabel(profile.userType),
            ),
            const SizedBox(height: 12),
            _buildInfoRow(
              Icons.calendar_today,
              'تاريخ التسجيل',
              profile.createdAt != null
                  ? Formatters.formatDateArabic(profile.createdAt!)
                  : 'غير متوفر',
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildAccountStatusCard(profile) {
    return Card(
      elevation: 2,
      color: profile.isActive ? Colors.green[50] : Colors.orange[50],
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(12),
      ),
      child: Padding(
        padding: const EdgeInsets.all(16),
        child: Row(
          children: [
            Icon(
              profile.isActive ? Icons.check_circle : Icons.warning,
              color: profile.isActive ? Colors.green : Colors.orange,
              size: 32,
            ),
            const SizedBox(width: 12),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    profile.isActive ? 'حساب نشط' : 'حساب غير نشط',
                    style: TextStyle(
                      fontSize: 16,
                      fontWeight: FontWeight.bold,
                      color: profile.isActive ? Colors.green[700] : Colors.orange[700],
                    ),
                  ),
                  const SizedBox(height: 4),
                  Text(
                    profile.isActive
                        ? 'حسابك نشط ويمكنك استخدام جميع الميزات'
                        : 'يرجى تفعيل اشتراكك لاستخدام جميع الميزات',
                    style: TextStyle(
                      fontSize: 14,
                      color: profile.isActive ? Colors.green[600] : Colors.orange[600],
                    ),
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildActionButtons(BuildContext context) {
    return Column(
      children: [
        SizedBox(
          width: double.infinity,
          child: ElevatedButton.icon(
            onPressed: () {
              // Navigate to subscription page
            },
            icon: const Icon(Icons.card_membership),
            label: const Text('إدارة الاشتراك'),
            style: ElevatedButton.styleFrom(
              padding: const EdgeInsets.symmetric(vertical: 16),
            ),
          ),
        ),
        const SizedBox(height: 12),
        SizedBox(
          width: double.infinity,
          child: OutlinedButton.icon(
            onPressed: () {
              context.read<AuthBloc>().add(LogoutRequested());
              Navigator.of(context).pushReplacementNamed('/login');
            },
            icon: const Icon(Icons.logout),
            label: const Text('تسجيل الخروج'),
            style: OutlinedButton.styleFrom(
              padding: const EdgeInsets.symmetric(vertical: 16),
              foregroundColor: Colors.red,
              side: const BorderSide(color: Colors.red),
            ),
          ),
        ),
      ],
    );
  }

  Widget _buildInfoRow(IconData icon, String label, String value) {
    return Row(
      children: [
        Icon(icon, size: 20, color: AppColors.primary),
        const SizedBox(width: 12),
        Expanded(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(
                label,
                style: const TextStyle(
                  fontSize: 12,
                  color: AppColors.textSecondary,
                ),
              ),
              const SizedBox(height: 2),
              Text(
                value,
                style: const TextStyle(
                  fontSize: 16,
                  color: AppColors.textPrimary,
                  fontWeight: FontWeight.w500,
                ),
              ),
            ],
          ),
        ),
      ],
    );
  }

  String _getUserTypeLabel(String type) {
    switch (type) {
      case 'teacher':
        return 'معلم';
      case 'school':
        return 'مدرسة';
      case 'educational_center':
        return 'مركز تعليمي';
      case 'kindergarten':
        return 'روضة';
      case 'nursery':
        return 'حضانة';
      default:
        return type;
    }
  }
}
