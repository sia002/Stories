<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-light" href="index.php">
            <img src="images/logo.png" class="img-fluid" style="height: 100px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle no-caret text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Bøger
                    </a>
                    <ul class="dropdown-menu bg-dark">
                        <li><a class="dropdown-item text-info" href="Fantasy.php">Fantasy</a></li>
                        <li><a class="dropdown-item text-info" href="krimi.php">Krimi</a></li>
                        <li><a class="dropdown-item text-info" href="skon.php">Skønlitteratur</a></li>
                        <li><a class="dropdown-item text-info" href="bio.php">Biografier</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle no-caret text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        E-bøger
                    </a>
                    <ul class="dropdown-menu bg-dark">
                        <li><a class="dropdown-item text-info" href="e_bio.php">Biografier</a></li>
                        <li><a class="dropdown-item text-info" href="e_skon.php">Skønlitteratur</a></li>
                    </ul>
                </li>
            </ul>

            <form class="d-flex" action="search.php" method="GET">
                <input class="form-control me-2" type="search" name="query" placeholder="Søg" aria-label="Search">
            </form>

            <ul class="navbar-nav d-flex justify-content-end">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user text-info"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end bg-dark">
                        <li><a class="dropdown-item text-info" href="#">Min profil</a></li>
                        <li><a class="dropdown-item text-info" href="#">Kontakt</a></li>
                        <li><a class="dropdown-item text-info" href="#">Om</a></li>
                        <li><a class="dropdown-item text-info opacity-25" href="#">Log ud <i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>