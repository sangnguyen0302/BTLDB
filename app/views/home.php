
<?php 
session_start();
require_once("inc/head.php");
 ?>
<body>
    <div class="header">
        this is header
    </div>
    <?php
    if(isset($_SESSION['user_id'])){
        echo '<a href="bai1.php">Bài 1</a>';
        ?>
        <a href="../controllers/bai1/bai1script.php?logout=1" class="buttonn2">Log out</a>
        <?php
    }else{
        ?>
        <form action="../controllers/loginController.php" method= "post">
        <input type="submit" name="Login" value="Log in">
        <input type="submit" name="Regist" value="Sign up">
        </form>
        <?php
    }
        ?>
    <


    <?php require_once("inc/footer.php"); ?>
</body>
</html>