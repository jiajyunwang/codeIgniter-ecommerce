<!DOCTYPE html>
<html lang="en">

<head>
  <title>E-SHOP || Login Page</title>
  <?php $this->load->view('auth/head'); ?>
</head>

<body class="bg-gradient-primary">

  <div class="container">
    <div class="mt-5">
      <div class="card mt-5">
        <div class="p-5">
          <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">後台管理系統</h1>
          </div>
          <?= form_open('admin/login'); ?>
            <div class="form-group">
              <input type="email" class="form-control form-control-user <?= form_error('email') ? 'is-invalid' : ''; ?>" 
              name="email" value="<?= set_value('email'); ?>" id="exampleInputEmail" aria-describedby="emailHelp" 
              placeholder="Enter Email Address..."  required autocomplete="email" autofocus>
                <?php if (form_error('email')): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?= form_error('email'); ?></strong>
                    </span>
                <?php endif; ?>
                <?php if($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="form-group">
              <input type="password" class="form-control form-control-user <?= form_error('password') ? 'is-invalid' : ''; ?>" 
              id="exampleInputPassword" placeholder="Password"  name="password" required autocomplete="current-password">
                <?php if (form_error('password')): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?= form_error('password'); ?></strong>
                    </span>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
              Login
            </button>
          <?= form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</body>

</html>