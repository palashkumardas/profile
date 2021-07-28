 <!-- Sidebar menu-->
 <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="images/palash.png" alt="User Image" style="height:70px; width:70px;">
        <div>
          <p class="app-sidebar__user-name"> <?php echo strtoupper($_SESSION['name']); ?></p>
          <p class="app-sidebar__user-designation"><?php echo strtoupper($_SESSION['role']);?></p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item active" href="dashboard.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li><a class="app-menu__item" href="home.php"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label">Home</span></a></li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-bars"></i><span class="app-menu__label">About</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="personal.php"><i class="icon fa fa-address-card-o"></i>personal</a></li>
            <li><a class="treeview-item" href="skills.php"><i class="icon fa fa-bar-chart "></i> skill</a></li>
            <li><a class="treeview-item" href="facts.php"><i class="icon fa fa-th-large "></i> fact</a></li>
            <li><a class="treeview-item" href="testimonials.php"><i class="icon fa fa-text-width "></i>testimonial</a></li>
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-address-book-o"></i><span class="app-menu__label">Resume</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="resume.php"><i class="icon fa fa-briefcase"></i>summary</a></li>
            <li><a class="treeview-item" href="education.php"><i class="icon fa fa-graduation-cap"></i> education</a></li>
            <li><a class="treeview-item" href="experiance.php"><i class="icon fa fa-line-chart "></i> experience</a></li>
          </ul>
        </li>
        <li><a class="app-menu__item" href="services.php"><i class="app-menu__icon fa fa-tasks"></i><span class="app-menu__label">Services</span></a></li>
        <li><a class="app-menu__item" href="contact.php"><i class="app-menu__icon fa fa-phone-square"></i><span class="app-menu__label">Contact</span></a></li>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cogs"></i><span class="app-menu__label">Account Management</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="logout.php"><i class="icon fa fa-sign-out"></i> Logout</a></li>
            <li><a class="treeview-item" href="profile.php"><i class="icon fa fa-user"></i>Profile</a></li>

          </ul>
        </li>
      </ul>
    </aside>
