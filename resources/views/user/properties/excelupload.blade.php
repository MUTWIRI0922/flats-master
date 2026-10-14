<div class="modal fade" id="excelUploadModal" tabindex="-1" aria-labelledby="excelUploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="excelUploadForm" method="POST" action="{{ route('units.import', $property->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="excelUploadModalLabel">Excel Upload</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3 align-items-center">
                        <div class="col-12 col-md-6">
                            <label for="property_name" class="form-label">Property Name</label>
                            <input type="text" class="form-control" id="property_name" name="name" value="{{$property->name ?? ''}}" disabled>
                        </div>
                        <div class="col-12 col-md-6">
                            <a href="{{ route('units.importtemplate') }}" class="btn btn-outline-primary btn-sm" target="_blank">
                                <i class="bi bi-download"></i> Download Template
                            </a>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="property_type" class="form-label">Click to upload Excel file</label>
                            <input type="file" class="form-control" id="property_type" name="excel_file" accept=".xlsx, .xls" required>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Upload Excel</button>
                </div>
            </form>
        </div>
    </div>
</div>