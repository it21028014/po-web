<!-- alert.php -->
<?php if (isset($_SESSION['error'])): ?>
    <div id="alert" class="fixed top-0 z-50 px-4 py-2 mt-4 text-white transition-opacity duration-500 transform -translate-x-1/2 bg-red-500 rounded-md shadow-lg opacity-0 left-1/2">
        <?php echo $_SESSION['error']; ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>