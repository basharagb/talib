import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:equatable/equatable.dart';
import '../../domain/entities/user_profile.dart';
import '../../data/datasources/profile_remote_data_source.dart';
import '../../../auth/data/datasources/auth_local_data_source.dart';

part 'profile_event.dart';
part 'profile_state.dart';

class ProfileBloc extends Bloc<ProfileEvent, ProfileState> {
  final ProfileRemoteDataSource remoteDataSource;
  final AuthLocalDataSource localDataSource;

  ProfileBloc({required this.remoteDataSource, required this.localDataSource})
    : super(ProfileInitial()) {
    on<LoadProfile>(_onLoadProfile);
    on<UpdateProfile>(_onUpdateProfile);
  }

  Future<void> _onLoadProfile(
    LoadProfile event,
    Emitter<ProfileState> emit,
  ) async {
    emit(ProfileLoading());

    try {
      final token = await localDataSource.getCachedToken();
      if (token == null) {
        emit(const ProfileError(message: 'Not authenticated'));
        return;
      }

      final profileData = await remoteDataSource.getProfile(token);

      final profile = UserProfile(
        id: profileData['id'],
        name: profileData['name'],
        email: profileData['email'],
        phone: profileData['phone'],
        userType: profileData['user_type'] ?? 'teacher',
        isActive: profileData['is_active'] ?? false,
        profileImage: profileData['profile_image'],
        createdAt: profileData['created_at'] != null
            ? DateTime.parse(profileData['created_at'])
            : null,
      );

      emit(ProfileLoaded(profile: profile));
    } catch (e) {
      emit(ProfileError(message: e.toString()));
    }
  }

  Future<void> _onUpdateProfile(
    UpdateProfile event,
    Emitter<ProfileState> emit,
  ) async {
    final currentState = state;
    if (currentState is! ProfileLoaded) return;

    emit(ProfileUpdating(profile: currentState.profile));

    try {
      final token = await localDataSource.getCachedToken();
      if (token == null) {
        emit(const ProfileError(message: 'Not authenticated'));
        return;
      }

      final updatedData = await remoteDataSource.updateProfile(
        token,
        event.data,
      );

      final profile = UserProfile(
        id: updatedData['id'],
        name: updatedData['name'],
        email: updatedData['email'],
        phone: updatedData['phone'],
        userType: updatedData['user_type'] ?? 'teacher',
        isActive: updatedData['is_active'] ?? false,
        profileImage: updatedData['profile_image'],
        createdAt: updatedData['created_at'] != null
            ? DateTime.parse(updatedData['created_at'])
            : null,
      );

      emit(ProfileLoaded(profile: profile));
    } catch (e) {
      emit(ProfileError(message: e.toString()));
    }
  }
}
