

<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(route('news.vendor.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])); ?>" method="post" class="dungdt-form">
        <div class="container-fluid">

            <h2 class="title-bar d-flex justify-content-between align-items-center">
                <?php echo e($row->id ? __('Edit post: ').$row->title : __('Add new Post')); ?>

                <?php if($row->slug): ?>
                    <a class="btn btn-primary btn-sm" href="<?php echo e($row->getDetailUrl(request()->query('lang'))); ?>" target="_blank"><?php echo e(__("View Post")); ?></a>
                <?php endif; ?>
            </h2>
            <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('Language::admin.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="lang-content-box">
                <div class="row">
                    <div class="col-md-9">
                        <div class="panel">
                            <div class="panel-title"><strong><?php echo e(__('News content')); ?></strong></div>
                            <div class="panel-body">
                                <?php echo csrf_field(); ?>
                                <?php echo $__env->make('News::frontend.vendor.form',['row'=>$row], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                        <?php echo $__env->make('Core::admin/seo-meta/seo-meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="col-md-3">
                        <div class="panel">
                            <div class="panel-title"><strong><?php echo e(__('Status')); ?></strong></div>
                            <div class="panel-body">
                                <?php if(is_default_lang()): ?>
                                    <select name="status" class="form-control">
                                        <option <?php if($row->status=='draft'): ?> selected <?php endif; ?> value="draft"><?php echo e(__('Draft')); ?> </option>
                                        <option <?php if($row->status=='pending'): ?> selected <?php endif; ?> value="pending"><?php echo e(__('Pending')); ?> </option>
                                        <?php if(!setting_item('news_vendor_need_approve') or $row->status == 'publish'): ?>
                                            <option <?php if(setting_item('news_vendor_need_approve')): ?> disabled <?php endif; ?> <?php if($row->status=='publish'): ?> selected <?php endif; ?> value="publish"><?php echo e(__('Publish')); ?> </option>
                                        <?php endif; ?>
                                    </select>
                                <?php endif; ?>
                            </div>
                            <div class="panel-footer">

                                <div class="text-right">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> <?php echo e(__('Save Changes')); ?></button>
                                </div>
                            </div>
                        </div>

                        <?php if(is_default_lang()): ?>
                            <div class="panel">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label><?php echo e(__('Category')); ?> </label>
                                        <select name="cat_id" class="form-control">
                                            <option value=""><?php echo e(__('-- Please Select --')); ?> </option>
                                            <?php
                                            $traverse = function ($categories, $prefix = '') use (&$traverse, $row) {
                                                foreach ($categories as $category) {
                                                    $selected = '';
                                                    if ($row->cat_id == $category->id)
                                                        $selected = 'selected';
                                                    printf("<option value='%s' %s>%s</option>", $category->id, $selected, $prefix . ' ' . $category->name);
                                                    $traverse($category->children, $prefix . '-');
                                                }
                                            };
                                            $traverse($categories);
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"> <?php echo e(__('Tag')); ?></label>
                                        <div class="">
                                            <input type="text" data-role="tagsinput" value="<?php echo e($row->tag); ?>" placeholder="<?php echo e(__('Enter tag')); ?>" name="tag" class="form-control tag-input">
                                            <br>
                                            <div class="show_tags">
                                                <?php if(!empty($tags)): ?>
                                                    <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <span class="tag_item"><?php echo e($tag->name); ?><span data-role="remove"></span>
                                                    <input type="hidden" name="tag_ids[]" value="<?php echo e($tag->id); ?>">
                                                </span>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if(is_default_lang()): ?>
                            <div class="panel">
                                <div class="panel-body">
                                    <h3 class="panel-body-title"> <?php echo e(__('Feature Image')); ?></h3>
                                    <div class="form-group">
                                        <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$row->image_id); ?>

                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script type="text/javascript" src="<?php echo e(asset('libs/tinymce/js/tinymce/tinymce.min.js')); ?>" ></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('Layout::user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gett5822/public_html/themes/Base/News/Views/frontend/vendor/detail.blade.php ENDPATH**/ ?>