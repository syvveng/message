<?php
/**
 * Message Version0.1
 * ===============================
 * Author: weng
 * Date: 2017/2/23
 * Time: 20:26
 */

define("IN_TG",true);
define("SCRIPT","face");

require dirname(__FILE__)."/includes/common.inc.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>头像选择</title>
  <?php  require ROOT_PATH."includes/title.inc.php"; ?>
    <script type="text/javascript" src="js/select_face.js"></script>

</head>
<body>
    <div id="face">
        <h3>头像选择</h3>
        <dl>
            <dd>
                 <?php foreach(range(1,15) as $pic) {  ?>
                 <img src="images/face/<?php echo $pic; ?>.jpg" alt="头像<?php echo $pic; ?>" />
                 <?php } ?>
            </dd>
        </dl>
    </div>
</body>
</html>