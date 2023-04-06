@php
    $translation = $row->translate();
@endphp
<div class="card transition-3d-hover shadow-hover-2 item-loop w-100 {{$wrap_class ?? ''}}">
    <div class="position-relative">
        <a @if(!empty($blank)) target="_blank" @endif href="{{$row->getDetailUrl($include_param ?? true)}}" class="d-block gradient-overlay-half-bg-gradient-v5">
            <img class="card-img-top" src="{{$row->image_url}}" alt="{!! clean($translation->title) !!}">
        </a>
        <div class="position-absolute top-0 right-0 pt-4 pr-3 btn-wishlist">
            <button type="button" class="p-0 btn btn-sm btn-icon text-white rounded-circle service-wishlist {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __("Save for later") }}">
                <span class="flaticon-valentine-heart font-size-20"></span>
            </button>
        </div>
        <div class="position-absolute bottom-0 left-0 right-0 text-content">
            <div class="px-3 pb-2">
                <a @if(!empty($blank)) target="_blank" @endif href="{{$row->getDetailUrl($include_param ?? true)}}" >
                    <span class="text-white font-weight-bold font-size-17">{!! clean($translation->title) !!}</span>
                </a>
                <div class="text-white my-2">
                    <small class="mr-1 font-size-14">{{ __("From") }}</small>
                    <small class="mr-1 font-size-13 text-decoration-line-through">
                        {{ $row->display_sale_price }}
                    </small>
                    <span class="font-weight-bold font-size-19">{{ $row->display_price }}</span>
                </div>
            </div>
        </div>
        <div class="location d-none position-absolute bottom-0 left-0 right-0">
            <div class="px-4 pb-3">
                @if(!empty($row->location->name))
                    @php $location =  $row->location->translate(); @endphp
                    <a href="{{$row->location->getDetailUrl() ?? ''}}" class="d-block">
                        <div class="d-flex align-items-center font-size-14 text-white">
                            <i class="icon flaticon-pin-1 mr-2 font-size-20"></i> {{$location->name ?? ''}}
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </div>


    <div class="card-body px-3 py-3 border-bottom">
      
        <a @if(!empty($blank)) target="_blank" @endif href="{{$row->getDetailUrl($include_param ?? true)}}" class="d-none title">
            <span class="font-weight-bold font-size-17">{!! clean($translation->title) !!}</span>
        </a>
                                    <button class="btn btn-primary d-flex align-items-center justify-content-center  height-60 w-100 mb-xl-0 mb-lg-1 transition-3d-hover font-weight-bold" @click="doSubmit($event)" :class="{'disabled':onSubmit,'btn-success':(step == 2),'btn-primary':step == 1}" name="submit">
                                <span class="stop-color-white">{{__("Book Now")}}</span>
                                <i v-show="onSubmit" class="fa fa-spinner fa-spin ml-1"></i>
                            </button>
        <div class="g-price d-none">
            <div class="prefix">
                <span class="fr_text">{{__("from")}}</span>
            </div>
            <div class="price">
                <span class="onsale">{{ $row->display_sale_price }}</span>
                <span class="text-price">{{ $row->display_price }}</span>
            </div>
        </div>
    </div>
    
</div>
