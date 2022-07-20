<footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        © 2018 - <script>document.write(new Date().getFullYear())</script> Lexa <span class="d-none d-sm-inline-block"> - Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand.</span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- end main content-->

</div>
<!-- JAVASCRIPT -->
<script src="../../../assets/libs/jquery/jquery.min.js"></script>
            <script src="../../../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="../../../assets/libs/metismenu/metisMenu.min.js"></script>
            <script src="../../../assets/libs/simplebar/simplebar.min.js"></script>
            <script src="../../../assets/libs/node-waves/waves.min.js"></script>
            <script src="../../../assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>

            <!--Morris Chart-->
            <script src="../../../assets/libs/morris.js/morris.min.js"></script>
            <script src="../../../assets/libs/raphael/raphael.min.js"></script>

            <script src="../../../assets/js/pages/dashboard.init.js"></script>

            <!-- App js -->
            <script src="../../../assets/js/app.js"></script>
            <script>
                var users = 1;
                var doanhthu = 1;
                var roomavaiable = 1;
                var roombooked = 1;

                new Morris.Donut({
                element: 'morris-donut',
                
                data: [
                    { label:"Users",value:users },
                    { label:"Doanh thu",value:doanhthu },
                    { label:"Room available",value:roomavaiable },
                    { label:"Room booked",value:roombooked },
                ]
                });
            </script>
</body>