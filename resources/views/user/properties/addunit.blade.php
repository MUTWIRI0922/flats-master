
<div class="modal fade" id="addUnitModal" tabindex="-1" aria-labelledby="addUnitModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="addUnitForm" method="POST" action="">
                @csrf
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="addUnitModalLabel">Add Unit</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label for="property_name" class="form-label">Property Name</label>
                            <input type="text" class="form-control" id="property_name" name="name" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="property_address" class="form-label">Location</label>
                            <input type="text" class="form-control" id="property_address" name="location" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="property_type" class="form-label">Type</label>
                            <select class="form-select" id="property_type" name="type" >
                                <option value="">Select Type</option>
                                <option value="Residential">Residential</option>
                                <option value="Commercial">Commercial</option>
                                <option value="Mixed">Mixed</option>
                            </select>
                        </div>
                        <!-- <div class="col-12 col-md-6">
                            <label for="property_units" class="form-label">Number of Units</label>
                            <input type="number" class="form-control" id="property_units" name="property_units" >
                        </div> -->
                        <div class="col-12">
                            <label for="property_features" class="form-label">Features</label>
                            <textarea class="form-control" id="property_features" name="amenities" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save Property</button>
                </div>
            </form>
        </div>
    </div>
</div>