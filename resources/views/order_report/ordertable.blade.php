
<table class="table mb-0 table-striped  table-bordered" id="profile_list_table">
    <thead id="thead">
        <tr>
            <th>Date</th>
            @if($checked == "false")
            <th>Franchise</th>
            @endif
            @foreach ($mainitem as $item)
            <th class="text-end">{{$item->name}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody id="tbody">


        @if ($checked == "false")

        @foreach ($dates as $date)

        @foreach ($franchise as $franch)
        @php
$isorderdata = true;
if ($checked == "false") {
    $isorderdata = App\Models\OrderMaster::whereDate('date', $date)->where('franchise_id',$franch->id)->exists();
    # code...
}
        @endphp
        @if ($isorderdata)

                <tr>
                    <td>{{$date->format('d-m-Y')}}</td>
                        @if($checked == "false")
                    <td>{{ $franch->franchise_name }}</td>
                    @endif
                    @foreach ($mainitem as $item)

                    @php

                    $bid = $item->id;
                    $fid= $franch->id;
                    $data =
                    App\Models\OrderMaster::whereDate('date', $date)->when($checked == "false", function ($query) use($fid) {
                            $query->where('franchise_id', $fid);
                        })->withSum(['orderChild'
                    => function ($q) use($bid,$type) {
                    $q->where('item_id', $bid)->where('item_type',$type);
                    }],'quantity')->get();
                    // $data =
                    // App\Models\OrderMaster::whereBetween(DB::raw('DATE(date)'), [$sd,$ed])->where('franchise_id',$franch->id)->withSum(['orderChild'
                    // => function ($q) use($bid,$type) {
                    // $q->where('item_id', $bid)->where('item_type',$type);
                    // }],'quantity')->get();


                    $tot = $data->sum('order_child_sum_quantity');

                    $item['item_tot'] += $tot;
                    @endphp
                    <td class="text-end">

                        {{$tot}}


                    </td>
                    @endforeach
                </tr>
        @endif

        @endforeach


        @endforeach


        @else

 @foreach ($dates as $date)

        {{-- @foreach ($franchise as $franch) --}}
        @php
$isorderdata = true;
if ($checked == "false") {
    $isorderdata = App\Models\OrderMaster::whereDate('date', $date)->exists();
    # code...
}
        @endphp
        @if ($isorderdata)

                <tr>
                    <td>{{$date->format('d-m-Y')}}</td>
                        {{-- @if($checked == "false")
                    <td>{{ $franch->franchise_name }} {{$franch->id}}</td>
                    @endif --}}
                    @foreach ($mainitem as $item)

                    @php

                    $bid = $item->id;
                    $fid= $filterFer;
                    $data =
                    App\Models\OrderMaster::whereDate('date', $date)->when($filterFer, function ($query) use($fid) {
                            $query->where('franchise_id', $fid);
                        })->withSum(['orderChild'
                    => function ($q) use($bid,$type) {
                    $q->where('item_id', $bid)->where('item_type',$type);
                    }],'quantity')->get();
                    // $data =
                    // App\Models\OrderMaster::whereBetween(DB::raw('DATE(date)'), [$sd,$ed])->where('franchise_id',$franch->id)->withSum(['orderChild'
                    // => function ($q) use($bid,$type) {
                    // $q->where('item_id', $bid)->where('item_type',$type);
                    // }],'quantity')->get();


                    $tot = $data->sum('order_child_sum_quantity');

                    $item['item_tot'] += $tot;
                    @endphp
                    <td class="text-end">

                        {{$tot}}


                    </td>
                    @endforeach
                </tr>
        @endif

        {{-- @endforeach --}}


        @endforeach

        @endif

        <tr>
            @if($checked == "false")
            <th>-</th>
            @endif
            <th>Grand Total</th>
            @foreach ($mainitem as $item)
            <th class="text-end">{{$item['item_tot']}}</th>
            @endforeach

        </tr>
    </tbody>
</table>
