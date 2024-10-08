@extends('layouts.app')
@push('css')
    <link href="{{ asset('/themes/mytravel/dist/frontend/module/boat/css/boat.css?_ver='.config('app.asset_version')) }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset("/themes/mytravel/libs/ion_rangeslider/css/ion.rangeSlider.min.css") }}"/>
    <style type="text/css">
        .bravo_footer {
            display: none
        }
    </style>
@endpush
@section('content')
    <div class="bravo_search_tour bravo_search_boat">
        <h1 class="d-none">
            {{setting_item_with_lang("boat_page_search_title")}}
        </h1>
        <div class="bravo_form_search_map">
            @include('Boat::frontend.layouts.search-map.form-search-map')
        </div>
        <div class="bravo_search_map {{ setting_item_with_lang("boat_layout_map_option",false,"map_left") }}">
            <div class="results_map">
                <div class="map-loading d-none">
                    <div class="st-loader"></div>
                </div>
                        {!! $googleMapsEmbed !!}
            </div>
            <div class="results_item">
                @include('Boat::frontend.layouts.search-map.advance-filter')
                <div class="listing_items">
                    @include('Boat::frontend.layouts.search-map.list-item')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    {!! App\Helpers\MapEngine::scripts() !!}
    <script>
        var bravo_map_data = {
            markers:{!! json_encode($markers) !!},
            map_lat_default:{{setting_item('boat_map_lat_default','0')}},
            map_lng_default:{{setting_item('boat_map_lng_default','0')}},
            map_zoom_default:{{setting_item('boat_map_zoom_default','6')}},
        };
    </script>
    <script type="text/javascript" src="{{ asset("/themes/mytravel/libs/ion_rangeslider/js/ion.rangeSlider.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset('/themes/mytravel/module/boat/js/boat-map.js?_ver='.config('app.asset_version')) }}"></script>
@endpush
