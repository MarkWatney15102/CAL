<?php

use lib\Auth\Level;
use src\Helper\User\UserHelper;

?>
<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark left-sidebar">
    <a href="/dashboard" class="sidebar-header">
        <span class="fs-4">Auftragssystem</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li>
            <a href="/dashboard" class="nav-link text-white">
                <img src="/images/icons/dashboard.svg" alt="Dashboard" class="navbar-icon">
                Dashboard
            </a>
        </li>
        <li>
            <a href="/projects" class="nav-link text-white">
                <img src="/images/icons/projects.svg" alt="Projects" class="navbar-icon">
                Projekte
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser"
           data-bs-toggle="dropdown" aria-expanded="false">
            <img src="/images/user.png" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong><?= UserHelper::getUsername() ?></strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser">
            <li><a class="dropdown-item" href="/profile">Profile</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <?php if (UserHelper::hasUserRequiredLevel(Level::ADMIN)) { ?>
                <li><a class="dropdown-item" href="/admin/dashboard">Admin Einstellungen</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
            <?php } ?>
            <li><a class="dropdown-item" href="/logout">Logout</a></li>
        </ul>
    </div>
</div>