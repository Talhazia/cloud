
<html>
<body>
  <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
  <script type="text/javascript" src="js/validation.min.js"></script>
  <link href="css/style.css" rel="stylesheet" type="text/css" media="screen">
  <br>
  <hr>

  <form action="" method="POST" name="LangChangeForm" class="form-repair">
    <h2 class"form-signin-heading">Google Translate API</h2> </br>


    <p2>Enter text and select a language to translate </p2> <hr>
    Text to translate: <input type="text" name="toTranslate" value="" ><br>
    Select a language: <select class="" name="language">
      <?php
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_URL, 'https://www.googleapis.com/language/translate/v2/languages?key=AIzaSyAZ_bBgBN0Zh_6Tbw-xTM0DYomduljhC4g');
      $result = curl_exec($ch);
      curl_close($ch);

      $obj = json_decode($result);
      foreach($obj->data->languages as $lang) {
        ?>
      <option><?php echo $lang->language; ?></option>
  <?php  } ?>
    </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="submit" value="Translate" class="btn btn-default" id="btn-submit1"><br><br>
      <input type="button" value="Go Back" class="btn btn-default" id="btn-submit1" onClick="document.location.href='repairs.php'" />
  </form>
</body>
<hr>
</html>


<html><head>
<style type="text/css">
.mycss
{
font-weight:normal;color:#000000;letter-spacing:1pt;word-spacing:2pt;font-size:28px;text-align:center;font-family:courier new, courier, monospace;line-height:1;
}
</style>
</head>
<body>
<div class="mycss">


  <?php
    if(isset($_POST['toTranslate']) && isset($_POST['language']))
    {
        $url = 'https://www.googleapis.com/language/translate/v2/?key=AIzaSyAZ_bBgBN0Zh_6Tbw-xTM0DYomduljhC4g&q=' . str_replace(" ", "+", $_POST['toTranslate']) . '&target=' . $_POST['language'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);

        $obj = json_decode($result);
        print_r($obj->data->translations[0]->translatedText);
    }
    else{
      print_r("Your text will appear here");
    }

  ?>

</div>
</body>
</html>
