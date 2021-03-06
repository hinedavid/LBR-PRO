{{-- Topbar --}}
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" id="page-top">

  {{-- Sidebar Toggle (Topbar) --}}
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>
  {{-- Topbar Search --}}
  <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="row">
      <div class="input-group col-8">
        <input type="search" v-model="search"
          @keyup="searchit"
          class="form-control bg-light border-0 small"
          placeholder="Buscar"
          aria-label="Search"
          aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button" @click="searchit">
            <i class="fas fa-search fa-sm"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  {{-- Topbar Navbar --}}
  <ul class="navbar-nav ml-auto">

    {{-- Nav Item - Search Dropdown (Visible Only XS) --}}
    <li class="nav-item dropdown no-arrow d-sm-none">
      <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-search fa-fw"></i>
      </a>
      {{-- Dropdown - Messages --}}
      <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
        <form class="form-inline mr-auto w-100 navbar-search">
          <div class="input-group">
            <input type="text"
            @keyup="searchit"
            class="form-control bg-light border-0 small"
            placeholder="Buscar"
            aria-label="Search"
            aria-describedby="basic-addon2">
            <div class="input-group-append">
              <button class="btn btn-primary" type="button" @click="searchit">
                <i class="fas fa-search fa-sm"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li>

    {{-- Nav Item - Alerts --}}
    <user-notificator :user="{{ Auth::user() }}"></user-notificator>
    <div class="topbar-divider d-none d-sm-block"></div>
    {{-- Nav Item - User Information --}}
    <user-avatar></user-avatar>
  </ul>

</nav>
{{-- End of Topbar --}}
