<?php

namespace publicity\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use publicity\Coupon;
use publicity\Publication;
use publicity\Company;
use publicity\Category;

class PublicationController extends Controller
{
    public function index(Request $request){

        $companies = Company::getCompanies();
        $categories = Category::getCategories();

        return view('publications.index', compact('companies', 'categories'));
        // return response($request->input());

    }

    public function show($id, Request $request){
        $publication = Publication::find($id);
        $publicationsCat = Publication::where('id_category', $publication->id_category)->take(3)->get();
        return view('publication', [
            'publication' => $publication,
            'pCategories' => $publicationsCat
        ]);
    }

    public function click(Request $request)
    {
        $result['response'] = '';
        $idMessage = $request->input('messageid');
        // if(Message::where('id', $idMessage)->update([
        //     'clicked'=> 1
        // ])){
        //     $result['response'] = 'success';
        // }else{
        //     $result['response'] = 'error';
        // }

        $message = Publication::findOrFail($idMessage);

        $message->clicked = $message->clicked + 1;

        if($message->save())
        {
            $result['response'] = 'success';
            $result['message'] = 'Se actualizó el mensaje';
        }else {
            $result['response'] = 'error';
        }

        return response()->json($result);
    }

    public function searchPublications(Request $request){
        $searchText = $request->input('searchText');
        $publications = Publication::where('title', 'LIKE', '%' . $searchText . '%')
                        ->orWhere('description', 'LIKE', '%' . $searchText . '%')
                        ->get();

        //$publications = Publication::simplePaginate($json->paginationElements);
        return view('index', [
            "publications" => $publications
        ]);
    }

    public function addCoupon(Request $request){
        if(Auth::guard('customer')->user() == null){
            return response([
                "statusRequest" => 3
            ]);
        }

        $publication = Publication::find($request->input('couponId'));
        if(!$publication->is_coupon){
            return response([
                "statusRequest" => 2
            ]);
        }

        if(count(Auth::guard('customer')->user()->coupons->where("id_publication", $publication->id)) > 0){
            return response([
                "statusRequest" => 0
            ]);
        }

        Coupon::create([
            "id_customer" => Auth::guard('customer')->user()->id,
            "id_publication" => $publication->id
        ]);
        //Auth::user()->
        return response()->json([
            "statusRequest" => 1,
            "PUBLICATION" => $publication,
            "DATA" => Auth::guard('customer')->user()->coupons->where("id_publication", $publication->id)
        ]);
    }
}
