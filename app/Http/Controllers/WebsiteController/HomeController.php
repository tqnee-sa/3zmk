<?php

namespace App\Http\Controllers\WebsiteController;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Models\Restaurant\Azmak\AZBranch;
use App\Models\Restaurant\Azmak\AZMenuCategory;
use App\Models\Restaurant\Azmak\AZProduct;
use App\Models\Restaurant;
use App\Models\City;
use App\Models\RestaurantTermsCondition;
use App\Models\RestaurantAboutAzmak;
use App\Models\AzSubscription;
use App\Models\Restaurant\Azmak\AZRestaurantSubCategory;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index($res)
    {
        $restaurant = Restaurant::whereNameBarcode($res)->firstOrFail();
        $branches = AZBranch::whereRestaurantId($restaurant->id)->get();
        $cities = City::with('branches')
            ->whereHas('branches', function ($q) use ($restaurant) {
                $q->whereRestaurantId($restaurant->id);
            })->get();
        if ($restaurant->az_info and $restaurant->az_info->lang != 'both') :
            session()->put('locale', $restaurant->az_info->lang);
            App::setLocale($restaurant->az_info->lang);
        endif;
        return view('website.index', compact('branches', 'restaurant', 'cities'));
    }

    public function home(Request $request, $branch_id = null)
    {
        if ($request->branch) {
            $branch = AZBranch::find($request->branch);
        } else {
            $branch = AZBranch::find($branch_id);
        }
        if ($branch->restaurant->az_info and $branch->restaurant->az_info->lang != 'both') :
            session()->put('locale', $branch->restaurant->az_info->lang);
            App::setLocale($branch->restaurant->az_info->lang);
        endif;
        return redirect()->route('homeBranchIndex', [$branch->restaurant->name_barcode, $branch->name_en]);
    }

    public function homeBranch(Request $request, $res, $branch, $category_id = null, $subCategoryId = null)
    {
        $restaurant = Restaurant::whereNameBarcode($res)->firstOrFail();
        /**
         * @check for restaurant subscription to show menu
         */
        $subscription = AzSubscription::whereRestaurantId($restaurant->id)->first();
        if ($subscription and ($subscription->status == 'active' or $subscription->status == 'free')) {
            $branch = AZBranch::whereNameEn($branch)->first();
            $sliders = $restaurant->sliders()
                ->whereStop('false')
                ->get();
            $branches = AZBranch::whereRestaurantId($restaurant->id)->get();
            $categories = AZMenuCategory::whereRestaurantId($restaurant->id)
                ->where('branch_id', $branch->id)
                ->where('active', 'true')
                ->orderBy(DB::raw('ISNULL(arrange), arrange'), 'ASC')
                ->get();
            $sql = '';
            $menuCategory = null;
            $subCategory = null;
            if ($category_id) {
                $menuCategory = AZMenuCategory::whereRestaurantId($restaurant->id)
                    ->where('branch_id', $branch->id)
                    ->where('active', 'true')
                    ->orderBy(DB::raw('ISNULL(arrange), arrange'), 'ASC')
                    ->findOrFail($category_id);
            } else {
                $menuCategory = AZMenuCategory::whereRestaurantId($restaurant->id)
                    ->where('branch_id', $branch->id)
                    ->where('active', 'true')
                    ->orderBy(DB::raw('ISNULL(arrange), arrange'), 'ASC')
                    ->firstOrFail();
            }
            if ($subCategoryId != null) {
                $subCategory = AZRestaurantSubCategory::whereHas('restaurant_category', function ($query) use ($branch) {
                    $query->where('branch_id', $branch->id)->where('active', 'true');
                })->findOrFail($subCategoryId);
            }
            $products = AZProduct::whereRestaurantId($restaurant->id)
                ->where('branch_id', $branch->id)
                ->where('menu_category_id', $menuCategory->id)
                ->when(isset($subCategory->id) , function($query)use($subCategory){
                    $query->where('sub_category_id' , $subCategory->id);
                })
                ->where('active', 'true')
                ->where('available', 'true')
                ->orderBy(DB::raw('ISNULL(arrange), arrange'), 'ASC')
                ->paginate(100);
            if ($request->is_category == 'true') {
                return response([
                    'status' => true,
                    'data' => [
                        'menu_category_name' => @$menuCategory->name,
                        'sub_category_content' => view('website.accessories.sub_categories' , compact('restaurant' , 'branch' , 'menuCategory' , 'subCategory'))->render(),
                        'products' => view('website.accessories.products', compact(['restaurant', 'products', 'branch', 'categories', 'sliders', 'branches', 'category_id' , 'menuCategory' , 'subCategory']))->render(),
                    ],
                ]);
            }
            if ($restaurant->az_info and $restaurant->az_info->lang != 'both') :
                session()->put('locale', $restaurant->az_info->lang);
                App::setLocale($restaurant->az_info->lang);
            endif;
            // update restaurant menu views
            $restaurant->az_info->update(['menu_views' => $restaurant->az_info->menu_views + 1]);
            return view('website.home', compact('restaurant', 'products', 'branch', 'categories', 'sliders', 'branches', 'category_id' , 'menuCategory' , 'subCategory'));
        } else {
            return $this->index($restaurant->name_barcode);
        }
    }

    public function terms($res, $branch)
    {
        $restaurant = Restaurant::whereNameBarcode($res)->firstOrFail();
        $branch = AZBranch::whereNameEn($branch)->first();
        $terms = RestaurantTermsCondition::whereRestaurantId($restaurant->id)->first();
        return view('website.pages.terms', compact('restaurant', 'branch', 'terms'));
    }

    public function about($res, $branch)
    {
        $restaurant = Restaurant::whereNameBarcode($res)->firstOrFail();
        $branch = AZBranch::whereNameEn($branch)->first();
        $about = RestaurantAboutAzmak::whereRestaurantId($restaurant->id)->first();
        return view('website.pages.about', compact('restaurant', 'branch', 'about'));
    }

    public function product_details($id)
    {
        $product = AZProduct::findOrFail($id);
        $restaurant = $product->restaurant;
        $branch = $product->branch;
        $route = route('product_details', $product->id);
        $details = (app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en) . ' ' . (app()->getLocale() == 'ar' ? strip_tags(str_replace('&nbsp;', ' ', $product->description_ar)) : strip_tags(str_replace('&nbsp;', ' ', $product->description_en)));
        $shareComponent = \Share::page(
            $route,
            $details,
        )
            ->facebook()
            ->twitter()
            ->linkedin()
            ->telegram()
            ->whatsapp()
            ->reddit();
        return view('website.accessories.product_details', compact('product', 'restaurant', 'branch', 'shareComponent'));
    }
}
