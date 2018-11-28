<footer class="page-footer bg-dark text-light pt-4 mt-4">
    <div class="container text-center text-md-left">
        <div class="row">
            <div class="col-md-4">
                <h5 class="text-uppercase mb-4 mt-3 font-weight-bold">About us</h5>
                <p>This is a user-friendly movie browsing platform, depending on a private database that's being updated
                    by the mods themselves, no extra apis or anything involved.</p>
            </div>

            <hr class="clearfix w-100 d-md-none">

            <div class="col-md-3 mx-auto">
                <h5 class="text-uppercase mb-4 mt-3 font-weight-bold">Facebook</h5>
                <ul class="list-unstyled">
                    <li>
                        <a target="_blank" href="https://www.facebook.com/hiep.lehoang.33">Lê Hoàng Hiệp</a>
                    </li>
                    <li>
                        <a target="_blank" href="https://www.facebook.com/nguyengiaphuc">Nguyễn Gia Phúc</a>
                    </li>
                    <li>
                        <a target="_blank" href="https://www.facebook.com/profile.php?id=100003612609687">Nguyễn Hiển
                            Quang</a>
                    </li>
                    <li>
                        <a target="_blank" href="https://www.facebook.com/huuloc.trinh.5">Trịnh Hữu Lộc</a>
                    </li>
                </ul>
            </div>

            <hr class="clearfix w-100 d-md-none">

            <div class="col-md-5 mx-auto">
                <h5 class="text-uppercase mb-4 mt-3 font-weight-bold">Contact</h5>
                <ul class="list-unstyled">
                    <li>
                        <a target="_blank">Address: 268 Lý Thường Kiệt, Phường 14, Quận 10, Hồ Chí Minh</a>
                    </li>
                    <li>
                        <a target="_blank">Phone: 0909 444 524</a>
                    </li>
                    <li>
                        <a target="_blank">Email: dhbachkhoa@hcmut.edu.vn</a>
                    </li>
                </ul>
            </div>


        </div>
    </div>


    <div class="text-center">

        <button id="backToTop" class="my-2 btn btn-dark"><i class="fas fa-lg fa-arrow-up"></i></button>
    </div>

    <div class="elegant-color-dark text-light footer-copyright py-3 text-center">
        &copy; <?php echo (date('Y') == '2018') ? date('Y') : "2018 - " . date('Y'); ?> Copyright © 2018-2018 The Movie
        Library
    </div>

</footer>

<script src="\movies-library\scripts\jquery-3.3.1.min.js"></script>
<script src="\movies-library\scripts\bootstrap.min.js"></script>
<script type="text/javascript" src="\movies-library\scripts\main.js"></script>
<?php if (intval($_SESSION['loginFailed']) == true): ?>
    <script>
        $('#loginFailed').modal('show');
    </script>
    <?php $_SESSION['loginFailed'] = false; ?>
<?php endif; ?>
</body>
</html>