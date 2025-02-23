
//UNTUK COMBOBOX DI MENU

$(document).ready(function () {
    $('#id_group').change(function () {
        var id = $(this).val();
        $('#id_privilege').html('<option value="">Loading...</option>');

        if (id !== '') {
            $.ajax({
                url: '/esa-app/privilege/combo-privilege/' + id,
                type: 'GET',
                success: function (data) {
                    var options = '<option value="">-- Choose Privilege --</option>';
                    $.each(data, function (key, value) {
                        options += '<option value="' + key + '">' + value + '</option>';
                    });
                    $('#id_privilege').html(options);
                },
                error: function () {
                    alert('Gagal mengambil data.');
                }
            });
        } else {
            $('#id_privilege').html('<option value="">-- Choose Privilege --</option>');
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
    });
    selectViewPrivilege.addEventListener('change', function(){
        selectCreatePrivilege.disabled = !selectViewPrivilege.checked;
        selectDeletePrivilege.disabled = !selectViewPrivilege.checked;
    });
});
