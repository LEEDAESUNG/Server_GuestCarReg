
<!-- Sidebar -->
<div class="bg-light border-right" id="sidebar-wrapper">
  <!-- <div class="sidebar-heading">  </div> -->
  <div class="list-group list-group-flush">


    <?php
//        session_start();
        if( !isset($_SESSION['ss_dong']) || !isset($_SESSION['ss_ho']) ) {
            echo "<p>로그인을 해 주세요. <a href=\"login.php\">[로그인]</a></p>";
            echo("<script>location.href='login.php';</script>");
            exit();
        }
    ?>


    <a href="/guestcarreg.php" class="list-group-item list-group-item-action bg-light"><img src="/images/icons/bi.jpg" align = 'center' width = 200>
        <center style='color:#0092E0; font-weight:bold; font-size:1.0em;'>
        <?php
            echo $_SESSION['ss_dong']."동 ".$_SESSION['ss_ho']."호";
        ?>
        </center>
    </a>

    <a href="/guestcarreg.php" class="list-group-item list-group-item-action bg-light"><span class="ui-icon ui-icon-plus"></span>&nbsp;&nbsp;&nbsp;방문예약등록</a>
    <a href="/index.php" class="list-group-item list-group-item-action bg-light"><span class="ui-icon ui-icon-note"></span>&nbsp;&nbsp;&nbsp;방문예약내역</a>
    <a href="/parkingTime.php" class="list-group-item list-group-item-action bg-light"><span class="ui-icon ui-icon-note"></span>&nbsp;&nbsp;&nbsp;출차차량내역</a>
    <a href="/changepw.php" class="list-group-item list-group-item-action bg-light"><span class="ui-icon ui-icon-locked"></span>&nbsp;&nbsp;&nbsp;비밀번호변경</a>
    <a href="/logout.php" class="list-group-item list-group-item-action bg-light"><span class="ui-icon ui-icon-extlink"></span>&nbsp;&nbsp;&nbsp;로그아웃</a>
  </div>
</div>

<!-- /#sidebar-wrapper -->
