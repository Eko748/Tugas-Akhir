<div class="modal fade" id="updateMember" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-pencil"></i>  <strong>Member</strong></h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formUpdateMember" class="theme-form" method="POST">
                @method('PUT')
                <div class="modal-body" id="modal-content-edit">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" onclick="editForm()" class="btn btn-sm btn-primary btn-block">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
