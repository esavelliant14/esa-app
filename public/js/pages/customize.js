
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