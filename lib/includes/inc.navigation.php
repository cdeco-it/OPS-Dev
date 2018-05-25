        <!-- NAVIGATIONAL -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light" id="opsNavagationBar">
            <a class="navbar-brand" href="#">CDE Operations</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="opsNavagationBarDropDown">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="/">Home </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"  id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Admin
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Settings</a>
                            <a class="dropdown-item" href="/modules/employees/">Employees/Users</a>
                            <a class="dropdown-item" href="/modules/addressbook/">Address Book</a>
                            <a class="dropdown-item" href="#">Training</a>
                            <a class="dropdown-item" href="#">Client Accounts</a>
                            <a class="dropdown-item" href="#">IT</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Resources
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Standards</a>
                            <a class="dropdown-item" href="#">Templates</a>
                            <a class="dropdown-item" href="#">Forms</a>
                            <a class="dropdown-item" href="#">Logos</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Logging
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Letters</a>
                            <a class="dropdown-item" href="#">Transmittals</a>
                            <a class="dropdown-item" href="#">P.O.</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Projects
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/modules/work/">Listing</a>
                            <a class="dropdown-item" href="/modules/work/dashboard.php">Dashboard Temp</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="/modules/work/admin/">Administration</a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="align-self-end">
                <ul class="navbar-nav mr-auto">
                    <li class="navbar-right nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $user; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

