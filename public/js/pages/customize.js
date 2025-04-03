
//FOR ADD USER

$(document).ready(function () {
    function loadPrivilege(id) {
        $('#id_privilege_add_user').html('<option value="">Loading...</option>');

        if (id !== '') {
            $.ajax({
                url: '/esa-app/privilege/combo-privilege/' + id,
                type: 'GET',
                success: function (data) {
                    var options = '<option value="">--- Choose Privilege ---</option>';
                    $.each(data, function (key, value) {
                        options += '<option value="' + key + '">' + value + '</option>';
                    });
                    $('#id_privilege_add_user').html(options);
                },
                error: function () {
                    alert('Failed to get data.');
                }
            });
        } else {
            $('#id_privilege_add_user').html('<option value="">--- Choose Privilege ---</option>');
        }
    }

    // Ketika ada perubahan di #id_group_add_user, load data privilege
    $('#id_group_add_user').change(function () {
        var id = $(this).val();
        loadPrivilege(id);
    });

    // Ketika modal dibuka, cek nilai #id_group_add_user
    $('#ModalAddUser').on('shown.bs.modal', function () {
        var initialValues = $('#id_group_add_user').val();  // Ambil nilai dari #id_group_add_user

        // Jika #id_group_add_user kosong, set #id_privilege_add_user kosong
        if (!initialValues) {
            $('#id_privilege_add_user').html('<option value="">--- Choose Privilege ---</option>');
        } else {
            loadPrivilege(initialValues);  // Jika ada nilai, load privilege terkait
        }
    });
});


// FOR EDIT USER
$(document).ready(function () {
    // Fungsi untuk memproses perubahan pada #varGroupId
    function loadPrivileges(id) {
        $('#varPrivilege').html('<option value="">Loading...</option>');

        if (id !== '') {
            $.ajax({
                url: '/esa-app/privilege/combo-privilege/' + id,
                type: 'GET',
                success: function (data) {
                    var options = '<option value="">-- Choose Privilege --</option>';
                    $.each(data, function (key, value) {
                        options += '<option value="' + key + '">' + value + '</option>';
                    });
                    $('#varPrivilege').html(options);
                },
                error: function () {
                    alert('Failed to get data.');
                }
            });
        } else {
            $('#varPrivilege').html('<option value="">-- Choose Privilege --</option>');
        }
    }

    // Event untuk memanggil AJAX saat #varGroupId berubah
    $('#varGroupId').change(function () {
        var id = $(this).val();
        loadPrivileges(id);
    });

    // Menggunakan Bootstrap modal event `shown.bs.modal` untuk memastikan modal sepenuhnya ditampilkan
    $('#ModalEditUser').on('shown.bs.modal', function () {
        // Ambil nilai default yang sudah dipilih
        var initialValue = $('#varGroupId').val();

        // Jika nilai sudah ada (misalnya 1), langsung memanggil fungsi untuk memfilter #varPrivilege
        if (initialValue) {
            loadPrivileges(initialValue);
        }
    });
});




document.addEventListener('DOMContentLoaded', function() {
    const selectGroupPrivilege = document.getElementById('id_group_privilege');
    const selectCreateGroup = document.getElementById('filter_create_group');
    const selectDeleteGroup = document.getElementById('filter_delete_group');
    const selectViewGroup = document.getElementById('filter_view_group');
    const selectAdministrator = document.getElementById('filter_administrator');
    const selectViewUser = document.getElementById('filter_view_user');
    const selectViewPrivilege = document.getElementById('filter_view_privilege');
    const selectCreateUser = document.getElementById('filter_create_user');
    const selectDeleteUser = document.getElementById('filter_delete_user');
    const selectEditUser = document.getElementById('filter_edit_user');
    const selectResetUser = document.getElementById('filter_reset_user');
    const selectCreatePrivilege = document.getElementById('filter_create_privilege');
    const selectDeletePrivilege = document.getElementById('filter_delete_privilege');

    selectGroupPrivilege.addEventListener('change', function(){
        if (this.value === "1") {
            selectCreateGroup.disabled = false;  
            selectDeleteGroup.disabled = false;  
            selectViewGroup.disabled = false;
        } else {
            selectCreateGroup.disabled = true;  
            selectDeleteGroup.disabled = true;  
            selectViewGroup.disabled = true;
        }
    });
    selectAdministrator.addEventListener('change', function() {
        selectViewUser.disabled = !selectAdministrator.checked;
        selectViewPrivilege.disabled = !selectAdministrator.checked;
    });
    selectViewUser.addEventListener('change', function(){
        selectCreateUser.disabled = !selectViewUser.checked;
        selectDeleteUser.disabled = !selectViewUser.checked;
        selectEditUser.disabled = !selectViewUser.checked;
        selectResetUser.disabled = !selectViewUser.checked;

    });
    selectViewPrivilege.addEventListener('change', function(){
        selectCreatePrivilege.disabled = !selectViewPrivilege.checked;
        selectDeletePrivilege.disabled = !selectViewPrivilege.checked;
    });
});



//JS FOR EDIT PRIVILEGE
document.addEventListener('DOMContentLoaded', function() {
    const editButton = document.querySelectorAll('.edit-privilege');
    editButton.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const group = this.dataset.group
            const privilege = this.dataset.privilege

            document.getElementById('varId').value = id;
            document.getElementById('varPrivilegeGroup').value = group;
            document.getElementById('varPrivilegeName').value = privilege;
            
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const selectGroupPrivilege = document.getElementById('id_group_privilege');
    const selectCreateGroup = document.getElementById('filter_edit_create_group');
    const selectDeleteGroup = document.getElementById('filter_edit_delete_group');
    const selectViewGroup = document.getElementById('filter_edit_view_group');
    const selectAdministrator = document.getElementById('filter_edit_administrator');
    const selectViewUser = document.getElementById('filter_edit_view_user');
    const selectViewPrivilege = document.getElementById('filter_edit_view_privilege');
    const selectCreateUser = document.getElementById('filter_edit_create_user');
    const selectDeleteUser = document.getElementById('filter_edit_delete_user');
    const selectEditUser = document.getElementById('filter_edit_edit_user');
    const selectResetUser = document.getElementById('filter_edit_reset_user');
    const selectCreatePrivilege = document.getElementById('filter_edit_create_privilege');
    const selectDeletePrivilege = document.getElementById('filter_edit_delete_privilege');

    selectGroupPrivilege.addEventListener('change', function(){
        if (this.value === "1") {
            selectCreateGroup.disabled = false;  
            selectDeleteGroup.disabled = false;  
            selectViewGroup.disabled = false;
        } else {
            selectCreateGroup.disabled = true;  
            selectDeleteGroup.disabled = true;  
            selectViewGroup.disabled = true;
        }
    });
    selectAdministrator.addEventListener('change', function() {
        selectViewUser.disabled = !selectAdministrator.checked;
        selectViewPrivilege.disabled = !selectAdministrator.checked;
    });
    selectViewUser.addEventListener('change', function(){
        selectCreateUser.disabled = !selectViewUser.checked;
        selectDeleteUser.disabled = !selectViewUser.checked;
        selectEditUser.disabled = !selectViewUser.checked;
        selectResetUser.disabled = !selectViewUser.checked;

    });
    selectViewPrivilege.addEventListener('change', function(){
        selectCreatePrivilege.disabled = !selectViewPrivilege.checked;
        selectDeletePrivilege.disabled = !selectViewPrivilege.checked;
    });
});

//END JS EDIT PRIVILEGE

// JS FOR EDIT USER
document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.edit-user');
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const name = this.dataset.name;
            const email = this.dataset.email;
            const group = this.dataset.group
            const privilege = this.dataset.privilege
            const status = this.dataset.status
            const groupid = this.dataset.groupid

            document.getElementById('varId').value = id;
            document.getElementById('varName').value = name;
            document.getElementById('varEmail').value = email;
            document.getElementById('varGroup').value = group;
            document.getElementById('varPrivilege').value = privilege;
            document.getElementById('varStatus').value = status;
            document.getElementById('varGroupId').value = groupid;
            
        });
    });
});
