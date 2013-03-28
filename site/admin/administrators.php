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
        
        <div class="page center">
        
        	<section id="add_administrator" class="left-small">
				<input type="text" id="admin_name" placeholder="Name">
				<input type="text" id="admin_email" placeholder="Email">
				<input type="password" id="admin_password" placeholder="Password">
				<select id="admin_permissions">
	                <option value="1">1 (Top level administrator)</option>
	                <option value="2">2 (Average backend user)</option>	
	                <option value="3">3 (Average joe)</option>
	            </select>
				<input class="button confirm" type="button" onClick="addAdministrator();" value="Add administrator"/>
            	
                <div id="messageBox"></div>
			</section>
        
        	<section id="edit_administrator" class="left-small" style="display:none; position:absolute; margin-top:-310px;"></section>
            
            <section class="right-big">
                    <?php
            
					$getAdministrators = mysql_query("SELECT * FROM administrators ORDER BY admin_name ASC");
					
					if(mysql_num_rows($getAdministrators)!=0)
					{
						echo "<ul>";
						while($row = mysql_fetch_assoc($getAdministrators))
						{
							$admin_id = $row['admin_id'];
							$admin_name = $row['admin_name'];
							$admin_email = $row['admin_email'];
							$admin_password = $row['admin_password'];
							$admin_permissions = $row['admin_permissions'];
							$admin_loginkey = $row['admin_loginkey'];
							
							?>
                            <li id="administrator<?php echo $admin_id;?>">
                                <img src="images/icons/dark/user.png">
                                <h4><?php echo $admin_name;?></h4>
                                <h5><?php echo $admin_email;?></h5>
                                <span class="level level-<?php echo $admin_permissions;?>"></span> <!--Echo (or is it print?) the permission level number after the class level- -->
                                <span class="edit">
									<?php
                                    if($admin_id != $godid)
                                    {
                                        ?>
                                        <a href="javascript:editAdministrator(<?php echo $admin_id;?>)" class="button">Edit</a>
                                        <a href="javascript:deleteAdministrator(<?php echo $admin_id;?>);" class="button">Delete</a>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <a href="javascript:editAdministrator(<?php echo $admin_id;?>)" class="button">Edit</a>
                                        <?php
                                    }
                                    ?>
                                </span>
                            </li>
                            <?php
						}
						echo "</ul>";
					}
					
					?>
            </section>
		</div>
	</div>

</body>
</html>