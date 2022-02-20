<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Fauzi</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link <?= (!empty($home_active)) ? $home_active : ''; ?>" aria-current="page" href="<?= base_url('/'); ?>">Home</a>
                <a class="nav-link <?= (!empty($about_active)) ? $about_active : ''; ?>" href="<?= base_url('/pages/about'); ?>">About</a>
                <a class="nav-link <?= (!empty($contact_active)) ? $contact_active : ''; ?>" href="<?= base_url('/pages/contact'); ?>">Contact</a>
                <a class="nav-link <?= (!empty($comic_active)) ? $comic_active : ''; ?>" href="<?= base_url('/comics'); ?>">Comics</a>
                <a class="nav-link <?= (!empty($people_active)) ? $people_active : ''; ?>" href="<?= base_url('/people'); ?>">People</a>
                <a class="nav-link" href="<?= base_url('/logout'); ?>">Log out</a>
            </div>
        </div>
    </div>
</nav>