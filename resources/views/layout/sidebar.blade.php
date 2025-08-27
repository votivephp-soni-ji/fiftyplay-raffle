<div id="scrollbar">
    <div class="container-fluid">


        <div id="two-column-menu">
        </div>
        <ul class="navbar-nav" id="navbar-nav">
            <li class="menu-title"><span data-key="t-menu">Menu</span></li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarDashboards">
                    <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarDashboards">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="dashboard-analytics.html" class="nav-link" data-key="t-analytics">
                                Analytics </a>
                        </li>
                        <li class="nav-item">
                            <a href="dashboard-crm.html" class="nav-link" data-key="t-crm"> CRM </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.html" class="nav-link" data-key="t-ecommerce"> Ecommerce </a>
                        </li>
                        <li class="nav-item">
                            <a href="dashboard-crypto.html" class="nav-link" data-key="t-crypto"> Crypto
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="dashboard-projects.html" class="nav-link" data-key="t-projects">
                                Projects </a>
                        </li>
                        <li class="nav-item">
                            <a href="dashboard-nft.html" class="nav-link" data-key="t-nft"> NFT</a>
                        </li>
                        <li class="nav-item">
                            <a href="dashboard-job.html" class="nav-link" data-key="t-job">Job</a>
                        </li>
                        <li class="nav-item">
                            <a href="dashboard-blog.html" class="nav-link"><span data-key="t-blog">Blog</span> <span
                                    class="badge bg-success" data-key="t-new">New</span></a>
                        </li>
                    </ul>
                </div>
            </li> <!-- end Dashboard Menu -->
            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarApps">
                    <i class="ri-apps-2-line"></i> <span data-key="t-apps">Event Management</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarApps">
                    <ul class="nav nav-sm flex-column">

                        <li class="nav-item">
                            <a href="{{ route('event.create') }}" class="nav-link active">Create Event
                            </a>
                        </li>

                    </ul>
                </div>
            </li>


        </ul>
    </div>
    <!-- Sidebar -->
</div>

<div class="sidebar-background"></div>
