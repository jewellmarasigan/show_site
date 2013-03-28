<nav>
    <ul> <!-- classes: icon-text, text, icon, input -->
        <li class="text" id="home">
            <a href="../admin"> 
                <span>CMS</span> 
            </a>
        </li>
        
        <li class="icon" id="course">
            <a href="courseinfo">
                <div class="icon"></div>
                <span>Course Info</span>
            </a>
        </li>
        
        <li class="icon" id="students">
            <a href="students"> 
                <div class="icon"></div>
                <span>Students</span>
            </a>
        </li>
        
        <li class="icon selected" id="admins">
            <a href="administrators"> 
                <div class="icon"></div>
                <span>Administrators</span>
            </a>
        </li>
        
        <li class="input" id="search">
            <a href="#4">
                <div class="icon"></div>
                <span>Search</span>
            </a>
            <input type="text" name="search" placeholder="Search">
        </li>

    </ul>
    
    <ul class="right">
        <li class="text">
            <a href="account">
                <span><?php echo $god_admin_name;?></span>
            </a>
        </li>
        
        <li id="power" class="icon">
            <a href="logout">
                <div class="icon"></div>
                <span>Log Off</span>
            </a>
        </li>
    </ul>
</nav>