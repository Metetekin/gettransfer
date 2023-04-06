


<?php $__env->startSection('content'); ?>

    <h2 class="title-bar">
        <?php echo e(!empty($recovery) ?__('Recovery Cars') : __("Manage Cars")); ?>

        <?php if(Auth::user()->hasPermission('car_create') && empty($recovery)): ?>
            <a href="<?php echo e(route("car.vendor.create")); ?>" class="btn-change-password"><?php echo e(__("Add Car")); ?></a>
        <?php endif; ?>
    </h2>
   
     <div class="col-left">
                <form method="get" action="<?php echo e(route('car.vendor.index')); ?> " class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row" role="search">
                    <input type="text" name="s" value="<?php echo e(Request()->s); ?>" placeholder="<?php echo e(__('Search by name')); ?>"
                           class="form-control mr-3">
                    
                    <div class="flex-shrink-0">
                        <button class="btn-info btn btn-icon btn_search py-2" type="submit"><?php echo e(__('Search Cars')); ?></button>
                    </div>

                </form>
            </div>
                         <form action="<?php echo e(route('car.vendor.index')); ?>" method="post">
                             <?php echo csrf_field(); ?>
           <div class="d-flex justify-content-between">
                     
    <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if($rows->total() > 0): ?>

        <div class="bravo-list-item">
            <div class="bravo-pagination">
                <span class="count-string"><?php echo e(__("Showing :from - :to of :total Cars",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()])); ?></span>
                <?php echo e($rows->appends(request()->query())->links()); ?>

            </div>
            
            <div class="list-item">
                <div class="row">
                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <input type="hidden" name="ids[<?php echo e($key); ?>]" value="<?php echo e($row->id); ?>" multiple>
                        <div class="col-md-12">
                            <?php echo $__env->make('Car::frontend.manageCar.loop-list',['key' => $key], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            
            <div class="form-group">
                        <label class="control-label"><?php echo e(__("Price")); ?></label>
                   
                      <input type="number" step="any" min="0" name="price[<?php echo e($key); ?>]" class="form-control" value="<?php echo e($row->price); ?>" placeholder="<?php echo e(__("Car Price")); ?>">

                    </div>
                        </div>
                    
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="bravo-pagination">
                <span class="count-string"><?php echo e(__("Showing :from - :to of :total Cars",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()])); ?></span>
                <?php echo e($rows->appends(request()->query())->links()); ?>

            </div>
            
                

    <?php else: ?>
        <?php echo e(__("No Car")); ?>

    <?php endif; ?>
      <div>
                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> <?php echo e(__('Save Changes')); ?></button>
            </div>
            </form>
        </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gett5822/deneme/themes/Mytravel/Car/Views/frontend/manageCar/index.blade.php ENDPATH**/ ?>