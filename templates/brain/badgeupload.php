<?php include_once 'includes/header.php'; ?>
<title><?= $config['hotelName'] ?>: Badge Upload</title>
<div class="center">
  <?php include_once 'includes/alerts.php'; ?>
  <div style="width:600px;" class="columleft">
    <div class="box">
      <div class="title">Badge Upload</div>
      <div class="mainBox" style="float;left">
        <?= badgeUpload(); ?>
        <form action="" method="post" enctype="multipart/form-data">
          <b>Code</b>
          <input type="text" name="code" style="width:100%;margin:16px 0">
          <b>Name</b>
          <input type="text" name="name" style="width:100%;margin:16px 0">
          <b>Beschreibung</b>
          <input type="text" name="desc" style="width:100%;margin:16px 0">
          <b>Badge</b>
          <input type="file" name="badge" style="width:100%;margin:16px 0">
          <input type="submit" name="badgeUpload" value="Badge hochladen">
        </form>
      </div>
    </div>
  </div>
  <div style="width:370px;" class="columright">
    <div class="box">
      <div class="black title">Information</div>
      <div class="mainBox" style="float;left">
        Erstelle dein eigenes Badge und lade es auf <?= $config['hotelName'] ?> hoch.
        Nachdem unsere Staffs dein Badge geprüft und bestätigt haben, wirst du es erhalten.<br>
        <br><b>ACHTUNG!</b><br>
        <br>- Das Badge muss eine GIF Datei sein.
        <br>- Das Badge muss genau 40x40 Pixel gross sein.
        <br>- ...
        <br>- ...
      </div>
    </div>
  </div>
  <?php include_once 'includes/footer.php'; ?>
  </body>
</html>
