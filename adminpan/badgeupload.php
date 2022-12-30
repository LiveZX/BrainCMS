<?php
    include_once "includes/head.php";
    include_once "includes/header.php";
    include_once "includes/navi.php";

    admin::CheckRank(3);
?>
<aside class="right-side">
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <section class="panel">
          <header class="panel-heading">Badge Upload</header>
          <div class="panel-body">
            <?= Admin::badgeApprove(); ?>
            <?= Admin::badgeDeny(); ?>
            <table class="table table-striped table-bordered table-condensed">
              <tbody>
                <tr>
                  <td>
                    <b>Id</b>
                  </td>
                  <td>
                    <b>Badge</b>
                  </td>
                  <td>
                    <b>Code</b>
                  </td>
                  <td>
                    <b>Name</b>
                  </td>
                  <td>
                    <b>Description</b>
                  </td>
                  <td>
                    <b>Aktion</b>
                  </td>
                </tr>
                <?php foreach (Admin::getBadges() as $badge): ?>
                  <tr>
                    <td><?= $badge['id']; ?></td>
                    <td><img src="<?= $config['badgeURL']; ?><?= $badge['code']; ?>.gif"></td>
                    <td><?= $badge['code']; ?></td>
                    <td><?= $badge['name']; ?></td>
                    <td><?= $badge['desc']; ?></td>
                    <td>
                      <form action="" method="post">
                        <input type="hidden" name="userId" value="<?= $badge['user_id']; ?>'">
                        <input type="hidden" name="badgeId" value="<?= $badge['id']; ?>">
                        <input type="hidden" name="code" value="<?= $badge['code']; ?>">
                        <input type="submit" name="badgeApprove" value="Approve" class="btn btn-success">
                        <input type="submit" name="badgeDeny" value="Deny" class="btn btn-danger">
                      </form>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

<?php
    include_once "includes/footer.php";
    include_once "includes/script.php";
?>
