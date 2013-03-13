<?php
/* ESSENTIAL BLOCK START */

/*
	Login requirement is boolean true or false
	Permissions are:
		1 = Top level administrator
		2 = Average backend user
		3 = Average joe
*/

$loginReq = 1;
$permissionsReq = 1;
include("includes/head.php");

/* ESSENTIAL BLOCK END */

?>
<body>
    <div class="container">
        <?php include("includes/design/header.php");?>
        
        <div class="page">

            <h2>Edit administrator</h2>
            
            <?php
            
			$getid = $_GET['id'];
            $getAdministrators = mysql_query("SELECT * FROM administrators WHERE admin_id = $getid");
            
            if(mysql_num_rows($getAdministrators)!=0)
            {
                while($row = mysql_fetch_assoc($getAdministrators))
                {
                    $admin_id = $row['admin_id'];
                    $admin_name = $row['admin_name'];
                    $admin_email = $row['admin_email'];
                    $admin_password = $row['admin_password'];
                    $admin_permissions = $row['admin_permissions'];
                    $admin_loginkey = $row['admin_loginkey'];
                    
                    ?>
                    <label for="admin_name">Name</label><br>
                    <input type="text" id="admin_name" value="<?php echo $admin_name;?>"/><br>
                    <label for="admin_email">Email</label><br>
                    <input type="text" id="admin_email" value="<?php echo $admin_email;?>"/><br>
                    <label for="admin_password">Password (not displayed for security)</label><br>
                    <input type="password" id="admin_password"/><br>
                    <label for="admin_permissions">Permissions</label><br>
                    <select id="admin_permissions">
                        <option value="1" <?php if($admin_permissions==1){ echo "selected"; }?>>1 (Top level administrator)</option>
                        <option value="2" <?php if($admin_permissions==2){ echo "selected"; }?>>2 (Average backend user)</option>	
                        <option value="3" <?php if($admin_permissions==3){ echo "selected"; }?>>3 (Average joe)</option>
                    </select>
                    <br><br>
                    <input type="button" onClick="editAdministrator();" value="Edit administrator"/>
                    
                    <div id="messageBox"></div>
                    <?php
                }
            }
            
            ?>
		</div>
	</div>

</body>
</html>