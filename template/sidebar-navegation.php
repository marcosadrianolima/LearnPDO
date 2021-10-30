<?php $base_url = RAIZ_PROJETO; ?>
<div class="main-sidebar sidebar-style-2" tabindex="1" style="overflow: hidden; outline: none;">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html"> <img alt="image" src="../public/otika/img/logo.png" class="header-logo"> <span class="logo-name">Otika</span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg><span>Produtos</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?= $base_url ?>produto_categoria">Categoria</a></li>
                <li><a class="nav-link" href="<?= $base_url ?>produto">Produto</a></li>
                <li><a class="nav-link" href="<?= $base_url ?>produto_unidade">Unidade medida</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg><span>Cofigurações</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?= $base_url ?>usuario">Usuários</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-anchor"><circle cx="12" cy="5" r="3"></circle><line x1="12" y1="22" x2="12" y2="8"></line><path d="M5 12H2a10 10 0 0 0 20 0h-3"></path></svg><span>Other
                  Pages</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="create-post.html">Create Post</a></li>
                <li><a class="nav-link" href="posts.html">Posts</a></li>
                <li><a class="nav-link" href="profile.html">Profile</a></li>
                <li><a class="nav-link" href="contact.html">Contact</a></li>
                <li><a class="nav-link" href="invoice.html">Invoice</a></li>
              </ul>
            </li>

            <!-- MULTINÍVEL -->
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-down"><polyline points="7 13 12 18 17 13"></polyline><polyline points="7 6 12 11 17 6"></polyline></svg><span>Multilevel</span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Menu 1</a></li>
                <li class="dropdown">
                  <a href="#" class="has-dropdown">Menu 2</a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Child Menu 1</a></li>
                    <li class="dropdown">
                      <a href="#" class="has-dropdown">Child Menu 2</a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Child Menu 1</a></li>
                        <li><a href="#">Child Menu 2</a></li>
                      </ul>
                    </li>
                    <li><a href="#"> Child Menu 3</a></li>
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
        </aside>
      </div>