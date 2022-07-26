<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <?php if(isset($_SESSION['admin'])){ ?>
                <li class="menu-title">Hello Admin <h5><?= ($_SESSION['admin']['username']) ?></h5></li>
                <?php }else{ ?>
                <li class="menu-title">Hello Staff <h5><?= ($_SESSION['staff']['username']) ?></h5></li>
                <?php } ?>
                <li>
                    <a href="?c=dashboard" class=" waves-effect <?= (isset($_GET['c']) && $_GET['c'] == 'dashboard') ? 'mm-active' : '' ?>">
                        <i class="mdi mdi-calendar-check"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="<?= (isset($_GET['c']) && $_GET['c'] == 'booking' || $_GET['c'] == 'user' || $_GET['c'] == 'room') ? 'mm-active' : '' ?>">
                    <a href="javascript: void(0);" class="has-arrow waves-effect <?= (isset($_GET['c']) && $_GET['c'] == 'booking' || $_GET['c'] == 'user' || $_GET['c'] == 'room') ? 'mm-active' : '' ?>">
                        <i class="mdi mdi-clipboard-outline"></i>
                        <span>Quan ly</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="?c=user" class="<?= (isset($_GET['c']) && $_GET['c'] == 'user') ? 'active' : '' ?>">Users/Staff</a></li>
                        <li><a href="?c=room" class="<?= (isset($_GET['c']) && $_GET['c'] == 'room') ? 'active' : '' ?>">Rooms</a></li>
                        <li><a href="?c=booking" class="<?= (isset($_GET['c']) && $_GET['c'] == 'booking') ? 'active' : '' ?>">Booking</a></li>   
                    </ul>
                </li>
                <?php if(isset($_SESSION['admin'])) {?>
                <li>
                    <a href="?c=staff" class=" waves-effect <?= (isset($_GET['c']) && $_GET['c'] == 'staff' && $_GET['a'] == 'index') ? 'mm-active' : '' ?>">
                        <i class="mdi mdi-calendar-check"></i>
                        <span>Percent Staff</span>
                    </a>
                </li>
                <?php } ?>
                <?php if(isset($_SESSION['admin'])) {?>
                <li>
                    <a href="?c=requestpayment" class=" waves-effect">
                        <i class="mdi mdi-calendar-check"></i>
                        <span>Request Payment</span>
                    </a>
                </li>
                <?php } ?>
                <?php if(isset($_SESSION['staff'])) {?>
                <li>
                    <a href="?c=staff&a=show_withdrawal&id=<?= $_SESSION['staff']['id'] ?>" class=" waves-effect <?= (isset($_GET['a']) && $_GET['a'] == 'show_withdrawal') ? 'mm-active' : '' ?>">
                        <i class="mdi mdi-calendar-check"></i>
                        <span>Staff Request</span>
                    </a>
                </li>
                <li>
                    <a href="?c=staff&a=show_history_request&id=<?= $_SESSION['staff']['id'] ?>" class=" waves-effect <?= (isset($_GET['a']) && $_GET['a'] == 'show_history_request') ? 'mm-active' : '' ?>">
                        <i class="mdi mdi-calendar-check"></i>
                        <span>History request</span>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->