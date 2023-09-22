<?php

namespace App\Http\Controllers;

use App\Models\Bakery;
use App\Models\Franchise;
use App\Models\Kitchen;
use App\Models\OrderChild;
use App\Models\OrderMaster;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['bakeries'] = Bakery::where('status', 1)->get();
        $data['kitchens'] = Kitchen::where('status', 1)->get();
        $data['franchise'] = Franchise::where('status', 1)->get();
        // $items = $bakeries->merge($kitchens);
        // dd($items->toarray());
        return view('order_report.index', compact('data'));
    }

    public function logsServerSideOwn(Request $request)
    {
        $search = $request->filter;
        $filter = (array)json_decode($search);
        $sort = $request->sort;
        $order = $request->order;
        $offset = $request->offset;
        $limit = $request->limit;
        $i = 1;

        // your table name
        $query = OrderMaster::when($search, function ($q) use ($filter, $i) {
            foreach ($filter as $key => $item) {
                if ($key == 'status') {
                    if (strtolower($item) == 'active') {
                        $q->where($key, 1);
                    } else {
                        $q->where($key, 0);
                    }
                } else {
                    $q->where($key, $item);
                }
            }
        })->when($sort, function ($q1) use ($sort, $order) {
            $q1->orderBy($sort, $order);
        });
        if (!$sort) {
            $query->orderBy('created_at', 'desc');
        }
        $count =  $query->count();
        $row = $query->when($offset, function ($q) use ($offset) {
            $q->offset($offset);
        })->when($limit, function ($q) use ($limit) {
            $q->limit($limit);
        })->get()->toArray();
        $index = $offset + 1;
        $data = [];
        foreach ($row as $key => $item) {
            if ($item['status'] == 1) {
                $row[$key]['status'] = 'Active';
            } else if ($item['status'] == 0) {
                $row[$key]['status'] = 'Deactive';
            }
            $row[$key]['counter'] = $index++;
        }
        $data['items'] = $row;
        $data['count'] = $count;
        // dd($data);
        return $data;
    }

    public function getOrderData(Request $request)
    {
        $date = $request->date;
        $type = $request->item_type;
        $date = explode(' - ', $date);
        $checked = $request->checked;
        // dump($date[0]->format('Y--m-d'));
        // $date = Carbon::parse($date[0])->format('Y-m-d');
        $sd = str_replace('/', '-', $date[0]);
        $ed = str_replace('/', '-', $date[1]);
        $sd = date("Y-m-d", strtotime($sd));
        $ed = date("Y-m-d", strtotime($ed));


        $period = CarbonPeriod::create($sd, $ed);

        $dates = [];
        // Iterate over the period
        foreach ($period as $date) {
            $dates[] = $date;
            // echo $date->format('Y-m-d');
        }
        // return 0;

        // Convert the period to an array of dates
        $dates = $period->toArray();

        if (isset($request->franchise)) {
            if ($request->franchise == "all") {

                $franchise = Franchise::where('status', 1)->get();
            } else {
                $franchise = Franchise::where('status', 1)->where('id', $request->franchise)->get();
            }
        } else {
            $franchise = Franchise::where('status', 1)->get();
        }
        $filterFer = $request->franchise == 'all' ? 0 : ($request->franchise > 0 ? $request->franchise : 0);
        if ($type == 'bakery') {
            $mainitem = Bakery::where('status', 1)->get();
        } elseif ($type == 'kitchen') {
            $mainitem = Kitchen::where('status', 1)->get();
        }

        $html = view('order_report.ordertable', compact('type', 'sd', 'ed', 'mainitem', 'franchise', 'checked', 'dates', 'filterFer'))->render();
        return response()->json(['success' => true, 'data' => $html,]);

        // $orderChilds = OrderChild::with('orderMaster', 'bakery', 'kitchen')->when($date, function($q) use($date) {
        //     $q->whereHas('orderMaster', function ($c) use ($date) {
        //         $c->whereDate('date', Carbon::parse($date)->format('Y-m-d'));
        //     });
        // })->where('item_type', $request->item_type)->get();
        // dd($orderChilds);

        $table = '';
        if ($item_type == 'bakery') {
            $table = 'bakeries';
        } elseif ($item_type == 'kitchen') {
            $table = 'kitchens';
        }
        // $query = 'SELECT c.name as item_name, b.item_id, b.item_type, count(b.item_id) as item_count  FROM order_masters as a  INNER JOIN order_children as b ON a.id = b.order_master_id  INNER JOIN ' . $table . ' as c ON b.item_id = c.id WHERE b.item_type = "' . $item_type . '" and a.date = date("' . Carbon::parse($date)->format('Y-m-d') . '") group by b.item_id';
        $franchiseQuery = 'SELECT DISTINCT f.franchise_name FROM order_masters as om INNER JOIN order_children as oc ON om.id = oc.order_master_id INNER JOIN ' . $table . ' as bak ON oc.item_id = bak.id INNER JOIN franchises as f ON om.franchise_id = f.id WHERE oc.item_type = "' . $item_type . '" and om.date = date("' . Carbon::parse($date)->format('Y-m-d') . '") group by f.franchise_name, oc.item_id';
        $franchise = DB::select($franchiseQuery);

        $itemsQuery = 'SELECT bak.name as item_name, oc.item_id, oc.item_type FROM order_masters as om INNER JOIN order_children as oc ON om.id = oc.order_master_id INNER JOIN ' . $table . ' as bak ON oc.item_id = bak.id INNER JOIN franchises as f ON om.franchise_id = f.id WHERE oc.item_type = "' . $item_type . '" and om.date = date("' . Carbon::parse($date)->format('Y-m-d') . '") group by oc.item_id;';
        $items = DB::select($itemsQuery);

        $query = 'SELECT f.franchise_name, bak.name as item_name, oc.item_id, oc.item_type, count(oc.item_id) as item_count  FROM order_masters as om   INNER JOIN order_children as oc ON om.id = oc.order_master_id   INNER JOIN ' . $table . ' as bak ON oc.item_id = bak.id  INNER JOIN franchises as f ON om.franchise_id = f.id WHERE oc.item_type = "' . $item_type . '" and om.date = date("' . Carbon::parse($date)->format('Y-m-d') . '") group by om.franchise_id, oc.item_id';
        $data = DB::select($query);
        // dd($data);
        // foreach ($data as $item) {
        //     dump($item);
        // }
        // exit;
        // if(!$data) {
        //     if($item_type == 'bakery') {
        //         $bakery = Bakery::select('name as item_name')->where('status', 1)->get()->toArray();
        //         foreach ($bakery as $key => $item) {
        //             $bakery[$key]['item_count'] = 0;
        //         }
        //         $data = $bakery;
        //     } else if($item_type == 'kitchen') {
        //         $kitchen = Kitchen::select('name as item_name')->where('status', 1)->get()->toArray();
        //         foreach ($kitchen as $key => $item) {
        //             $kitchen[$key]['item_count'] = 0;
        //         }
        //         $data = $kitchen;
        //     }
        // }
        return response()->json(['success' => true, 'data' => $data, 'franchise' => $franchise, 'items' => $items]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
