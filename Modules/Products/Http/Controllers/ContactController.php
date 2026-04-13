<?php

namespace Modules\Products\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Base\Http\Traits\FilterBuilderTrait;
use Modules\Base\Http\Traits\FilterScopeTrait;

class ContactController extends Controller
{
    use FilterBuilderTrait;
    use FilterScopeTrait;

    public function index(Request $request)
    {
        $this->setFilter($request, "id", "=");
        $this->setFilter($request, "number_phone", "=");
        $this->setFilter($request, "email", "=");
        $this->setFilter($request, "name", "like");

        $filters  = $this->getFilter();
        $items    = DB::table("contacts");
        $items    = $this->scopeFilter($items, $filters);
        $items    = $items->orderBy("created_at", "desc")->paginate(20);

        $viewData = [
            "items" => $items,
            "query" => $request->query(),
        ];

        return view("products::pages.contacts.index")->with($viewData);
    }
}