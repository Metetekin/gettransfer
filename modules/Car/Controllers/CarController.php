<?php
namespace Modules\Car\Controllers;

use App\Http\Controllers\Controller;
use Modules\Car\Models\Car;
use Illuminate\Http\Request;
use Modules\Location\Models\Location;
use Modules\Review\Models\Review;
use Modules\Core\Models\Attributes;
use DB;

class CarController extends Controller
{
    protected $carClass;
    protected $locationClass;
    public function __construct(Car $carClass, Location $locationClass)
    {
        $this->carClass = $carClass;
        $this->locationClass = $locationClass;
    }

    public function callAction($method, $parameters)
    {
        if(!$this->carClass::isEnable())
        {
            return redirect('/');
        }
        return parent::callAction($method, $parameters); // TODO: Change the autogenerated stub
    }
    public function index(Request $request)
    {

        $startLatitude = request()->get('map_lat');
        $startLongitude = request()->get('map_lgn');
        $endLatitude = 41.276901;
        $endLongitude = 28.729324;
        
        $googleMapsEmbed = $this->createGoogleMapsEmbed($startLatitude, $startLongitude, $endLatitude, $endLongitude);
    

        $is_ajax = $request->query('_ajax');

        if(!empty($request->query('limit'))){
            $limit = $request->query('limit');
        }else{
            $limit = !empty(setting_item("car_page_limit_item"))? setting_item("car_page_limit_item") : 9;

        }
        $query = $this->carClass->search($request->input());
        $list = $query->paginate($limit);
        $markers = [];
        if (!empty($list)) {
            foreach ($list as $row) {
                $markers[] = [
                    "id"      => $row->id,
                    "title"   => $row->title,
                    "lat"     => (float)$row->map_lat,
                    "lng"     => (float)$row->map_lng,
                    "gallery" => $row->getGallery(true),
                    "infobox" => view('Car::frontend.layouts.search.loop-grid', ['row' => $row,'disable_lazyload'=>1,'wrap_class'=>'infobox-item'])->render(),
                    'marker' => get_file_url(setting_item("car_icon_marker_map"),'full') ?? url('images/icons/png/pin.png'),
                ];
            }
        }
        $limit_location = 15;
        if( empty(setting_item("car_location_search_style")) or setting_item("car_location_search_style") == "normal" ){
            $limit_location = 1000;
        }
        $data = [
            'rows'               => $list,
            'list_location'      => $this->locationClass::where('status', 'publish')->limit($limit_location)->with(['translation'])->get()->toTree(),
            'car_min_max_price' => $this->carClass::getMinMaxPrice(),
            'markers'            => $markers,
            "blank" => setting_item('search_open_tab') == "current_tab" ? 0 : 1 ,
            "seo_meta"           => $this->carClass::getSeoMetaForPageList(),
         "googleMapsEmbed"  => $googleMapsEmbed,
        ];
        $layout = setting_item("car_layout_search", 'normal');
        if ($request->query('_layout')) {
            $layout = $request->query('_layout');
        }
        $data['layout'] = $layout;
        if ($is_ajax) {

            return $this->sendSuccess([
                'html'    => view('Car::frontend.layouts.search-map.list-item', $data)->render(),
                "markers" => $data['markers']
            ]);
        }
        $data['attributes'] = Attributes::where('service', 'car')->orderBy("position","desc")->with(['terms'=>function($query){
            $query->withCount('car');
        },'translation'])->get();

        if ($layout == "map") {
            $data['body_class'] = 'has-search-map';
            $data['html_class'] = 'full-page';
            $data['googleMapsEmbed'] = $googleMapsEmbed;
            return view('Car::frontend.search-map', $data);
        }
        return view('Car::frontend.search', $data);
    }
    
    function createGoogleMapsEmbed($startLatitude, $startLongitude, $endLatitude, $endLongitude) {
        $iframeSrc = "https://www.google.com/maps/embed?pb=!1m24!1m12!1m3!1d1571650.6910543812!2d27.19810547564829!3d39.70301657982493!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m9!3e6!4m3!3m2!1d" . $startLatitude . "!2d" . $startLongitude . "!4m3!3m2!1d" . $endLatitude . "!2d" . $endLongitude . "!5e0!3m2!1str!2str!4v1680291428792!5m2!1str!2str";

        return '<iframe src="' . $iframeSrc . '" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
    }

    public function detail(Request $request, $slug)
    {
        $row = $this->carClass::where('slug', $slug)->with(['location','translation','hasWishList'])->first();;
        if ( empty($row) or !$row->hasPermissionDetailView()) {
            return redirect('/');
        }
        $translation = $row->translate();
        $car_related = [];
        $location_id = $row->location_id;
        if (!empty($location_id)) {
            $car_related = $this->carClass::where('location_id', $location_id)->where("status", "publish")->take(4)->whereNotIn('id', [$row->id])->with(['location','translation','hasWishList'])->get();
        }
        $review_list = $row->getReviewList();
        $data = [
            'row'          => $row,
            'translation'       => $translation,
            'car_related' => $car_related,
            'booking_data' => $row->getBookingData(),
            'review_list'  => $review_list,
            'seo_meta'  => $row->getSeoMetaWithTranslation(app()->getLocale(),$translation),
            'body_class'=>'is_single',
            'breadcrumbs'       => [
                [
                    'name'  => __('Car'),
                    'url'  => route('car.search'),
                ],
            ],
        ];
        $data['breadcrumbs'] = array_merge($data['breadcrumbs'],$row->locationBreadcrumbs());
        $data['breadcrumbs'][] = [
            'name'  => $translation->title,
            'class' => 'active'
        ];
        $this->setActiveMenu($row);
        return view('Car::frontend.detail', $data);
    }
}
