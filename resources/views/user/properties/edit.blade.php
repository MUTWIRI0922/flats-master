<style>
    .modal-content {
        border-radius: 0.5rem;
    }

    #addPropertyModal {
        font-size: 0.75rem;
    }

    select option {
        font-size: 0.75rem;
    }
</style>
<div class="modal fade" id="editPropertyModal" tabindex="-1" aria-labelledby="editPropertyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="editPropertyForm"  action="{{route('user.property.update', $property->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="editPropertyModalLabel">Edit Property</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label for="property_name" class="form-label">Property Name</label>
                            <input type="text" class="form-control" id="property_name" name="name" value="{{$property->name}}" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="property_address" class="form-label">Location</label>
                            <input type="text" class="form-control" id="property_address" name="location" value="{{$property->location}}" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="property_type" class="form-label">Type</label>
                            <select class="form-select" id="property_type" name="property_type">
                                <option value="">Select Type</option>
                                <option value="residential">Residential</option>
                                <option value="commercial">Commercial</option>
                            </select>
                        </div>
                        <!-- <div class="col-12 col-md-6">
                            <label for="property_units" class="form-label">Number of Units</label>
                            <input type="number" class="form-control" id="property_units" name="property_units">
                        </div> -->
                        <div class="col-12">
                            <label for="property_features" class="form-label">Features</label>
                            <textarea class="form-control" id="property_features" name="amenities" rows="3">{{$property->amenities}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>