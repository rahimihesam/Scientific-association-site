<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/assets/css/bootstrap.rtl.min.css" />
  <link rel="stylesheet" href="/assets/css/styles.css" />
  <link rel="icon" href="/assets/img/ico.png" />
  <title>ورود به حساب کاربری</title>
</head>

<body class="d-flex align-items-center justify-content-center min-vh-100 bg-light">
  <div
    class="card shadow-sm border border-primary rounded-4 p-4"
    style="width: 100%; max-width: 420px">
    <div class="text-center mb-4">
      <div
        class="bg-primary bg-opacity-10 rounded-3 d-inline-flex align-items-center justify-content-center mb-3"
        style="width: 56px; height: 56px">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="28"
          height="28"
          fill="currentColor"
          class="text-primary"
          viewBox="0 0 16 16">
          <path
            d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
        </svg>
      </div>
      <h4 class="fw-bold text-dark mb-1">ورود به حساب</h4>
      <p class="text-muted small mb-0">اطلاعات خود را وارد کنید</p>
    </div>

    <!-- Display error message if exists in session -->
    <?php if (isset($_SESSION['error'])): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($_SESSION['error']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <!-- Login form -->
    <form action="/auth/login" id="loginForm" method="POST" novalidate>
      <!-- CSRF Token -->
      <input type="hidden" name="csrf_token" value="<?= $csrfToken ?? ''; ?>">

      <!-- Username field -->
      <div class="mb-3">
        <label for="username" class="form-label fw-medium">شماره موبایل یا ایمیلتان را وارد کنید</label>
        <div class="input-group">
          <span class="input-group-text bg-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
              <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
              <path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0h-7zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492V2.5z" />
            </svg>
          </span>
          <input
            type="text"
            class="form-control rounded-end-2"
            id="username"
            name="username"
            required />
          <div class="invalid-feedback">لطفاً یک ایمیل یا شماره موبایل معتبر وارد کنید.</div>
          <div class="valid-feedback">ایمیل یا شماره موبایل معتبر است.</div>
        </div>
      </div>
      <!-- Password -->
      <div class="mb-3">
        <label for="password" class="form-label fw-medium">رمز عبور</label>
        <div class="input-group">
          <span class="input-group-text bg-white">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="16"
              height="16"
              fill="currentColor"
              class="text-secondary"
              viewBox="0 0 16 16">
              <path
                d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
            </svg>
          </span>
          <input
            type="password"
            class="form-control border-end-0"
            id="password"
            name="password"
            required
            minlength="8" />
          <button
            class="input-group-text toggle-password bg-white"
            type="button"
            id="togglePassword"
            aria-label="نمایش رمز">
            <svg
              id="eyeIcon"
              xmlns="http://www.w3.org/2000/svg"
              width="16"
              height="16"
              fill="currentColor"
              class="text-secondary"
              viewBox="0 0 16 16">
              <path
                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
              <path
                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
            </svg>
          </button>
        </div>
      </div>
      <!-- Remember + Forgot -->
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="form-check mb-0">
          <input class="form-check-input" type="checkbox" id="rememberMe" name="remember" />
          <label class="form-check-label small text-muted" for="rememberMe">مرا به خاطر بسپار</label>
        </div>
        <a href="#" class="small text-primary text-decoration-none">فراموشی رمز؟</a>
      </div>
      <!-- Submit -->
      <button
        type="submit"
        class="btn btn-primary w-100 fw-semibold py-2"
        id="submitBtn">
        ورود
      </button>
    </form>
    <hr class="my-4" />
    <p class="text-center text-muted small mb-0">
      حساب ندارید؟
      <a href="/register" class="text-primary text-decoration-none fw-medium">ثبت‌نام کنید</a>
    </p>
  </div>
  <script src="/assets/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/js/script.js"></script>
</body>

</html>