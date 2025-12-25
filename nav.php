<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top py-0 pe-5">
    <a href="index.php" class="navbar-brand ps-5 me-0">
        <h1 class="m-0 text-primary">VAULT</h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="/auction/index.php" class="nav-item nav-link">Home</a>
            <a href="/auction/about.php" class="nav-item nav-link">About</a>
            <a href="/auction/service.php" class="nav-item nav-link">Services</a>
            <a href="/auction/projects.php" class="nav-item nav-link">Upcoming Auctions</a>
            <a href="/auction/contact.php" class="nav-item nav-link">Contact</a>

            <?php if (!empty($_SESSION['user_id'])): ?>
                <a href="/auction/login.php" class="nav-item nav-link">Logout</a>
            <?php else: ?>
                <a href="/auction/login.php" class="nav-item nav-link">Login</a>
            <?php endif; ?>

            <?php if (!empty($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                <a href="/auction/admin/view_bids.php" class="nav-item nav-link">View Bids</a>
                <a href="/auction/admin/create_auction.php" class="nav-item nav-link">Create Auction</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
