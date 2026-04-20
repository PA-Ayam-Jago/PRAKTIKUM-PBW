<?php
$id = isset($_GET['id']) ? $_GET['id'] : '';

echo "<script>
alert('Data dengan ID $id berhasil dihapus (dummy).');
window.location.href='wahana.php';
</script>";