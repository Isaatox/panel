<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GTAFive</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="/style.css" rel="stylesheet">
</head>
<body class="antialiased">
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 bg-gray-900 sm:items-center py-4 sm:pt-0">
    <?php if(Route::has('login')): ?>
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(url('/home')); ?>" class="text-sm text-gray-700 text-gray-500 underline btn btn-primary">Compte</a>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="text-sm text-gray-700 text-gray-500 underline btn btn-primary">Connexion</a>

                <?php if(Route::has('register')): ?>
                    <a href="<?php echo e(route('register')); ?>" class="ml-4 text-sm text-gray-700 text-gray-500 underline btn btn-primary">Inscription</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            <img src="https://media.discordapp.net/attachments/958003632605892698/958010145407893554/fghh.png" class="h-16 w-auto text-gray-700 sm:h-20">
        </div>

        <div class="mt-8 bg-white bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
</div>
</body>
</html>

<?php /**PATH /var/www/panel/resources/views/layouts/app.blade.php ENDPATH**/ ?>