
<?php $__env->startPush('css'); ?>
    <link href="<?php echo e(asset('/themes/mytravel/dist/frontend/module/car/css/car.css?_ver='.config('app.asset_version'))); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("/themes/mytravel/libs/ion_rangeslider/css/ion.rangeSlider.min.css")); ?>"/>
    <style type="text/css">
        .bravo_footer {
            display: none
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="bravo_search_tour bravo_search_car">
        <h1 class="d-none">
            <?php echo e(setting_item_with_lang("car_page_search_title")); ?>

        </h1>
        <div class="bravo_form_search_map">
            <?php echo $__env->make('Car::frontend.layouts.search-map.form-search-map', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="bravo_search_map <?php echo e(setting_item_with_lang("car_layout_map_option",false,"map_left")); ?>">
            <div class="results_map">
                <div class="map-loading d-none">
                    <div class="st-loader"></div>
                </div>
                    <?php echo $googleMapsEmbed; ?>

            </div>
            <div class="results_item">
                <?php echo $__env->make('Car::frontend.layouts.search-map.advance-filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="listing_items">
                    <?php echo $__env->make('Car::frontend.layouts.search-map.list-item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <?php echo App\Helpers\MapEngine::scripts(); ?>

    <script>
        var bravo_map_data = {
            markers:<?php echo json_encode($markers); ?>

        };
    </script>
    <script type="text/javascript" src="<?php echo e(asset("/themes/mytravel/libs/ion_rangeslider/js/ion.rangeSlider.min.js")); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('/themes/mytravel/module/car/js/car-map.js?_ver='.config('app.asset_version'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gett5822/public_html/themes/Mytravel/Car/Views/frontend/search-map.blade.php ENDPATH**/ ?>