<!DOCTYPE html>
<html id="ddd">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Estimate</title>
</head>
<style type="text/css">
    @font-face {
        font-family: 'font_family';
        font-style: normal;
        font-weight: normal;
        src: url(public/assets/gujrati.ttf) format('truetype');
    }

    body {
        font-family: DejaVu Sans, sans-serif;
    }

    .m-0 {
        margin: 0px;
    }

    .p-0 {
        padding: 0px;
    }

    .pt-5 {
        padding-top: 5px;
    }

    .mt-10 {
        margin-top: 10px;
    }

    .text-center {
        text-align: center !important;
    }

    .w-100 {
        width: 100%;
    }

    .w-25 {
        width: 25%;
    }

    .w-50 {
        width: 50%;
    }

    .w-75 {
        width: 75%;
    }

    .w-85 {
        width: 85%;
    }

    .w-15 {
        width: 15%;
    }

    .logo img {
        width: 45px;
        height: 45px;
        padding-top: 30px;
    }

    .logo span {
        margin-left: 8px;
        top: 19px;
        position: absolute;
        font-weight: bold;
        font-size: 25px;
    }

    .gray-color {
        color: #5D5D5D;
    }

    .text-bold {
        font-weight: bold;
    }

    .border {
        border: 1px solid black;
    }

    table tr,
    th,
    td {
        border: 1px solid #d2d2d2;
        border-collapse: collapse;
        padding: 7px 8px;
    }

    table tr th {
        background: #F4F4F4;
        font-size: 15px;
    }

    table tr td {
        font-size: 13px;
    }

    table {
        border-collapse: collapse;
    }

    .box-text p {
        line-height: 10px;
    }

    .float-left {
        float: left;
    }

    .float-center{
 float: center;
    }
    .float-right {
        float: right;
        text-align: right;
    }

    .total-part {
        font-size: 16px;
        line-height: 12px;
    }

    .total-right p {
        padding-right: 20px;
    }
</style>

<body>


    <div class="head-title">
        <h1 class="text-center m-0 p-0">Estimate</h1>
    </div>
    <div class="add-detail mt-10">
        <div class="w-50 float-right mt-10">
            <p class="m-0 pt-5 text-bold w-100">Estimate Id - <span class="gray-color">#{{ $order->id }}</span></p>
            {{-- <p class="m-0 pt-5 text-bold w-100">Order Id - <span class="gray-color">162695CDFS</span></p> --}}
            <p class="m-0 pt-5 text-bold w-100">Order Date - <span class="gray-color">{{ $order->date }}</span></p>
        </div>
        {{-- <div class="w-50 float-left logo mt-10">
        <img src="https://www.nicesnippets.com/image/imgpsh_fullsize.png"> <span>Nicesnippets.com</span>
    </div> --}}
        <div style="clear: both;"></div>
    </div>
    <div class="table-section bill-tbl w-100 mt-10">
        <table class="table w-100 mt-10">
            <tr>
                <th>{{ __('message.details') }}</th>
                <th></th>
            </tr>
            <tr>
                <td class="w-25">
                    <div class="box-text">
                        <p>{{ __('message.name') }}</p>
                        <p>{{ __('message.village_name') }}</p>
                        <p>{{ __('message.transport_no') }}</p>
                        <p>{{ __('message.gadi_no') }}</p>
                    </div>
                </td>
                <td class="w-75">
                    <div class="box-text">
                        <p>{{ $order->buyer_name }}</p>
                        <p>{{ $order->village_name }}</p>
                        <p>{{ $order->transport_name }}</p>
                        <p>{{ $order->car_no }}</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    {{-- <div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">From</th>
            <th class="w-50">To</th>
        </tr>
        <tr>
            <td>
                <div class="box-text">
                    <p>Gujarat</p>
                    <p>360004</p>
                    <p>Near Haveli Road,</p>
                    <p>Lal Darvaja,</p>
                    <p>India</p>
                    <p>Contact : 1234567890</p>
                </div>
            </td>
            <td>
                <div class="box-text">
                    <p>Rajkot</p>
                    <p>360012</p>
                    <p>Hanumanji Temple,</p>
                    <p>Lati Ploat</p>
                    <p>Gujarat</p>
                    <p>Contact : 1234567890</p>
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Payment Method</th>
            <th class="w-50">Shipping Method</th>
        </tr>
        <tr>
            <td>Cash On Delivery</td>
            <td>Free Shipping - Free Shipping</td>
        </tr>
    </table>
</div> --}}
    <div class="table-section bill-tbl w-100 mt-10">
        <table class="table w-100 mt-10">
            <tr>
                <th class="w-5">{{ __('No.') }}</th>
                <th class="w-35">{{ __('message.details') }}</th>
                <th class="w-20">{{ __('message.qty') }}</th>
                {{-- <th class="w-10">{{ __('message.price') }}</th> --}}
                <th class="w-20">{{ __('message.rate') }}</th>
                <th class="w-20">{{ __('message.mrp') }}</th>
                {{-- <th class="w-50">Total</th> --}}
            </tr>
            @php $total = 0; $totalrate = 0; $totalmrp = 0; @endphp
           {{-- {{ dd($order->products )}} --}}
            @foreach ($order->products as $key => $product)
                <tr align="center">
                    @php $total +=  $order->qty*$product->product->price;
                         $totalrate +=  $product->rate;
                         $totalmrp += $product->mrp;
                    @endphp
                    <td>{{ $key+1 }}</td>
                    <td style="text-align:left;">{{ $product->product->product_name }}</td>
                    {{-- <td>{{ $product->product->price }}</td> --}}
                    <td>{{ $product->qty }}</td>
                    <td>{{ $product->rate ? $product->rate : '-' }}</td>
                    <td>{{ $product->mrp  ? $product->mrp : '-' }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2">
                        <div class="float-right text-bold total-right p" align="right">
                            <p>{{ __('message.total') }} : </p>
                        </div>
                    </td>
                    <td>
                        <div class="float-center text-bold" align="center">
                            <p>  {{ $order->qty }}</p>
                        </div>
                    </td>
                    <td>
                        <div class="float-center text-bold" align="center">
                            <p>  {{ $totalrate }}</p>
                        </div>
                    </td>
                    <td>
                        <div class="float-center text-bold" align="center">
                            <p>{{ $totalmrp }}</p>
                        </div>
                    </td>
            </tr>
        </table>
    </div>
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function generateHTML2PDF() {
            $('#download_sec').hide();
            var element = document.getElementById('ddd');
            var opt = {
                margin:  [1, 0.2, 0.2, 0.2],
                filename: 'Estimate.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'portrait'
                }
            };

            html2pdf().set(opt).from(element).save();
            setTimeout(function() {
                window.open(window.location, '_self').close();
            }, 1000);
        }
        $(document).ready(function() {
            setTimeout(() => {
                generateHTML2PDF();
                $('#downloadpdf a').trigger('click');
            }, 500);
        });
    </script>
</body>

</html>
