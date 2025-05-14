<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content" class="">

    <!-- Topbar -->
    <?= view('manage/common/navbar') ?>
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid pb-4">

        <?= $this->renderSection("content"); ?>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Footer -->
<footer class="sticky-footer bg-white py-2 ">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2015-22</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->