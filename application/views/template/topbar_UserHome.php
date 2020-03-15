<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
  <?php
  $level_id = $this->session->userdata('level_id');
  $queryLevel = "SELECT level
                FROM user_level
                WHERE user_level.id = $level_id
                ";
  $hasL = $this->db->query($queryLevel)->result_array();
  ?>
  <!-- Main Content -->
  <div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
      <?php foreach ($hasL as $hL) : ?>
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url($hL['level']); ?>">
        <?php endforeach; ?>
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="far fa-handshake"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Job Application</div>
        </a>

        <!-- Sidebar Toggle (Topbar) -->
        <!-- <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
          <i class="fa fa-bars"></i>
        </button> -->
        <!-- Query menu -->
        <?php
                                                                                      $level_id = $this->session->userdata('level_id');
                                                                                      $queryMenu = "SELECT user_menu.id, menu
          FROM user_menu JOIN user_access_menu
          ON user_menu.id = user_access_menu.menu_id
          WHERE user_access_menu.role_id = $level_id
          ORDER BY user_access_menu.menu_id ASC
          ";

                                                                                      $menu = $this->db->query($queryMenu)->result_array();
        ?>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
              <a class="nav-link" href="<?= base_url('user/getStatus') . '?st=0'; ?>" id="navbarDropdown" role="button">
                <?php if ($stat > 0) : ?>
                  <span class="badge badge-light">Cek Status !<i class="fa fa-bell fa-fw pl-1"></i></span>
                <?php elseif ($stat == 0) : ?> <span class="badge badge-light">Tidak ada pemberitahuan baru<i class="fa fa-bell-slash fa-fw pl-1"></i></span>
                <?php endif  ?>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
              </div>
            </li>
          </ul>
        </div>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">
          <!-- Looping Menu -->
          <?php foreach ($menu as $m) : ?>
            <?php
                                                                                        $menuId = $m['id'];
                                                                                        $querySubMenu =
                                                                                          "
          SELECT *
          FROM user_sub_menu JOIN user_menu
          ON user_sub_menu.menu_id = user_menu.id
          WHERE user_sub_menu.menu_id = $menuId
          AND user_sub_menu.is_active = 1
          ";

                                                                                        $SubMenu = $this->db->query($querySubMenu)->result_array();
            ?>

            <?php foreach ($SubMenu as $sm) : ?>
              <?php if ($judul == $sm['title']) : ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>
                <a class="nav-link" href="<?= base_url($sm['url']); ?>">
                  <i class="<?= $sm['icon']; ?>"></i>
                  <span><?= $sm['title']; ?></span></a>
                </li>
              <?php endforeach; ?>

              <div class="topbar-divider d-none d-sm-block"></div>

            <?php endforeach; ?>



            <!-- <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li> -->

            <!-- <div class="topbar-divider d-none d-sm-block"></div> -->

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['nama']; ?></span>
                <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['gambar']; ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= base_url('user/Profile'); ?>">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profil Saya
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item out" href="<?= base_url('auth/logout'); ?>">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Keluar
                </a>
              </div>
            </li>

        </ul>

    </nav>
    <!-- End of Topbar -->