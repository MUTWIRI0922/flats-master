
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editPropertyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="editProfileForm"  action="{{route('user.profile.update', $user->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="editProfileModalLabel">Edit Profile</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label for="profile_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="profile_name" name="first_name" value="{{$user->first_name}}" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="profile_last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="profile_last_name" name="last_name" value="{{$user->last_name}}" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="profile_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="profile_email" name="email" value="{{$user->email}}" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="profile_phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="profile_phone" name="phone" value="{{$user->phone}}" required>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-save"></i> Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>