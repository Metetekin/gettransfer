<div class="form-group">
    <label><?php echo e(__('Title')); ?> <span class="text-danger">*</span></label>
    <input type="text" required value="<?php echo e($translation->title ?? 'New Post'); ?>" placeholder="News title" name="title" class="form-control">
</div>
<div class="form-group">
    <label class="control-label"><?php echo e(__('Content')); ?> </label>
    <div class="">
        <textarea name="content" class="d-none has-ckeditor" cols="30" rows="10"><?php echo e($translation->content); ?></textarea>
    </div>
</div>
<?php /**PATH /home/gett5822/deneme/themes/Base/News/Views/frontend/vendor/form.blade.php ENDPATH**/ ?>