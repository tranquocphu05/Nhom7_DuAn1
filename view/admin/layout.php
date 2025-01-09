<!-- view/admin/layout.php -->
<?php include 'header.php'; ?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-4">
            <!-- Navbar -->
            <?php include 'nav.php'; ?>

            <!-- Content for specific page -->
            <?php include $content; ?>
        </main>
    </div>
</div>

<?php include 'footer.php'; ?>
