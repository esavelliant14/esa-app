
//START ADD USER
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
//END ADD USER

//START VIEW PERMISSION
document.addEventListener('DOMContentLoaded', function() {
    // Event listener untuk tombol view dengan class 'view-permission-privilege'
    document.querySelectorAll('.view-permission-privilege').forEach(button => {
        button.addEventListener('click', function() {
            // Ambil ID privilege yang ingin ditampilkan dari data-id
            const idPrivilege = this.getAttribute('data-id');
            const nameGroup = this.getAttribute('data-group');
            const namePrivilege = this.getAttribute('data-privilege');
            
            // Lakukan AJAX request ke controller untuk mendapatkan data permission
            fetch(`/esa-app/privilege/view-permission-privilege/${idPrivilege}`, {
                method: 'GET',  // Pastikan menggunakan metode yang sesuai (GET, POST, dsb.)
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',  // Menambahkan header untuk mendeteksi permintaan sebagai AJAX
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')  // CSRF token untuk keamanan
                }
            })
                .then(response => response.json())
                .then(data => {
                    // Ambil data permissions dari response
                    const permissions = data.permissions;
                    // Set group data (jika perlu, ganti dengan data grup yang sesuai)
                    document.getElementById('varPrivilegeGroup').value = "Group Name";  // Ganti dengan nama grup yang sesuai
                    document.getElementById('varPermissionPrivilegeId').value = idPrivilege;
                    document.getElementById('varPermissionPrivilegeGroup').value = nameGroup;
                    document.getElementById('varPermissionPrivilegeName').value = namePrivilege;
                    // Update checkbox berdasarkan data permission yang diterima
                    document.querySelectorAll('input[name="txt_permission[]"]').forEach(input => {
                        // Cek apakah id_permission ada dalam data yang diterima
                        if (permissions.includes(parseInt(input.value))) {
                            input.checked = true;
                        } else {
                            input.checked = false;
                        }
                    });

                    // Tampilkan modal menggunakan Bootstrap
                    const modal = new bootstrap.Modal(document.getElementById('ModalViewPermissionPrivilege'));
                    modal.show();
                    document.getElementById('ModalViewPermissionPrivilege').addEventListener('hidden.bs.modal', function () {
                        const modalBackdrop = document.querySelector('.modal-backdrop');
                        if (modalBackdrop) {
                            modalBackdrop.remove();  // Menghapus backdrop setelah modal tertutup
                        }
                    });
                })
                .catch(error => console.error('Error:', error));
        });
    });
});
//END VIEW PERMISSION


//START EDIT USER
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
//END EDIT USER



//START COMBOBOX ADD PRIVILEGE
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
    const selectEditPrivilege = document.getElementById('filter_edit_privilege');
    const selectViewLog = document.getElementById('filter_view_log');
    const selectViewNasMenu = document.getElementById('filter_menu_viewnas');
    const selectViewNasRouters = document.getElementById('filter_menu_nasrouter');
    const selectFullNasRouters = document.getElementById('filter_menu_full_nasrouter');
    const selectViewNasAttribute = document.getElementById('filter_menu_nasattribute');
    const selectFullNasAttribute = document.getElementById('filter_menu_full_nasattribute');
    const selectViewNasUsers = document.getElementById('filter_menu_nasusers');
    const selectFullNasUsers = document.getElementById('filter_menu_full_nasusers');
    const selectEnaDisNasUsers = document.getElementById('filter_menu_enabledisable_nasusers');
    const selectViewNasProfiles = document.getElementById('filter_menu_nasprofiles');
    const selectFullNasProfiles = document.getElementById('filter_menu_full_nasprofiles');

    
    
    
    // Function to apply the state of enabled/disabled for various elements
    function applyPrivileges() {
        
        if (selectGroupPrivilege.value === "1") { 

            selectAdministrator.disabled = false;
            selectViewLog.disabled = false;
            selectViewUser.disabled = !selectAdministrator.checked;
            selectViewPrivilege.disabled = !selectAdministrator.checked;
            selectViewLog.disabled = !selectAdministrator.checked;
            selectViewGroup.disabled = !selectAdministrator.checked;
            selectViewNasMenu.disabled = false;
            selectViewNasRouters.disabled = !selectViewNasMenu.checked;
            selectViewNasAttribute.disabled = !selectViewNasMenu.checked;
            selectViewNasUsers.disabled = !selectViewNasMenu.checked;
            selectViewNasProfiles.disabled = !selectViewNasMenu.checked;

        }else if(selectGroupPrivilege.value === "") {
            selectAdministrator.disabled = true;
            selectViewUser.disabled = true;
            selectCreateUser.disabled = true;
            selectDeleteUser.disabled = true;
            selectEditUser.disabled = true;
            selectResetUser.disabled = true;
            selectViewPrivilege.disabled = true;
            selectCreatePrivilege.disabled = true;
            selectDeletePrivilege.disabled = true;
            selectEditPrivilege.disabled = true;
            selectViewGroup.disabled = true;
            selectCreateGroup.disabled = true; 
            selectDeleteGroup.disabled = true;
            selectViewLog.disabled = true;
            selectViewNasMenu.disabled = true;
            selectViewNasRouters.disabled = true;
            selectViewNasAttribute.disabled = true;
            selectViewNasUsers.disabled = true;
            selectViewNasProfiles.disabled = true;
        }else {
            selectAdministrator.disabled = false;
            selectViewUser.disabled = !selectAdministrator.checked;
            selectViewPrivilege.disabled = !selectAdministrator.checked;
            selectViewGroup.disabled = true;
            selectCreateGroup.disabled = true; 
            selectDeleteGroup.disabled = true;
            selectViewLog.disabled = true;
            selectViewNasMenu.disabled = false;
            selectViewNasRouters.disabled = !selectViewNasMenu.checked;
            selectViewNasAttribute.disabled = !selectViewNasMenu.checked;
            selectViewNasUsers.disabled = !selectViewNasMenu.checked;
            selectViewNasProfiles.disabled = !selectViewNasMenu.checked;
            
        }
    }

    // Run the function when the page loads
    applyPrivileges();

    // Add event listeners for real-time updates
    selectGroupPrivilege.addEventListener('change', applyPrivileges);
    selectAdministrator.addEventListener('change', applyPrivileges);
    selectViewNasMenu.addEventListener('change', applyPrivileges);
    
    selectViewUser.addEventListener('change', function(){
        selectCreateUser.disabled = !selectViewUser.checked;
        selectDeleteUser.disabled = !selectViewUser.checked;
        selectEditUser.disabled = !selectViewUser.checked;
        selectResetUser.disabled = !selectViewUser.checked;

    });
    selectViewPrivilege.addEventListener('change', function(){
        selectCreatePrivilege.disabled = !selectViewPrivilege.checked;
        selectDeletePrivilege.disabled = !selectViewPrivilege.checked;
        selectEditPrivilege.disabled = !selectViewPrivilege.checked;
    });
    selectViewGroup.addEventListener('change',function(){
        selectCreateGroup.disabled = !selectViewGroup.checked;  
        selectDeleteGroup.disabled = !selectViewGroup.checked;
    });
    selectViewNasRouters.addEventListener('change', function(){
        selectFullNasRouters.disabled = !selectViewNasRouters.checked;
    });
    selectViewNasAttribute.addEventListener('change', function(){
        selectFullNasAttribute.disabled = !selectViewNasAttribute.checked;
    });
    selectViewNasUsers.addEventListener('change', function(){
        selectFullNasUsers.disabled = !selectViewNasUsers.checked;
        selectEnaDisNasUsers.disabled = !selectViewNasUsers.checked;
    });
    selectViewNasProfiles.addEventListener('change', function(){
        selectFullNasProfiles.disabled = !selectViewNasProfiles.checked;
    });

});
//END COMBOBOX ADD PRIVILEGE



//START EDIT PRIVILEGE
document.addEventListener('DOMContentLoaded', function() {
    const editButton = document.querySelectorAll('.edit-privilege');
    editButton.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const group = this.dataset.group
            const privilege = this.dataset.privilege
            const selectGroupPrivilege = this.dataset.groupid;
            document.getElementById('varPrivilegeId').value = id;
            document.getElementById('varPrivilegeGroup').value = group;
            document.getElementById('varPrivilegeName').value = privilege;
            
            if (selectGroupPrivilege == 1) { 
                const selectCreateGroup = document.getElementById('filter_edit_create_group');
                const selectDeleteGroup = document.getElementById('filter_edit_delete_group');
                const selectViewGroup = document.getElementById('filter_edit_view_group');
                const selectViewLog = document.getElementById('filter_edit_view_log');
                const selectAdministrator = document.getElementById('filter_edit_administrator');
                const selectViewUser = document.getElementById('filter_edit_view_user');
                const selectViewPrivilege = document.getElementById('filter_edit_view_privilege');
                const selectCreateUser = document.getElementById('filter_edit_create_user');
                const selectDeleteUser = document.getElementById('filter_edit_delete_user');
                const selectEditUser = document.getElementById('filter_edit_edit_user');
                const selectResetUser = document.getElementById('filter_edit_reset_user');
                const selectCreatePrivilege = document.getElementById('filter_edit_create_privilege');
                const selectDeletePrivilege = document.getElementById('filter_edit_delete_privilege');
                const selectEditPrivilege = document.getElementById('filter_edit_edit_privilege');
                
                //default value select on user
                selectAdministrator.checked = false;
                selectViewUser.checked = false;
                selectCreateUser.checked = false
                selectDeleteUser.checked = false
                selectEditUser.checked = false
                selectResetUser.checked = false

                //default value select on privilege
                selectViewPrivilege.checked = false
                selectCreatePrivilege.checked = false
                selectDeletePrivilege.checked = false
                selectEditPrivilege.checked = false

                //default value select on group and admin
                selectCreateGroup.checked = false
                selectDeleteGroup.checked = false
                selectViewLog.checked = false
                selectViewGroup.checked = false

                selectAdministrator.addEventListener('change', function() {
                    selectViewUser.disabled = !selectAdministrator.checked;
                    selectViewPrivilege.disabled = !selectAdministrator.checked;
                    selectViewLog.disabled = !selectAdministrator.checked;
                    selectViewGroup.disabled= !selectAdministrator.checked;
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
                    selectEditPrivilege.disabled = !selectViewPrivilege.checked;
                });
                selectViewGroup.addEventListener('change',function(){
                    selectCreateGroup.disabled = !selectViewGroup.checked;  
                    selectDeleteGroup.disabled = !selectViewGroup.checked;
                });
            }else if (selectGroupPrivilege != 1){
                const selectCreateGroup = document.getElementById('filter_edit_create_group');
                const selectDeleteGroup = document.getElementById('filter_edit_delete_group');
                const selectViewGroup = document.getElementById('filter_edit_view_group');
                const selectViewLog = document.getElementById('filter_edit_view_log');
                const selectAdministrator = document.getElementById('filter_edit_administrator');
                const selectViewUser = document.getElementById('filter_edit_view_user');
                const selectViewPrivilege = document.getElementById('filter_edit_view_privilege');
                const selectCreateUser = document.getElementById('filter_edit_create_user');
                const selectDeleteUser = document.getElementById('filter_edit_delete_user');
                const selectEditUser = document.getElementById('filter_edit_edit_user');
                const selectResetUser = document.getElementById('filter_edit_reset_user');
                const selectCreatePrivilege = document.getElementById('filter_edit_create_privilege');
                const selectDeletePrivilege = document.getElementById('filter_edit_delete_privilege');
                const selectEditPrivilege = document.getElementById('filter_edit_edit_privilege');
                
                selectAdministrator.addEventListener('change', function() {
                    selectViewUser.disabled = !selectAdministrator.checked;
                    selectViewPrivilege.disabled = !selectAdministrator.checked;
                    selectViewGroup.disabled = true;
                    selectCreateGroup.disabled = true; 
                    selectDeleteGroup.disabled = true;
                    selectViewLog.disabled = true;
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
                    selectEditPrivilege.disabled = !selectViewPrivilege.checked;
                    
                });
            }
        });
    });
    
});
//END EDIT PRIVILEGE

//START VIEW LOG
document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.view-log');
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const logactionby = this.dataset.logactionby;
            const logcategory = this.dataset.logcategory;
            const logipaddress = this.dataset.logipaddress;
            const logstatus = this.dataset.logstatus;
            const logagent = this.dataset.logagent;
            const logdetails = this.dataset.logdetails;
            const logcreatedat = this.dataset.logcreatedat;

            document.getElementById('varLogActionBy').value = logactionby;
            document.getElementById('varLogCategory').value = logcategory;
            document.getElementById('varLogIpAddress').value = logipaddress;
            document.getElementById('varLogStatus').value = logstatus;
            document.getElementById('varLogAgent').value = logagent;
            document.getElementById('varLogDetails').value = logdetails;
            document.getElementById('varLogCreatedAt').value = logcreatedat;
            
        });
    });
});
//END VIEW LOG

//START SEARCH HOSTNAME
// di file JS eksternal
$(document).ready(function () {
    const userGroupId = window.userGroupId;

    function loadHostname() {
        $('#id_search_hostname').html('<option value="">Loading...</option>');

        $.ajax({
            url: '/esa-app/services/bwm/search-hostname/' + userGroupId,
            type: 'GET',
            success: function (data) {
                var options = '<option value="">--- Choose Hostname ---</option>';
                $.each(data, function (key, value) {
                    options += '<option value="' + value + '">' + value + '</option>';
                });
                $('#id_search_hostname').html(options);
            },
            error: function () {
                alert('Failed to get data.');
            }
        });
    }

    // Setiap kali modal dibuka langsung load dengan userGroupId
    $('#ModalAddBwmBw').on('shown.bs.modal', function () {
        loadHostname();
    });

    // Atau kalau mau load langsung di awal halaman:
    // loadHostname();
});

//END SEARCH HOSTNAME
