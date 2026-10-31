<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo e($title); ?> | Universitas Teknokrat Indonesia</title>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:400,700'>
    <link rel="stylesheet" href="./style.css">

</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        -webkit-font-smoothing: antialiased;
    }

    body {
        background: #2d3b55;
        font-family: 'Rubik', sans-serif;
    }

    .login-form {
        background: #fff;
        width: 500px;
        margin: 65px auto;
        display: -webkit-box;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        flex-direction: column;
        border-radius: 4px;
        box-shadow: 0 2px 25px rgba(0, 0, 0, 0.2);
    }

    .login-form h1 {
        padding: 35px 35px 0 35px;
        font-weight: 300;
    }

    .login-form .content {
        padding: 35px;
        text-align: center;
    }

    .login-form .input-field {
        padding: 12px 5px;
    }

    .login-form .input-field input {
        font-size: 16px;
        display: block;
        font-family: 'Rubik', sans-serif;
        width: 100%;
        padding: 10px 1px;
        border: 0;
        border-bottom: 1px solid #747474;
        outline: none;
        -webkit-transition: all .2s;
        transition: all .2s;
    }

    .login-form .input-field input::-webkit-input-placeholder {
        text-transform: uppercase;
    }

    .login-form .input-field input::-moz-placeholder {
        text-transform: uppercase;
    }

    .login-form .input-field input:-ms-input-placeholder {
        text-transform: uppercase;
    }

    .login-form .input-field input::-ms-input-placeholder {
        text-transform: uppercase;
    }

    .login-form .input-field input::placeholder {
        text-transform: uppercase;
    }

    .login-form .input-field input:focus {
        border-color: #222;
    }

    .login-form a.link {
        text-decoration: none;
        color: #747474;
        letter-spacing: 0.2px;
        text-transform: uppercase;
        display: inline-block;
        margin-top: 20px;
    }

    .login-form .action {
        display: -webkit-box;
        display: flex;
        -webkit-box-orient: horizontal;
        -webkit-box-direction: normal;
        flex-direction: row;
    }

    .login-form .action button {
        width: 100%;
        border: none;
        padding: 18px;
        font-family: 'Rubik', sans-serif;
        cursor: pointer;
        text-transform: uppercase;
        background: #e8e9ec;
        color: #777;
        border-bottom-left-radius: 4px;
        border-bottom-right-radius: 0;
        letter-spacing: 0.2px;
        outline: 0;
        -webkit-transition: all .3s;
        transition: all .3s;
    }

    .login-form .action button:hover {
        background: #d8d8d8;
    }

    .login-form .action button:nth-child(2) {
        background: #2d3b55;
        color: #fff;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 4px;
    }

    .login-form .action button:nth-child(2):hover {
        background: #3c4d6d;
    }
</style>

<body>
    <div class="login-form">
        <form action="/register" method="post" class="form-input">
            <?php echo csrf_field(); ?>
            <h1>Register</h1>
            <div class="content">
                <?php if(session()->has('regiserror')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo e(session('regiserror')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <div class="input-field">
                    <input type="text" class="input-field border-0" required
                        placeholder="Your Name <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('name')); ?>"
                        name="name" id="name-content-4-1" />
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback" style="display: block">
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="input-field">
                    <input type="number" class="input-field border-0" required
                        placeholder="Your NPM <?php $__errorArgs = ['nomor_induk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        value="<?php echo e(old('nomor_induk')); ?>" name="nomor_induk" id="nomor_induk-content-4-1" />
                    <?php $__errorArgs = ['nomor_induk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback" style="display: block">
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="input-field">
                    <input class="input-field border-0" type="email" required
                        placeholder="Your Email Address <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        value="<?php echo e(old('email')); ?>" class="input-form" name="email" id="floatingInput" autofocus
                        autocomplete="off" />
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback" style="display: block">
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="input-field">
                    <input type="password" class="input-field border-0" required
                        placeholder="Your Password <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        value="<?php echo e(old('password')); ?>" name="password" id="password-content-4-1" />
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback" style="display: block">
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="action">
                <a href="/login">
                    <button type="button">Login</button>
                </a>
                <button type="submit">
                    Register
                </button>
            </div>
        </form>
    </div>
    <script src="./script.js"></script>

</body>
<script>
    let form = document.querySelecter('form');

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        return false;
    });
</script>

</html>
<?php /**PATH C:\laragon\www\web-pinjam-ruang-main-20250923T141746Z-1-001\web-pinjam-ruang-main\web-pinjam-ruang-main\resources\views/auth/register.blade.php ENDPATH**/ ?>