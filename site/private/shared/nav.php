<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <a class="navbar-brand" href="<?php echo BASE_URL ?>">Easy Finance</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo BASE_URL ?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo BASE_URL ?>/pages/coa">Chart of Accounts <span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <form class="form-inline mt-2 mt-md-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    <?php if(isset($user)) { ?>
    <div class="btn-group">
      <button type="button" style="margin-left:5px;" class="btn btn-outline-success my-2 my-sm-0 dropdown-toggle" data-toggle="dropdown">
        <?php echo $user['name'] ?>
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="<?php echo BASE_URL ?>/pages/edit-profile.php">Edit Profile</a>
        <a class="dropdown-item" href="<?php echo BASE_URL ?>/pages/logout.php">Logout</a>
      </div>
    </div>
    <?php } ?>
  </div>
</nav>