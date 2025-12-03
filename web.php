<?php 
    $url = $_GET['url']??'';
    $goto = '';

    if (preg_match("/^s\/(.+)$/", $url)) {
        $goto = str_replace('s/','',$url);
        $goto = strtolower($goto);
        $goto = file_exists('app/pages/s/'.$goto.'.php')?'app/pages/s/'.$goto.'.php':'app/pages/s/'.$goto.'.html';

    }elseif (preg_match("/^(home|messages|Following|search|foryou|explore|about|upload|profile|ads|proshop|findnearyou)$/i", $url)) {
        $goto = str_replace('s/','',$url);
        $goto = strtolower($goto);
        $goto = file_exists('app/pages/'.$goto.'.php')?'app/pages/'.$goto.'.php':'app/system/errors/404.html';
    }elseif(preg_match("/^logout[\/]?$/", $url)){
        header ('location:app/auth/logout.php');
    }elseif(preg_match("/^@support\/(.+){2,}$/", $url)){
        $goto = 'app/pages/other/'.str_replace('@support/', '', $url).'.php';
    }elseif(preg_match("/^(\@)?users$/", $url)){
        $goto = 'app/pages/other/users.php';
    }elseif(preg_match("/^(@)?cog\/(.+)$/", $url)){
        include_once 'app/system/api/'.str_replace('@cog/', '', $url).'.php';
        exit;
    }elseif(preg_match("/^@auth\/(.+)$/", $url)){
        include_once 'app/auth/'.str_replace('@auth/', '', $url).'.php';
        exit;
    }elseif (preg_match("/^logout[\/]?$/", $url)){
    switch ($url) {
        case 's/Dashboard':
            $goto = 'app/pages/s/dashboard.php';
            break;
        case '':
            $goto = './';
            break;
        case 'api.php':
            $goto = './';
            break;
        case 'auth/create-account':
            $goto = 'app/auth/create-account.php';
            break;
        case 'auth/forgot-password':
            $goto = 'app/auth/forgot-password.php';
            break;
        case 'auth/reset-password':
            $goto = 'app/auth/reset-password.php';
            break;
        case 'auth/send-email':
            $goto = 'app/auth/send-email.php';
            break;
        default:
            $goto = 'app/system/errors/404.html';
            break;
    }
}
include_once 'app/pages/sections/h.php';
?>
    <title>  <?= strtoupper(basename($_SERVER['REQUEST_URI'])) ?> . <?= $goto ?></title>
<script src="https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js"></script>
<!-- <script src="https://unpkg.com/axios@1.6.7/dist/axios.min.js"></script> -->
  <!-- MAIN CONTENT -->
  <main class="flex-1 flex  md:items-start md:justify-center p-0 md:p-4"  id="content" >
        <?php
    if (file_exists($goto)) {
        include_once $goto;
    }else{
        include_once 'app/system/errors/404.html';
    }
    ?>
  </main>
<script>
 async function loadPage(url){
      try {
          const response = await axios.get(`app/pages/${url}.php`);
          // alert(response.data);
          $("#content").html(response.data);
          window.history.pushState(null,null,url);
      } catch (error) {
        showMessage(`Error:${error}`);
      }
  }
  loadPage(<?= basename($_SERVER['REQUEST_URI']) ?>);
</script>
<?php include "app/pages/sections/f.php";?>