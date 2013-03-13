<nav>
    <ul> <!-- classes: icon-text, text, icon, input -->
        <li class="text" id="home">
            <a href="../admin"> 
                <span>CMS</span> 
            </a>
        </li>
        
        <li class="icon" id="user">
            <a href="administrators"> 
                <div class="icon"></div>
                <span>People</span>
            </a>
        </li>
        
        <li class="icon" id="settings">
            <a href="#3">
                <div class="icon"></div>
                <span>Settings</span>
            </a>
        </li>
        
        <li class="input" id="search">
            <a href="#4">
                <div class="icon"></div>
                <span>Search</span>
                <input type="text" name="search" placeholder="Search">
            </a>
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