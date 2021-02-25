<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <?php
                if (Helper::getSessionKey('user') === null ){
            ?>
            <li class="nav-item active">
                <a class="nav-link" href="/register">Register <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/login">Log in</a>
            </li>
            <?php }else{ ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="/task/all">Tasks <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href='/user/edit'>Update Profile <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href='/user/logout'>Logout <span class="sr-only">(current)</span></a>
                    </li>
                <?php }?>
            </li>
        </ul>
    </div>
</nav>