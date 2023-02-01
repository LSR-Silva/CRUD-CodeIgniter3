<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Agenda de Contatos</a>
  <div>
    <form action="javascript:listar()" method="post"> <!-- < ?= base_url() ?>contato/listar -->
      <input class="form-control form-control-dark" name="busca" id="busca" placeholder="Buscar">
    </form>
  </div>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="<?= base_url() ?>login/logout">Sign out</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Menu</span>
          <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>contato">
              <span data-feather="file"></span>
              Contatos
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>grupo">
              <span data-feather="file"></span>
              Grupos
            </a>
          </li>
        </ul>
      </div>
    </nav>