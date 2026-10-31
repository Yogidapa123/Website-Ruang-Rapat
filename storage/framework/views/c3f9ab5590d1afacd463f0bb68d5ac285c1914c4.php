<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">

    <title> <?php echo e($title); ?> | DISKOMINFO KABUPATEN MALANG </title>

    <meta name="description" content="">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('assets/images/LOGODISKOMINFO.png')); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/animate.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/LineIcons.2.0.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap-5.0.5-alpha.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/table.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/index.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/responsive.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/normalize.css')); ?>" />
    

</head>

<?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->yieldContent('container'); ?>

<?php if(request()->path() !== 'login'): ?>
    <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<!--====== Bootstrap js ======-->
<script src="<?php echo e(asset('assets/js/bootstrap.bundle-5.0.0.alpha-min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/bootstrap.bundle.min.js')); ?>"></script>

<!--====== wow js ======-->
<script src="<?php echo e(asset('assets/js/wow.min.js')); ?>"></script>

<!--====== Main js ======-->
<script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>

<script>
    // Get the navbar

    // for menu scroll 
    var pageLink = document.querySelectorAll('.page-scroll');

    pageLink.forEach(elem => {
        elem.addEventListener('click', e => {
            e.preventDefault();
            document.querySelector(elem.getAttribute('href')).scrollIntoView({
                behavior: 'smooth',
                offsetTop: 1 - 60,
            });
        });
    });

    // section menu active
    function onScroll(event) {
        var sections = document.querySelectorAll('.page-scroll');
        var scrollPos = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop;

        for (var i = 0; i < sections.length; i++) {
            var currLink = sections[i];
            var val = currLink.getAttribute('href');
            var refElement = document.querySelector(val);
            var scrollTopMinus = scrollPos + 73;
            if (refElement.offsetTop <= scrollTopMinus && (refElement.offsetTop + refElement.offsetHeight >
                    scrollTopMinus)) {
                document.querySelector('.page-scroll').classList.remove('active');
                currLink.classList.add('active');
            } else {
                currLink.classList.remove('active');
            }
        }
    };

    window.document.addEventListener('scroll', onScroll);


    //===== close navbar-collapse when a  clicked
    let navbarToggler = document.querySelector(".navbar-toggler");
    var navbarCollapse = document.querySelector(".navbar-collapse");

    document.querySelectorAll(".page-scroll").forEach(e =>
        e.addEventListener("click", () => {
            navbarToggler.classList.remove("active");
            navbarCollapse.classList.remove('show')
        })
    );
    navbarToggler.addEventListener('click', function() {
        navbarToggler.classList.toggle("active");
    });

    function togglePassword() {
        var x = document.getElementById("password-content-3-6");
        if (x.type === "password") {
            x.type = "text";
            document
                .getElementById("icon-toggle")
                .setAttribute("fill", "#2ec49c");
        } else {
            x.type = "password";
            document
                .getElementById("icon-toggle")
                .setAttribute("fill", "#CACBCE");
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
</script>


</body>

</html>
<?php /**PATH C:\laragon\www\web-pinjam-ruang-main-20250923T141746Z-1-001\web-pinjam-ruang-main\web-pinjam-ruang-main\resources\views/layouts/main.blade.php ENDPATH**/ ?>