
//START ADD USER
$(document).ready(function () {
    function loadPrivilege(id) {
        $('#id_privilege_add_user').html('<option value="">Loading...</option>');

        if (id !== '') {
            $.ajax({
                url: window.APP_URL + '/privilege/combo-privilege/' + id,
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
            const baseUrl = window.APP_URL; 
            
            // Lakukan AJAX request ke controller untuk mendapatkan data permission
            fetch(`${baseUrl}/privilege/view-permission-privilege/${idPrivilege}`, {
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
                url: window.APP_URL + '/privilege/combo-privilege/' + id,
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
    const selectViewServices = document.getElementById('filter_menu_viewservices');
    const selectViewDns = document.getElementById('filter_menu_dns');
    const selectFullDns = document.getElementById('filter_menu_full_dns');
    const selectViewBwm = document.getElementById('filter_menu_bwm');
    const selectFullBwm = document.getElementById('filter_menu_full_bwm');
    
    
    
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
            selectViewServices.disabled= false;

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
            selectViewServices.disabled= true;
            
        }else {
            selectAdministrator.disabled = false;
            selectViewUser.disabled = !selectAdministrator.checked;
            selectViewPrivilege.disabled = !selectAdministrator.checked;
            selectViewGroup.disabled = true;
            selectCreateGroup.disabled = true; 
            selectDeleteGroup.disabled = true;
            selectViewLog.disabled = !selectAdministrator.checked;
            selectViewNasMenu.disabled = false;
            selectViewNasRouters.disabled = !selectViewNasMenu.checked;
            selectViewNasAttribute.disabled = !selectViewNasMenu.checked;
            selectViewNasUsers.disabled = !selectViewNasMenu.checked;
            selectViewNasProfiles.disabled = !selectViewNasMenu.checked;
            selectViewServices.disabled= false;
            
        }
    }

    // Run the function when the page loads
    applyPrivileges();

    // Add event listeners for real-time updates
    selectGroupPrivilege.addEventListener('change', applyPrivileges);
    selectAdministrator.addEventListener('change', applyPrivileges);
    selectViewNasMenu.addEventListener('change', applyPrivileges);
    selectViewServices.addEventListener('change', applyPrivileges);
    
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

    selectViewServices.addEventListener('change', function(){
        selectViewDns.disabled = !selectViewServices.checked;
        selectViewBwm.disabled = !selectViewServices.checked;
    });
    selectViewDns.addEventListener('change',function(){
        selectFullDns.disabled = !selectViewDns.checked;
    });

    selectViewBwm.addEventListener('change',function(){
        selectFullBwm.disabled = !selectViewBwm.checked;
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
            const logidgroup = this.dataset.logidgroup;

            document.getElementById('varLogActionBy').value = logactionby;
            document.getElementById('varLogCategory').value = logcategory;
            document.getElementById('varLogIpAddress').value = logipaddress;
            document.getElementById('varLogStatus').value = logstatus;
            document.getElementById('varLogAgent').value = logagent;
            document.getElementById('varLogDetails').value = logdetails;
            document.getElementById('varLogCreatedAt').value = logcreatedat;
            document.getElementById('varLogIdGroup').value = logidgroup;
            
        });
    });
});
//END VIEW LOG

//START SEARCH HOSTNAME
// di file JS eksternal
$(document).ready(function () {
    const userGroupId = window.userGroupId; // ambil id_group user
    const baseUrl = window.APP_URL;         // base URL Laravel

    // Fungsi load hostname, selector adalah id selectnya
    function loadHostname(selector) {
        $(selector).html('<option value="">Loading...</option>');

        $.ajax({
            url: baseUrl + '/services/bwm/search-hostname/' + userGroupId,
            type: 'GET',
            success: function (data) {
                var options = '<option value="">--- Choose Hostname ---</option>';
                $.each(data, function (key, value) {
                    options += '<option value="' + value + '">' + value + '</option>';
                });
                $(selector).html(options);
            },
            error: function () {
                alert('Failed to get data.');
            }
        });
    }

    // Saat modal 1 dibuka, load hostname untuk select modal 1
    $('#ModalAddBwmBw').on('shown.bs.modal', function () {
        loadHostname('#id_search_hostname_bwmbw');
    });

    // Saat modal 2 dibuka, load hostname untuk select modal 2
    // $('#ModalAddBwmClient').on('shown.bs.modal', function () {
    //     loadHostname('#id_search_hostname_bwmclient');
    // });

    // Kalau mau load langsung ketika halaman ready:
    // loadHostname('#id_search_hostname_bwmBw');
    // loadHostname('#id_search_hostname_bwmClient');
});
//END SEARCH HOSTNAME

//START SEARCH INTERFACE
$(document).ready(function () {
    const baseUrl = window.APP_URL;         // base URL Laravel
    // load hostnames saat page ready
    $.ajax({
        url: baseUrl + '/services/bwm/get-hostname',
        type: 'GET',
        success: function (data) {
            var options = '<option value="">--- Choose Hostname ---</option>';
            $.each(data, function (index, value) {
                // sesuaikan dengan key JSON yang dikirim controller
                // misal controller kirim: [{hostname:"R1",group_id:1}, ...]
                options += '<option value="' + value.hostname + '">' + value.hostname + '</option>';
            });
            $('#hostname_select').html(options);
        },
        error: function () {
            alert('Gagal load hostname');
        }
    });

    // ketika hostname dipilih
    $('#hostname_select').on('change', function () {
        var hostname = $(this).val();
        var groupId = $('#id_groupid').val(); 

        // simpan group_id di hidden input agar ikut ke form submit
        $('#group_id_selected').val(groupId);

        $('#interface_select').html('<option value="">Loading...</option>');

        if (hostname && groupId) {
            $.ajax({
                url: baseUrl + '/services/bwm/get-interface/' + hostname + '/' + groupId,
                type: 'GET',
                success: function (data) {
                    var options = '<option value="">--- Choose Interface ---</option>';
                    $.each(data, function (index, val) {
                        options += '<option value="' + val + '">' + val + '</option>';
                    });
                    $('#interface_select').html(options);
                },
                error: function () {
                    $('#interface_select').html('<option value="">Gagal load interface</option>');
                }
            });
        } else {
            $('#interface_select').html('<option value="">--- Not Found ---</option>');
        }
    });
});
//END SEARCH INTERFACE


//START VIEW BOD
document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.bwm-bod');
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const hostname = this.dataset.hostname;
            const description = this.dataset.description;
            const interface = this.dataset.interface;
            const unit = this.dataset.unit;
            const inputpolicerold = this.dataset.inputpolicerold;
            const outputpolicerold = this.dataset.outputpolicerold;
            const bodidgroup = this.dataset.bodidgroup;
            const bodiduser = this.dataset.bodiduser

            document.getElementById('varBodRouter').value = hostname;
            document.getElementById('varBodDescription').value = description;
            document.getElementById('varBodInterface').value = interface;
            document.getElementById('varBodUnit').value = unit;
            document.getElementById('varBodUploadOld').value = inputpolicerold;
            document.getElementById('varBodDownloadOld').value = outputpolicerold;
            document.getElementById('varBodIdGroup').value = bodidgroup;
            document.getElementById('varBodIdUser').value = bodiduser;
            
            function loadPolicer(selector) {
                $(selector).html('<option value="">Loading...</option>');
                $.ajax({
                    url: baseUrl + '/services/bwm/search-policer/' + bodidgroup + '/' + hostname,
                    type: 'GET',
                    success: function(data) {
                        var options = '<option value="">--- Select Bandwidth ---</option>';
                        $.each(data, function(key, value) {
                            options += '<option value="' + value + '">' + value + '</option>';
                        });
                        $(selector).html(options);
                    },
                    error: function() {
                        alert(hostname);
                    }
                });
            }

            loadPolicer('#id_search_policer_upload'); // Upload BOD
            loadPolicer('#id_search_policer_download'); // Download 
        });
    });
});
//END VIEW BOD



//countdown domain
document.addEventListener('DOMContentLoaded', () => {
  const items = [];
  document.querySelectorAll('.countdown').forEach(span => {
    items.push({
      el: span,
      expiryDate: new Date(span.dataset.expiry.replace(' ', 'T'))
    });
  });

  function updateAll() {
    const now = new Date();
    items.forEach(item => {
      const diff = item.expiryDate - now;
      if (diff <= 0) {
        item.el.textContent = 'Expired';
        return;
      }

      const totalSeconds = Math.floor(diff / 1000);
      const days = Math.floor(totalSeconds / 86400);
      const hours = Math.floor((totalSeconds % 86400) / 3600);
      const minutes = Math.floor((totalSeconds % 3600) / 60);
      const seconds = totalSeconds % 60;

      const months = Math.floor(days / 30);
      const daysLeft = days % 30;

      let text = '';
      if (months > 0) text += `${months} Month${months > 1 ? 's' : ''} `;
      if (daysLeft > 0) text += `${daysLeft} Day${daysLeft > 1 ? 's' : ''} `;
      text += `${String(hours).padStart(2,'0')}:${String(minutes).padStart(2,'0')}:${String(seconds).padStart(2,'0')}`;
      item.el.textContent = text.trim();
    });
  }

  updateAll();
  setInterval(updateAll, 1000);
});






