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
?>
<html>
<body>
  <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
  <script type="text/javascript" src="js/validation.min.js"></script>
  <link href="css/style.css" rel="stylesheet" type="text/css" media="screen">
  <br>
  <hr>
  <form action="" method="POST" name="LangChangeForm">
    Text to translate: <input type="text" name="toTranslate" value=""><br>
    <select class="" name="language">
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
    </select>
    <input type="submit" value="Submit form">
  </form>
</body>
</html>
