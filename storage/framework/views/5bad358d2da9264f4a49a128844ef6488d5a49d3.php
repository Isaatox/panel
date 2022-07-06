<?php $__env->startSection('content'); ?>
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="p-6">
            <div class="flex items-center">
                <div class="ml-4 text-lg leading-7 "><a href="#" class=" text-gray-900 text-dark">QCM</a>
                </div>
            </div>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Valide</th>
                        <th scope="col">Utilisateur</th>
                        <th scope="col">Temps</th>
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
                            <td><p class="text-align-center flex"><?php echo e($qcm_->user()->username); ?></p></td>
                            <td><p class="text-align-center flex"><?php echo e($qcm_->diff()); ?></p></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if($qcm->isEmpty()): ?>
                        <tr>
                            <td colspan="6">Aucun QCM rempli.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>

        </div>
    <div class="p-6">
        <div class="flex items-center">
            <div class="ml-4 text-lg leading-7 "><a href="#" class=" text-gray-900 text-dark">Utilisateurs</a>
            </div>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">E-mail</th>
                <th scope="col">Utilisateur</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <?php echo e($user->email); ?>

                    </td>
                    <td><p class="text-align-center flex"><?php echo e($user->username); ?> (<?php echo e($user->username_discord); ?>)</p></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    </div>
    <div class="grid grid-cols-1">
        <div class="p-6">
            <div class="flex items-center">
                <div class="ml-4 text-lg leading-7 "><a href="#" class=" text-gray-900 text-dark">Questions</a>
                </div>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Question</th>
                    <th scope="col">Edition</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <?php echo e($question->answer); ?>

                        </td>
                        <td><a class="btn btn-primary btn-sm" href="<?php echo e(route('question.edit', ['question' => $question->id])); ?>">Editer</a></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if($qcm->isEmpty()): ?>
                    <tr>
                        <td colspan="6">Aucun QCM rempli.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>

        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/panel/resources/views/admin.blade.php ENDPATH**/ ?>