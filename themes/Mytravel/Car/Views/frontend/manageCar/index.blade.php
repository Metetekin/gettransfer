

@extends('layouts.user')
@section('content')

    <h2 class="title-bar">
        {{!empty($recovery) ?__('Recovery Cars') : __("Manage Cars")}}
        @if(Auth::user()->hasPermission('car_create') && empty($recovery))
            <a href="{{ route("car.vendor.create") }}" class="btn-change-password">{{__("Add Car")}}</a>
        @endif
    </h2>
   
     <div class="col-left">
                <form method="get" action="{{route('car.vendor.index')}} " class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row" role="search">
                    <input type="text" name="s" value="{{ Request()->s }}" placeholder="{{__('Search by name')}}"
                           class="form-control mr-3">
                    
                    <div class="flex-shrink-0">
                        <button class="btn-info btn btn-icon btn_search py-2" type="submit">{{__('Search Cars')}}</button>
                    </div>

                </form>
            </div>
                         <form action="{{route('car.vendor.index')}}" method="post">
                             @csrf
           <div class="d-flex justify-content-between">
                     
    @include('admin.message')
    @if($rows->total() > 0)

        <div class="bravo-list-item">
            <div class="bravo-pagination">
                <span class="count-string">{{ __("Showing :from - :to of :total Cars",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()]) }}</span>
                {{$rows->appends(request()->query())->links()}}
            </div>
            
            <div class="list-item">
                <div class="row">
                @foreach($rows as $key => $row)
    <input type="hidden" name="ids[{{ $key }}]" value="{{ $row->id }}" multiple>
                        <div class="col-md-12">
                            @include('Car::frontend.manageCar.loop-list',['key' => $key])
                            
            <div class="form-group">
                        <label class="control-label">{{__("Price")}}</label>
                   
                      <input type="number" step="any" min="0" name="price[{{ $key }}]" class="form-control" value="{{$row->price}}" placeholder="{{__("Car Price")}}">

                    </div>
                        </div>
                    
                    @endforeach
                </div>
            </div>
            <div class="bravo-pagination">
                <span class="count-string">{{ __("Showing :from - :to of :total Cars",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()]) }}</span>
                {{$rows->appends(request()->query())->links()}}
            </div>
            
                

    @else
        {{__("No Car")}}
    @endif
      <div>
                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> {{__('Save Changes')}}</button>
            </div>
            </form>
        </div>
@endsection

