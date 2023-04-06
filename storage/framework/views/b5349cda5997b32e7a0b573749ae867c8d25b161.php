
<?php $__env->startSection('content'); ?>
    <h2 class="title-bar">
        <?php echo e(!empty($recovery) ?__('Recovery Cars') : __("Manage Cars")); ?>

        <?php if(Auth::user()->hasPermission('car_create') && empty($recovery)): ?>
     
        <?php endif; ?>
    </h2>
    <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if($rows->total() > 0): ?>
        <div class="bravo-list-item">
            <div class="bravo-pagination">
                <span class="count-string"><?php echo e(__("Showing :from - :to of :total Cars",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()])); ?></span>
                <?php echo e($rows->appends(request()->query())->links()); ?>

            </div>
            <div class="list-item">
                <div class="row">
                    <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-12">
                            <?php echo $__env->make('Car::frontend.manageCar.loop-list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <form action="<?php echo e(route('car.vendor.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="form-add-service">
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a data-toggle="tab" href="#nav-tour-content" aria-selected="true" class="active"><?php echo e(__("1. Content")); ?></a>
                    <a data-toggle="tab" href="#nav-tour-location" aria-selected="false"><?php echo e(__("2. Locations")); ?></a>
                    <a data-toggle="tab" href="#nav-tour-pricing" aria-selected="false"><?php echo e(__("3. Pricing")); ?></a>
                    <?php if(is_default_lang()): ?>
                        <a data-toggle="tab" href="#nav-attribute" aria-selected="false"><?php echo e(__("4. Attributes")); ?></a>
                    <?php endif; ?>
                </div>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-tour-content">
                        <?php echo $__env->make('Car::admin/car/content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php if(is_default_lang()): ?>
                            <div class="form-group">
                                <label><?php echo e(__("Featured Image")); ?></label>
                                <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$row->image_id); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="tab-pane fade" id="nav-tour-location">
                        <?php echo $__env->make('Car::admin/car/location',["is_smart_search"=>"1"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="tab-pane fade" id="nav-tour-pricing">
                        <div class="panel">
                            <div class="panel-title"><strong><?php echo e(__('Default State')); ?></strong></div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select name="default_state" class="custom-select">
                                                <option value=""><?php echo e(__('-- Please select --')); ?></option>
                                                <option value="1" <?php if(old('default_state',$row->default_state ?? 0) == 1): ?> selected <?php endif; ?>><?php echo e(__("Always available")); ?></option>
                                                <option value="0" <?php if(old('default_state',$row->default_state ?? 0) == 0): ?> selected <?php endif; ?>><?php echo e(__("Only available on specific dates")); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo $__env->make('Car::admin/car/pricing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <?php if(is_default_lang()): ?>
                        <div class="tab-pane fade" id="nav-attribute">
                            <?php echo $__env->make('Car::admin/car/attributes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> <?php echo e(__('Save Changes')); ?></button>
            </div>
        </form>
            </div>
        
            <div class="bravo-pagination">
                <span class="count-string"><?php echo e(__("Showing :from - :to of :total Cars",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()])); ?></span>
                <?php echo e($rows->appends(request()->query())->links()); ?>

            </div>
        </div>
    <?php else: ?>
        <?php echo e(__("No Car")); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gett5822/deneme/themes/Mytravel/Car/Views/frontend/manageCar/carpricing.blade.php ENDPATH**/ ?>