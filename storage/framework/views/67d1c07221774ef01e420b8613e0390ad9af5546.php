<?php $__env->startSection('content'); ?>
    <form method="POST" action="<?php echo e(route('qcm.store', ['qcm' =>  $qcm])); ?>">
        <?php echo csrf_field(); ?>
    <div class="grid grid-cols-1 grid md:grid-cols-2 ">
        <?php $i3 = 0; ?>

    <?php $__currentLoopData = $qcm->questions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $i1 = $question->id; ?>
            <?php $i3++; ?>
        
            <?php $random = rand(10, 10000); ?>
            <div class="p-6">
                <?php if($loop->first): ?>

                    <div class="flex items-center">
                        <div class="ml-4 text-lg leading-7 font-semibold"><a href="#" class=" text-gray-900 text-dark">QCM</a></div>
                    </div>
                <?php endif; ?>

                    <?php if($loop->index == 1): ?>
                        <div class="flex items-center">
                            <div class="ml-4 text-lg leading-7 font-semibold"><a href="#" class=" text-gray-900 text-white">&nbsp;</a></div>
                        </div>
                    <?php endif; ?>
            <b class="mt-2 mb-3"> Question #<?php echo e($i3); ?> : <?php echo e($question->answer); ?></b>

        <?php $__currentLoopData = explode(',', $question->replies); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i2 => $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" name="<?php echo e($i2 + 1); ?>-<?php echo e($i1); ?>-<?php echo e($random); ?>" id="<?php echo e($i2 + 1); ?>-<?php echo e($i1); ?>-<?php echo e($random); ?>">
                    <label class="form-check-label" for="<?php echo e($i2 + 1); ?>-<?php echo e($i1); ?>-<?php echo e($random); ?>"><?php echo e($reply); ?></label>
                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="p-6">
            <button class="btn btn-primary">Soumettre mon QCM</button>
        </div>


    </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/panel/resources/views/qcm.blade.php ENDPATH**/ ?>