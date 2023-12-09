<div class="card shadow-lg mx-4 ">
  <div class="card-header pb-0 text-center m-4">
    <h3>Trang cá nhân</h3>
  </div>
  <div class="card-body p-3">
    <div class="row gx-4">
      <div class="col-auto">
        <div class="avatar avatar-xl position-relative">
          <img src="<?= $avatarPath . $avatar ?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
        </div>
      </div>
      <div class="col-auto my-auto">
        <div class="h-100">
          <h5 class="mb-1">
            <?= $_SESSION['user']['fullname'] ?>
          </h5>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid py-3">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <p class="text-uppercase text-sm">Thông tin người dùng</p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Tên đăng nhập</label>
                <input class="form-control" type="text" value="<?= $_SESSION['user']['username'] ?>" readonly
                  style="background-color: #fff;">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Email</label>
                <input class="form-control" type="email" value="<?= $_SESSION['user']['email'] ?>" readonly
                  style="background-color: #fff;">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Họ và tên</label>
                <input class="form-control" type="text" value="<?= $_SESSION['user']['fullname'] ?>" readonly
                  style="background-color: #fff;">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Số điện thoại</label>
                <input class="form-control" type="text" value="<?= $_SESSION['user']['tel'] ?>" readonly
                  style="background-color: #fff;">
              </div>
            </div>
          </div>
          <hr class="horizontal dark">
          <p class="text-uppercase text-sm">Thông tin liên hệ</p>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Địa chỉ</label>
                <textarea name="address" id="" cols="30" rows="2" class="form-control" readonly
                  style="background-color: #fff;"><?= $_SESSION['user']['address'] ?></textarea>
              </div>
            </div>

          </div>
          <hr class="horizontal dark">
          <p class="text-uppercase text-sm">Giới thiệu về bản thân</p>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <textarea name="bio" id="" cols="30" rows="4" class="form-control" readonly
                  style="background-color: #fff;"><?= $_SESSION['user']['bio'] ?></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>