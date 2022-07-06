<?php $__env->startSection('content'); ?>
    <form method="POST" action="<?php echo e(route('question.edit', ['question' =>  $question])); ?>">
        <?php echo csrf_field(); ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="grid grid-cols-1">
            <div class="p-6">

            <div class=" mb-3">
                <label for="answer" class="col-md-4 col-form-label text-md-end">Question</label>
                <div class="col-md-12">
                    <input id="answer" type="text" class="form-control " name="answer" value="<?php echo e(old('answer') ?? $question->answer); ?>" required autocomplete="answer" autofocus>
                </div>
            </div>
                <div class=" mb-3">

                <label for="replies" class="col-md-4 m-3 col-form-label text-md-end">Réponses possible (séparé par des virgules)</label>
                <div class="col-md-12">
                    <textarea id="replies" type="text" class="form-control " name="replies" style="width: 1000px; height: 100px;"><?php echo e(old('replies') ?? $question->replies); ?></textarea>
                </div>

                </div>
                <div class=" mb-3">

                <label for="validate" class="col-md-4 col-form-label text-md-end">Numero de question valide (séparé par des virgules)</label>
                <div class="col-md-12">
                    <input id="validate" type="text" class="form-control " name="validate" value="<?php echo e(old('validate') ?? $question->validate); ?>" required autocomplete="validated">
                </div>
                </div>
            </div>
            </div>


        <div class="p-6">
            <button class="btn btn-primary">Sauvegarder</button>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hugoj\Desktop\panel\resources\views/question.blade.php ENDPATH**/ ?>