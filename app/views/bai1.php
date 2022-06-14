<?php 
session_start();
// unset($_SESSION['view-db']);
require_once("inc/head.php");
require_once("../DB.php");
if(!isset($_SESSION['view-db'])){
        $_SESSION['view-db']="view_db";
}
///// Đổi lại đoạn kết nối sql server!!
$con = mysqli_connect("localhost","root","","driver_service");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>
<title>Bài 1</title>
</head>
<body>
<?php
    if(isset($_SESSION['user_id'])){
    ?>
        <!-- NÚT -->
    
    <form action="../controllers/bai1/bai1script.php" method="get">
        <input type="submit" name="view-db" value="View account table" class="buttonn"/>
    </form>
    <form action="../controllers/bai1/bai1script.php" method="get" >
        <input type="submit" name="add-record" value="Add new account" class="buttonn"/>
    </form>
    <!-- // Nút xem account có uername -->
    <form action="" method="get">
        <input type="submit" name="view-user-submit" value="View account have username" class="buttonn"/>
        <input type="text" name="view-user" placeholder="Input user name" class="form" required />
        </div>
    </form>

    <?php
    // Xử lý Xem account có username
        if(isset($_GET['view-user-submit'])){
            $un =$_GET['view-username'];
            /*
            $sql ="EXEC VIEW_ACCOUNT_BY_username @username = '5763894824_EE@test.com'";
            $result = mysql_query($con, $sql);
            */
            if(!mysqli_num_rows($result)>0){
                echo "Not existed";
            }else{
                while($row = $result->fetch_assoc()){
                ?>
                <table>
                    </td></tr>
                    <tr>
                        <th>ID</th>
                        <th>Atype</th>
                        <th>User name</th>
                        <th>Password</th>
                        <th>SSN</th>
                    </tr>
                <?php
            // output data of each row
                echo "<tr><td>"; echo "</td><td>" . $row["ID"]. "</td><td>" . $row["ATYPE"] . "</td><td>"
                . $row["UserName"]. "</td>"."<td>" . $row["PASS"]. "</td><td>" . $row["SSN"]. "</td>" ?>
                </tr>
                
                <?php      
                }
                echo "</table>";

        }
    }
    ?>

    <!-- Thêm record -->
    <!--nút check ssn-->
    <?php
        if(isset($_GET['add-record'])&&$_GET['add-record']==1){
    ?>  <form action="../controllers/bai1/bai1script.php" method="get" class="login" >
        Are you have SSN?<br>
        <input type="text" name="check-ssn" placeholder="Input SSN to check" required/>
        <input type="submit" name="check-ssn-submit" value="Check"/><br>
        <a href="bai1.php?insert-person=1"?>Sign up SSN </a>
        </form>
    <?php 
        }else if(isset($_GET['add-record'])){
            ?>
            <div class="add_new_record">
                <h2>Add new account</h2>
                <form method="get" action="../controllers/bai1/bai1script.php" class="form">
                <input type="hidden"  name="add-id" value=<?php echo $_GET['add-record']?> /><br>
                Atype(vị trí):</label><br>
                <input type="text"  name="add-atype" value="" placeholder="Input role"/><br>
                User name: <br>
                <input type="text"  name="add-uname" value=""/><br>
                Password:  <br>
                <input type="password"  name="add-pass" value=""/><br>
                SSN: <br>
                <input type="text"  name="add-ssn" value=""/><br>
                <button type="submit" name="add_confirm">ADD</button>
                </form>
                <br>        
            </div>
            <?php
        }
        //form insert person
        if(isset($_GET['insert-person'])){
            ?>
            <div class="login2">
            <h2>Add new person</h2>
                <form method="get" action="../controllers/bai1/bai1script.php" class="form">
                SSN: <br>
                <input type="text" name="add-ps-ssn" value="" placeholder="In put your SSN" required/><br>
                First name: <br>
                <input type="text" name="add-ps-fname" value="" placeholder="Input your first name" required/><br>
                Last name: <br>
                <input type="text" name="add-ps-lname" value="" placeholder="Input your last name" required/><br>
                Gender: <br>
                <input type="text"  name="add-gender" value="" placeholder="F or M" required/><br>
            
                <button type="submit" name="add_person_confirm">ADD</button>
            </div>
            <?php
        }
        // Chỉnh sửa record
        if(isset($_GET['edit-record'])){
            $id = $_GET['edit-record'];
            $sql = "SELECT * FROM account WHERE ID=$id";
            $result = mysqli_query($con, $sql);
            $value = $result->fetch_assoc(); 
            ?>
            <div class="add_new_record">
                <h2>Edit record </h2>
                <form method="get" action="../controllers/bai1/bai1script.php" class="form">
                <input type="hidden"  name="old-id" value="<?=$id?>" />
                ID: 
                <?php echo $value['ID']?><br>
                Atype(vị trí):<?php echo $value['ATYPE']?> <br>
                User name: <br>
                <input type="text"  name="change-uname" value="<?=$value['UserName']?>"/><br>
                New Password: <br>
                <input type="password"  name="change-pass" value="<?=$value['PASS']?>"/><br>
                New SSN: <br>
                <input type="text"  name="change-ssn" value="<?=$value['SSN']?>"/><br>
                <button type="submit" name="change_confirm">Change</button>
                </form>
                <br>        
            </div>
            <?php
        }
    ?>
    <div class="<?php echo $_SESSION['view-db'];?>">
    <table>
    </td></tr>

    <tr>
        <th>N/O</th>
        <th>ID</th>
        <th>Atype</th>
        <th>User name</th>
        <th>Password</th>
        <th>SSN</th>
        <th>Action</th>
    </tr>
    <?php
        $index =0;
        $sql = "SELECT * FROM ACCOUNT";
        $result = $con->query($sql) ;
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
            echo "<tr><td>"; echo $index; echo "</td><td>" . $row["ID"]. "</td><td>" . $row["ATYPE"] . "</td><td>"
            . $row["UserName"]. "</td>"."<td>" . $row["PASS"]. "</td><td>" . $row["SSN"]. "</td>" ?>
            <td>
                
            <a href="../controllers/bai1/bai1script.php?edit_id=<?= $row["ID"]; ?>" class="buttonn2">Edit</a>
            <a href="../controllers/bai1/bai1script.php?delete_id=<?= $row["ID"]; ?>" class="buttonn2">Delete</a></td></tr>
            
        <?php
            $index+=1;
            }
            
            echo "</table>";
            } else { echo "0 results"; }
            $con->close();
    ?>
    </div>
    <form action="" method="get">
    Display all account have service:
				<select name="service" required>
					<option value="NM">NORMAL</option>
					<option value="DIS">DISCOUNT</option>
					<option value="EXPRESS">EXPRESS</option>
				</select>
                <input type="submit" value="view" name="view_service"/>
    </form>
   </div>
   <?php
   //b xem danh sách service --------------------------------------------------->--------------------------------------------------
    if(isset($_GET['view_service'])){
    $service = $_GET['service'];
    $sql = "";
    if($service=="NM"){
        $sql ="...";
    }else if($service=="DIS"){
        $sql ="...";
    }else{
        $sql = "...";
    }
    $result=$con->query($sql);
    if(mysqli_num_rows($result)>0){
        while($row = $result->fetch_assoc()){
            ?>
            <table>
                </td></tr>
                <tr>
                    <th>ID</th>
                    <th>Atype</th>
                    <th>User name</th>
                    <th>Password</th>
                    <th>SSN</th>
                </tr>
            <?php
        // output data of each row
            echo "<tr><td>"; echo "</td><td>" . $row["ID"]. "</td><td>" . $row["ATYPE"] . "</td><td>"
            . $row["UserName"]. "</td>"."<td>" . $row["PASS"]. "</td><td>" . $row["SSN"]. "</td>" ?>
            </tr>
            
            <?php      
            }
            echo "</table>";
    }else{
        echo "None account have this ".$service." service";
    }
}
    ?>
    <div>
    <form action="" method="get" >
    Display all account have service:
				<select name="service" required>
					<option value="NM">NORMAL</option>
					<option value="DIS">DISCOUNT</option>
					<option value="EXPRESS">EXPRESS</option>
				</select>
                <input type="text" name="num_phone" placeholder="Input number of phone" required/>
                <input type="submit" value="view" name="view_service"/>
            
    </form>
   </div>
   <?php
    // xem danh sách service có số số điện thoại--------------------------------------------------->---------------------------------
    if(isset($_GET['view_service'])){
        $service = $_GET['service']; //tên dịch vụ  
        $num_phone=$_GET['num_phone'];  // số số điện thoại
        $sql = "";
        if($service=="NM"){
            $sql ="...";
        }else if($service=="DIS"){
            $sql ="...";
        }else{
            $sql = "...";
        }
        $result=$con->query($sql);
        if(mysqli_num_rows($result)>0){
            while($row = $result->fetch_assoc()){
                ?>
                <table>
                    </td></tr>
                    <tr>
                        <th>ID</th>
                        <th>Atype</th>
                        <th>User name</th>
                        <th>Password</th>
                        <th>SSN</th>
                    </tr>
                <?php
            // output data of each row
                echo "<tr><td>"; echo "</td><td>" . $row["ID"]. "</td><td>" . $row["ATYPE"] . "</td><td>"
                . $row["UserName"]. "</td>"."<td>" . $row["PASS"]. "</td><td>" . $row["SSN"]. "</td>" ?>
                </tr>
                <?php      
                }
                echo "</table>";
        }else{
            echo "None account have this ".$service." service";
        }
    }
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
    
</body>
</html>