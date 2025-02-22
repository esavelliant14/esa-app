<!-- Tombol yang akan memicu pengecekan -->
<button id="checkPrivilegeBtn" data-privilege="{{ auth()->user()->id_privilege }}">Cek Privilege</button>

<!-- Sertakan jQuery dan SweetAlert2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
       $('#checkPrivilegeBtn').on('click', function() {
        // Mendapatkan nilai id_privilege dari atribut data-privilege
        var userPrivilege = $(this).data('privilege');
        
        // Mengecek nilai id_privilege
        if (userPrivilege == 1) {
            Swal.fire({
                icon: 'success',
                title: 'Halo Admin!',
                text: 'Anda memiliki akses admin.'
            });
        } else {
            Swal.fire({
                icon: 'info',
                title: 'Halo User!',
                text: 'Anda adalah user biasa.'
            });
        }
    });
</script>