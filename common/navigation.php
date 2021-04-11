<nav>
    <?php if(isset($_SESSION['username'])): ?>
    <span class="greeting-message"><a href="./admin.php">Welcome, <?php echo $_SESSION['username'] ?></a></span>
    <a href="./logout.php" class="action-btn">Logout</a>
    <?php else: ?>
    <a href="./offer.php" class="action-btn">Register Offer</a>
    <a href="./login.php" class="action-btn">Login</a>
    <?php endif; ?>
</nav>