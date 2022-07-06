<?php $__env->startSection('content'); ?>
    <div class="grid grid-cols-1">
        <div class="p-6">
            <div class="flex items-center">
                <div class="ml-4 text-lg leading-7 "><a href="#" class=" text-gray-900 text-dark">Dashboard</a>
                </div>
            </div>
                    <?php if(session('status')): ?>
                        <div class="alert alert-info" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    Connecté en tant que <?php echo e(Auth::user()->username); ?>, <?php echo e(Auth::user()->username_discord ? '(' . Auth::user()->username_discord . ')' : ''); ?>

            <?php if(Auth::user()->discord_id == null): ?>
                <a class="btn btn-discord" href="<?php echo e(route('discord')); ?>">Connexion via discord</a>
                <?php else: ?>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Valide</th>
                    <th scope="col">Questions validées</th>
                    <th scope="col">Temps</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $qcm; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qcm_): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <?php if($qcm_->successfully): ?>
                            <p class="text-success">Validé</p>
                            <?php elseif($qcm_->validatedcount == null): ?>
                            <p class="text-warning">En attente</p>
                        <?php else: ?>
                            <p class="text-danger">Non validé</p>
                        <?php endif; ?>
                    </td>
                    <td><p class="text-align-center flex"><?php echo e($qcm_->validatedcount ?? 'En attente'); ?></p></td>
                    <td><p class="text-align-center flex"><?php echo e($qcm_->diff()); ?></p></td>
                    <td>
                        <?php if($qcm_->validatedcount == null): ?>
                        <a class="btn btn-primary btn-sm" href="<?php echo e(route('qcm', ['qcm' => $qcm_->id])); ?>">Voir le QCM</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if($qcm->isEmpty()): ?>
                    <tr>
                        <td colspan="6">Aucun QCM rempli.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <?php endif; ?>
            <form method="POST" action="<?php echo e(route('logout')); ?>" style="display: inline-block">
                <?php echo csrf_field(); ?>
                <button class="btn btn-danger">Se déconnecter</button>
                <a class="btn btn-primary btn-sm <?php echo e(count($qcm) == 3 ? 'disabled' : ''); ?>" href="<?php echo e(route('qcm.create')); ?>" <?php echo e(count($qcm) == 3 ? 'disabled' : ''); ?>>Faire le QCM (<?php echo e(count($qcm)); ?> / 3)</a>

            </form>
        </div>
            </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/panel/resources/views/home.blade.php ENDPATH**/ ?>