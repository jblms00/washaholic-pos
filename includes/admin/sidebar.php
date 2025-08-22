<div class="sidebar">
    <div class="logo-details">
        <i class="bx bx-spa icon"></i>
        <div class="logo-name">Washaholic</div>
        <i class="fa-solid fa-bars" id="btn"></i>
    </div>
    <ul class="nav-list">
        <li>
            <a href="dashboard">
                <i class="fa-solid fa-grip"></i>
                <span class="links-name">Dashboard</span>
            </a>
            <span class="tooltip">Dashboard</span>
        </li>
        <li>
            <div class="dropdown">
                <a href="#" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-clipboard-list"></i>
                    <span class="links-name">Manage Bookings</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item bg-transparent" href="manageBookings?status=pending">Pending</a></li>
                    <li><a class="dropdown-item bg-transparent" href="manageBookings?status=accepted">Accepted</a></li>
                    <li><a class="dropdown-item bg-transparent"
                            href="manageBookings?status=scheduled-for-pickup">Scheduled
                            for Pickup</a></li>
                    <li><a class="dropdown-item bg-transparent" href="manageBookings?status=in-pickup">In Pickup</a>
                    </li>
                    <li><a class="dropdown-item bg-transparent" href="manageBookings?status=in-processing">In
                            Processing</a></li>
                    <li><a class="dropdown-item bg-transparent" href="manageBookings?status=ready-for-delivery">Ready
                            for Delivery</a></li>
                    <li><a class="dropdown-item bg-transparent" href="manageBookings?status=out-for-delivery">Out for
                            Delivery</a></li>
                    <li><a class="dropdown-item bg-transparent" href="manageBookings?status=delivered">Delivered</a>
                    </li>
                    <li><a class="dropdown-item bg-transparent" href="manageBookings?status=completed">Completed</a>
                    </li>
                </ul>
            </div>
            <span class="tooltip">Manage Bookings</span>
        </li>
        <li>
            <a href="manageStaffs">
                <i class="fa-solid fa-users"></i>
                <span class="links-name">Manage Staffs</span>
            </a>
            <span class="tooltip">Manage Staffs</span>
        </li>
        <li>
            <a href="manageAdmins">
                <i class="fa-solid fa-user-tie"></i>
                <span class="links-name">Manage Admins</span>
            </a>
            <span class="tooltip">Manage Admins</span>
        </li>
        <li>
            <a href="../actions/user-logout.php">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span class="links-name">Logout</span>
            </a>
        </li>
    </ul>
</div>