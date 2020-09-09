<nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="https://bulma.io">
                <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
            </a>

            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item">
                หน้าแรก
                </a>

                <a class="navbar-item">
                Documentation
                </a>
            </div>

            <div class="navbar-end">
                <?php
                if(!isset($_SESSION['user_id']))
                {
                    $facebook_permissions = ['email'];

                    $facebook_login_url = $facebook_helper->getLoginUrl('https://profile.pwisetthon.com/checklogin.php',$facebook_permissions);

                ?>
                <div class="navbar-item">
                    <div class="buttons">
                        
                        <a class="button is-link" href="<?php echo $facebook_login_url; ?>">
                            <strong>Login With Facebook</strong>
                        </a>
                        <a class="button is-info" href="https://discordapp.com/api/oauth2/authorize?client_id=691610557156950030&redirect_uri=https%3A%2F%2Fprofile.pwisetthon.com%2Fchecklogin.php&response_type=code&scope=identify%20email">
                        Login With Discord
                        </a>
                    </div>
                </div>
                <?php
                }else{
                ?>
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                    More
                    </a>

                    <div class="navbar-dropdown is-right">
                        <a class="navbar-item">
                        About
                        </a>
                        <a class="navbar-item">
                        Jobs
                        </a>
                        <a class="navbar-item">
                        Contact
                        </a>
                        <hr class="navbar-divider">
                        <a class="navbar-item" href="logout.php">
                        ออกจากระบบ <?php echo $_SESSION['user_id']; ?>
                        </a>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </nav>