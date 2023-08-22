<?php if(isset($_SESSION['msg'])){ ?>
    <b class="text-<?= $_SESSION['class'] ?>"><?= $_SESSION['msg']; ?></b>
<?php  unset($_SESSION['msg'],$_SESSION['class']); }?>