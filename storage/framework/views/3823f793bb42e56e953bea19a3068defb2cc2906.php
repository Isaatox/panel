<?php $__env->startSection('content'); ?>

    <div class="grid grid-cols-1 md:grid-cols-2">

        <div class="p-6 bg-primary">

            <div class="">
            
                <div class="mt-2" style="margin-top: 50px;text-align: center;">

                    <b style="text-align: center;" class="text-lg">Créer un compte</b>

<p style="
    font-size: 16px;
    text-align: center;
">
                        Bienvenue sur le panel de W:RP ! Il faudra vous inscrire pour pouvoir accéder au formulaire. Si vous réussissez, vous serez automatiquement whitelist. Il faut réussir avec minimum 10 bonnes réponses sur 15.
                    </p>

                </div>

                <div class="justify-center flex">
                    <a href="<?php echo e(route('login')); ?>" class="btn underline btn-primary2 text-center mt-2 ">Se connecter</a>
                </div>
            </div>

        </div>
        <div class="p-6">
            <div class="flex items-center">
                <div class="ml-4 text-lg leading-7 font-semibold"><a href="#" class=" text-gray-900 text-white">Réinitaliser le mot de passe d'un compte</a></div>
            </div>
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('password.email')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Adresse E-mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>

                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Envoyez le lien de réinitialisation
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/panel/resources/views/auth/passwords/email.blade.php ENDPATH**/ ?>