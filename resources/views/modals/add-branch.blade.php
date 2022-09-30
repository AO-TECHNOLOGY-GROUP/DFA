<div class="modal fade" id="branchModalCenter" tabindex="-1" role="dialog" aria-labelledby="branchModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="uil uil-university"></i> New Branch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('create') }}" method="POST">
                    @csrf
                    <div class="form-group row mb-3">
                        <label for="branchCode" class="col-3 col-form-label">Branch Code</label>
                        <div class="col-9">
                            <input type="text" class="form-control hidden" id="branchCode" placeholder="Auto generated"
                                   required value="{{ old('code') }}" name="code" disabled>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="branchName" class="col-3 col-form-label">Branch Name</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="branchName" placeholder="e.g. Kasarani"
                                   required value="{{ old('name') }}" name="name">
                        </div>
                    </div>
                    <br>

                    <button type="submit" class="btn btn-primary"><i class="uil-location-arrow"></i> Submit</button>

{{--                    <div class="modal-footer">--}}
{{--                    </div>--}}
                </form>
            </div>
        </div>
    </div>
</div>
