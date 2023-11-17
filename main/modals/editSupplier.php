<!-- Modal -->
<div class="modal fade" id="editSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa nhà cung cấp</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row justify-content-center align-items-center h-100 my-5 p-3">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="edit_name">Tên nhà cung cấp</label>
                                        <input type="text" name="edit_name" id="edit_name"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="edit_contact_person">Người liên hệ</label>
                                        <input type="text" name="edit_contact_person" id="edit_contact_person"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="edit_contact_number">Số liên hệ</label>
                                        <input type="text" name="edit_contact_number" id="edit_contact_number"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-4 pb-2">
                                    <div class="form-outline">
                                        <label class="form-label" for="logo">Logo</label>
                                        <input class="form-control form-control-sm" id="logo" name="edit_logo"
                                            type="hidden" />
                                        <input class="form-control form-control-sm" id="logo" name="edit_logo"
                                            type="file" />
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="" placeholder="" name="edit_id" id="id">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn bg-gradient-primary" name="editSupplier">Xác nhận</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const myModal = document.getElementById('editSupplier')
    myModal.addEventListener('shown.bs.modal', function () {
        const id = document.querySelector('input[name="edit_id"]');
        const name = document.querySelector('input[name="edit_name"]');
        const logo = document.querySelector('input[name="edit_logo"]');
        const contact_person = document.querySelector('input[name="edit_contact_person"]');
        const contact_number = document.querySelector('input[name="edit_contact_number"]');

        const button = event.relatedTarget
        const recipient = button.getAttribute('data-value')
        const val = JSON.parse(recipient)

        name.setAttribute('value', val.name);
        logo.setAttribute('value', val.logo);
        contact_person.setAttribute('value', val.contact_person);
        contact_number.setAttribute('value', val.contact_number);
        id.setAttribute('value', val.id);
    })
</script>