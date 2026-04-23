<!doctype html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/assets/css/bootstrap.rtl.min.css" />
  <link rel="stylesheet" href="/assets/css/styles.css" />
  <link rel="icon" href="/assets/img/ico.png" />
  <title>ثبت‌نام</title>
</head>

<body class="d-flex align-items-center justify-content-center min-vh-100 bg-light py-5">
  <div
    class="card shadow-sm border-0 rounded-4 p-4"
    style="width: 100%; max-width: 480px">
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
            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
        </svg>
      </div>
      <h4 class="fw-bold text-dark mb-1">ایجاد حساب کاربری</h4>
      <p class="text-muted small mb-0">اطلاعات خود را برای ثبت‌نام وارد کنید</p>
    </div>

    <!-- Display error message if exists in sesion -->
    <?php if (isset($_SESSION['error'])): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($_SESSION['error']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <!-- Registration form -->
    <form action="/auth/register" id="registerForm" method="POST" novalidate>
      <!-- CSRF Token -->
      <input type="hidden" name="csrf_token" value="<?= $csrfToken ?? ''; ?>">

      <!-- Full Name -->
      <div class="mb-3">
        <label for="fullName" class="form-label fw-medium">نام و نام خانوادگی</label>
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
                d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
            </svg>
          </span>
          <input
            type="text"
            class="form-control rounded-end-2"
            id="fullName"
            name="fullName"
            placeholder="نام کامل خود را وارد کنید"
            required
            minlength="3"
            value="<?= isset($full_name) ? htmlspecialchars($full_name) : ''; ?>" />
          <div class="invalid-feedback">نام باید حداقل ۳ کاراکتر باشد.</div>
          <div class="valid-feedback">نام معتبر است.</div>
        </div>
      </div>
      <!-- Mobile -->
      <div class="mb-3">
        <label for="mobile" class="form-label fw-medium">شماره موبایل</label>
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
                d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z" />
              <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
            </svg>
          </span>
          <input
            type="tel"
            class="form-control rounded-end-2 D-left"
            id="mobile"
            name="mobile"
            placeholder="۰۹xxxxxxxxx"
            required
            maxlength="11"
            value="<?= isset($mobile) ? htmlspecialchars($mobile) : ''; ?>" />
          <div class="invalid-feedback">لطفاً یک شماره موبایل معتبر وارد کنید.</div>
          <div class="valid-feedback">شماره موبایل معتبر است.</div>
        </div>
      </div>
      <!-- Email -->
      <div class="mb-3">
        <label for="email" class="form-label fw-medium">آدرس ایمیل</label>
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
                d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.708 2.825L15 11.105V5.383zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741zM1 11.105l4.708-2.897L1 5.383v5.722z" />
            </svg>
          </span>
          <input
            type="email"
            class="form-control rounded-end-2"
            id="email"
            name="email"
            placeholder="example@gmail.com"
            value="<?= isset($email) ? htmlspecialchars($email) : ''; ?>"
            required />
          <div class="invalid-feedback">لطفاً یک ایمیل معتبر وارد کنید.</div>
          <div class="valid-feedback">ایمیل معتبر است.</div>
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
            placeholder="حداقل ۸ کاراکتر"
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
        <!-- Strength bar -->
        <div class="strength-bar mt-2">
          <div class="strength-fill" id="strengthFill"></div>
        </div>
        <div class="mt-1">
          <small id="strengthLabel" class="text-muted"></small>
        </div>
        <div class="invalid-feedback d-block small" id="passwordError"></div>
      </div>
      <!-- Terms -->
      <div class="mb-4">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="terms" name="terms" required />
          <label class="form-check-label small text-muted" for="terms">
            <a href="#" class="text-primary text-decoration-none">قوانین و مقررات</a> را
            مطالعه کرده و می‌پذیرم
          </label>
          <div class="invalid-feedback">باید قوانین را بپذیرید.</div>
        </div>
      </div>
      <!-- Submit -->
      <button
        type="submit"
        class="btn btn-primary w-100 fw-semibold py-2"
        id="submitBtn">
        ثبت‌نام
      </button>
    </form>
    <hr class="my-4" />
    <p class="text-center text-muted small mb-0">
      قبلاً ثبت‌نام کرده‌اید؟
      <a href="/login" class="text-primary text-decoration-none fw-medium">وارد شوید</a>
    </p>
  </div>

  <script src="/assets/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/js/register.js"></script>
</body>

</html>