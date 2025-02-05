<?php 
session_start();
session_destroy(); 
echo "<script>
localStorage.removeItem('user');
window.location.replace('auth/login.php');
</script>";
