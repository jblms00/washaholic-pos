<?php
if (strpos($_SERVER['REQUEST_URI'], '/user/') !== false || strpos($_SERVER['REQUEST_URI'], '/admin/') !== false) {
    $linkTg = "../";
} else {
    $linkTg = "";
}
?>
<a href="#" class="btn-back-to-top animation-right" id="backToTop">
    <img src="<?php echo $linkTg; ?>assets/images/totop.png" width="50" height="80" alt="img">
</a>