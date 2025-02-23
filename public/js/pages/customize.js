
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
    // Ambil elemen select privilege dan administrator
    const priviledgeSelect = document.getElementById('id_group_priviledge');
    const createGroup = document.getElementById('filter_create_group');
    const deleteGroup = document.getElementById('filter_delete_group');

    // Fungsi untuk mengatur status enable/disable administrator select
    priviledgeSelect.addEventListener('change', function() {
        if (this.value === "1") {
            createGroup.disabled = false;  // Enable jika admin dipilih
            deleteGroup.disabled = false;  // Enable jika admin dipilih
        } else {
            createGroup.disabled = true;   // Disable jika user dipilih
            deleteGroup.disabled = true;  // Enable jika admin dipilih
        }
    });
    
    // Set default (awal) keadaan disabled
    if (priviledgeSelect.value !== '1') {
        createGroup.disabled = true;
        deleteGroup.disabled = true;  
    }
});
