<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <!--[if (gte mso 9)|(IE)]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- So that mobile will display zoomed in -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- enable media queries for windows phone 8 -->
    <meta name="format-detection" content="telephone=no"> <!-- disable auto telephone linking in iOS -->
    <meta name="format-detection" content="date=no"> <!-- disable auto date linking in iOS -->
    <meta name="format-detection" content="address=no"> <!-- disable auto address linking in iOS -->
    <meta name="format-detection" content="email=no"> <!-- disable auto email linking in iOS -->
    <meta name="author" content="Simple-Pleb.com">
    <title>{{ __('Payment Thank You Title') }} | {{ config('app.name') }}</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <style type="text/css">
        /*Basics*/
        body {
            margin: 0px !important;
            display: block !important;
            -webkit-text-size-adjust: none;
        }

        table {
            border-spacing: 0;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        table td {
            border-collapse: collapse;
            mso-line-height-rule: exactly;
        }

        td img {
            -ms-interpolation-mode: bicubic;
            width: auto;
            max-width: auto;
            height: auto;
            margin: auto;
            display: block !important;
            border: 0px;
        }

        td p {
            margin: 0;
            padding: 0;
        }

        td div {
            margin: 0;
            padding: 0;
        }

        td a {
            text-decoration: none;
            color: inherit;
        }

        /*Outlook*/
        .ExternalClass {
            width: 100%;
        }

        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
            line-height: inherit;
        }

        .ReadMsgBody {
            width: 100%;
            background-color: #ffffff;
        }

        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /*Gmail blue links*/
        u+#body a {
            color: inherit;
            text-decoration: none;
            font-size: inherit;
            font-family: inherit;
            font-weight: inherit;
            line-height: inherit;
        }

        /*Buttons fix*/
        .undoreset a,
        .undoreset a:hover {
            text-decoration: none !important;
        }

        .yshortcuts a {
            border-bottom: none !important;
        }

        .ios-footer a {
            color: #aaaaaa !important;
            text-decoration: none;
        }

        /*Responsive*/
        @media screen and (max-width: 799px) {
            table.row {
                width: 100% !important;
                max-width: 100% !important;
            }

            td.row {
                width: 100% !important;
                max-width: 100% !important;
            }

            .img-responsive img {
                width: 100% !important;
                max-width: 100% !important;
                height: auto !important;
                margin: auto;
            }

            .center-float {
                float: none !important;
                margin: auto !important;
            }

            .center-text {
                text-align: center !important;
            }

            .container-padding {
                width: 100% !important;
                padding-left: 15px !important;
                padding-right: 15px !important;
            }

            .container-padding10 {
                width: 100% !important;
                padding-left: 10px !important;
                padding-right: 10px !important;
            }

            .hide-mobile {
                display: none !important;
            }

            .menu-container {
                text-align: center !important;
            }

            .autoheight {
                height: auto !important;
            }

            .m-padding-10 {
                margin: 10px 0 !important;
            }

            .m-padding-15 {
                margin: 15px 0 !important;
            }

            .m-padding-20 {
                margin: 20px 0 !important;
            }

            .m-padding-30 {
                margin: 30px 0 !important;
            }

            .m-padding-40 {
                margin: 40px 0 !important;
            }

            .m-padding-50 {
                margin: 50px 0 !important;
            }

            .m-padding-60 {
                margin: 60px 0 !important;
            }

            .m-padding-top10 {
                margin: 30px 0 0 0 !important;
            }

            .m-padding-top15 {
                margin: 15px 0 0 0 !important;
            }

            .m-padding-top20 {
                margin: 20px 0 0 0 !important;
            }

            .m-padding-top30 {
                margin: 30px 0 0 0 !important;
            }

            .m-padding-top40 {
                margin: 40px 0 0 0 !important;
            }

            .m-padding-top50 {
                margin: 50px 0 0 0 !important;
            }

            .m-padding-top60 {
                margin: 60px 0 0 0 !important;
            }

            .m-height10 {
                font-size: 10px !important;
                line-height: 10px !important;
                height: 10px !important;
            }

            .m-height15 {
                font-size: 15px !important;
                line-height: 15px !important;
                height: 15px !important;
            }

            .m-height20 {
                font-size: 20px !important;
                line-height: 20px !important;
                height: 20px !important;
            }

            .m-height25 {
                font-size: 25px !important;
                line-height: 25px !important;
                height: 25px !important;
            }

            .m-height30 {
                font-size: 30px !important;
                line-height: 30px !important;
                height: 30px !important;
            }

            .rwd-on-mobile {
                display: inline-block !important;
                padding: 5px;
            }

            .center-on-mobile {
                text-align: center !important;
            }
        }
    </style>

</head>

<body
    style="margin-top: 0; margin-bottom: 0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;background-color:#white">

    <span class="preheader-text"
        style="color: transparent; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; visibility: hidden; width: 0; display: none; mso-hide: all;"></span>

    <div
        style="display:none; font-size:0px; line-height:0px; max-height:0px; max-width:0px; opacity:0; overflow:hidden; visibility:hidden; mso-hide:all;">
    </div>

    <table border="0" align="center" cellpadding="0" cellspacing="0" style="background-color:white;border:2px solid;" class="container-padding">
        <tr>
            <!-- Outer Table -->
            <td align="center" style="background-color:white" data-composer>

                <table border="0" align="center" cellpadding="0" cellspacing="0" role="presentation" width="100%"
                    style="width:100%;max-width:100%;">
                    <!-- lotus-header-18-->
                   
                   
                    <tr>
                        <td align="center" style="background-color:white" class="container-padding">
                            
                            <!-- Content -->
                            <table border="0" align="center" cellpadding="0" cellspacing="0" role="presentation"
                                class="row" width="580" style="width:580px;max-width:580px;">
                                
                                <tr>
                                    <td height="40" style="font-size:40px;line-height:40px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <!-- Logo & Webview -->
                                        <table border="0" align="center" cellpadding="0" cellspacing="0"
                                            role="presentation" width="100%" style="width:100%;max-width:100%;">
                                            <tr>
                                                <td align="center" class="container-padding">

                                                    <!--[if (gte mso 9)|(IE)]><table border="0" cellpadding="0" cellspacing="0" dir="rtl"><tr><td><![endif]-->



                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->

                                                    <!-- gap -->
                                                    <table border="0" align="right" cellpadding="0" cellspacing="0"
                                                        role="presentation" class="row" width="20"
                                                        style="width:20px;max-width:20px;">
                                                        <tr>
                                                            <td height="20" style="font-size:20px;line-height:20px;">
                                                                &nbsp;</td>
                                                        </tr>
                                                    </table>
                                                    <!-- gap -->

                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->

                                                    <!-- column -->
                                                    <table border="0" align="center" cellpadding="0" cellspacing="0"
                                                        role="presentation" class="row" width="280"
                                                        style="width:280px;max-width:280px;">
                                                        <tr>
                                                            <td align="center" class="center-text">
                                                                <a href="{{ url('/') }}"><img
                                                                        style="width:72px;border:0px;display: inline!important;"
                                                                        src="{{ asset('/assets/images/logo.png') }}" width="72"
                                                                        border="0"
                                                                        alt="{{ config('app.name') }}"></a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <!-- column -->

                                                    <!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->

                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="30" style="font-size:20px;line-height:20px;">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <table border="0" align="center" cellpadding="0" cellspacing="0"
                                                role="presentation" class="row" width="280"
                                                style="width:280px;max-width:280px;">
                                                <tr>
                                                    <td align="center" class="center-text" height="25" style="font-size:15px;line-height:15px;color:black;max-width:20%;"> You favorited these fragrances during your recent fragrance finder experience</td>
                                                </tr>
                                            </table>
                                                
                                            </tr>
                                        </table>
                                        <!-- Logo & Webview -->
                                    </td>
                                </tr>
                                
                                @foreach ($products as $product)
                                    <tr>
                                        <td height="40" style="font-size:40px;line-height:40px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center" class="center-text">
                                            <div style="min-width:200px;max-width:300px;text-align:bottom;vertical-align: bottom;">
                                                <a @if($product->url) href="{{ asset($product->url) }}" @endif targe="_blank" class="btn bg-white">
                                            <img style="width:190px;display: inline!important;"
                                                src="{{ asset($product->file) }}" width="190"
                                                border="1" alt="intro"></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="8" style="font-size:20px;line-height:18px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td class="center-text" align="center"
                                            style="font-family:'Roboto Slab',Arial,Helvetica,sans-serif;font-size:20px;line-height:52px;font-weight:400;font-style:normal;color:black;text-decoration:none;letter-spacing:0px;">

                                            <div>
                                                {{ $product->product_brand->name }}
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="center-text" align="center"
                                            style="font-family:'Roboto Slab',Arial,Helvetica,sans-serif;font-size:25px;line-height:40px;font-weight:400;font-style:normal;color:black;text-decoration:none;letter-spacing:0px;">

                                            <div style="padding: 0px 20px 0px 20px;">
                                                {{ $product->product_name }}
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="center-text" align="center"
                                            style="font-family:'Roboto Slab',Arial,Helvetica,sans-serif;font-size:15px;line-height:20px;font-weight:400;font-style:normal;color:black;text-decoration:none;letter-spacing:0px;">

                                            <div>
                                                {{ 'Price : ' .$product->price }}
                                            </div>

                                        </td>
                                    </tr>
                                    {{-- <tr>
                                        <td class="center-text" align="center"
                                            style="font-family:'Roboto Slab',Arial,Helvetica,sans-serif;font-size:15px;line-height:36px;font-weight:400;font-style:normal;color:black;text-decoration:none;letter-spacing:0px;">

                                            <div>
                                                {{ '(' .$product->fragrance_description. ')' }}
                                            </div>

                                        </td>
                                    </tr> --}}
                                    <tr>
                                        <td height="10" style="font-size:13px;line-height:10px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td class="center-text" align="center"
                                            style="font-family:'Poppins',Arial,Helvetica,sans-serif;font-size:13px;line-height:12px;font-weight:300;font-style:normal;color:black;text-decoration:none;letter-spacing:0px;">

                                            <div>
                                                {{ 'This fragrance belongs to the ' .$product->fragrance_tone_1->name. ' Family' }}
                                            </div>

                                        </td>
                                    </tr>
                                   
                                    {{-- <tr>
                                        <td class="center-text" align="center"
                                            style="font-family:'Poppins',Arial,Helvetica,sans-serif;font-size:16px;line-height:26px;font-weight:300;font-style:normal;color:black;text-decoration:none;letter-spacing:0px;">

                                            <div>
                                                {{ $product->fragrance_top_note }}
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="center-text" align="center"
                                            style="font-family:'Poppins',Arial,Helvetica,sans-serif;font-size:16px;line-height:26px;font-weight:300;font-style:normal;color:black;text-decoration:none;letter-spacing:0px;">

                                            <div>
                                                {{ $product->fragrance_middle_note }}
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="center-text" align="center"
                                            style="font-family:'Poppins',Arial,Helvetica,sans-serif;font-size:16px;line-height:26px;font-weight:300;font-style:normal;color:black;text-decoration:none;letter-spacing:0px;">

                                            <div>
                                                {{ $product->fragrance_base_note }}
                                            </div>

                                        </td>
                                    </tr>--}}
                                    <tr>
                                        <td height="10" style="font-size:13px;line-height:10px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td class="center-text" align="center"
                                        style="font-style:normal;color:white;text-decoration:none;letter-spacing:0px;line-height:30px;">

                                        <div style="font-size: 15px;color:white;height: 30px;background-color: black;width: 90px;text-decoration:none;">
                                            <a @if($product->url) href="{{ asset($product->url) }}" @endif  target="_blank" class="btn bg-white" style="color:white;">EXPLORE</a>
                                        </div>

                                    </td>
                                    </tr> 
                                @endforeach
                                <tr>
                                    <td height="10" style="font-size:13px;line-height:10px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="center-text" align="center"
                                        style="font-family:'Roboto Slab',Arial,Helvetica,sans-serif;font-size:15px;line-height:36px;font-weight:400;font-style:normal;color:black;text-decoration:none;letter-spacing:0px;">

                                        
                                    </td>
                                </tr>
                            </table>
                            <!-- Content -->

                        </td>
                    </tr>
                    <tr>
                        <td height="40" style="font-size:40px;line-height:40px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td height="5" style="font-size:10px;line-height:5px;background-color:gray;">&nbsp;</td>
                    </tr>
                </table>
                <table border="0" align="center" cellpadding="0" cellspacing="0" role="presentation"
                    width="100%" style="width:100%;max-width:100%;background-color:white;color:black;padding-left:25px;padding-right:25px;">
                    <!-- lotus-footer-18 -->
                    <tr>
                        <td height="15" style="font-size:30px;line-height:15px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="center-text" class="container-padding">
                            <table border="0" cellpadding="1" cellspacing="0" role="presentation" width="100%"
                            style="width:100%;max-width:100%;">
                                <tr class="text-center center-text">
                                    <td class="rwd-on-mobile" align="center" valign="middle" height="20" style="font-size:15px;line-height:20px;text-align:center;width: 30%;">FRAGRANCE</td>
                                    <td class="rwd-on-mobile" align="center" valign="middle" height="20" style="font-size:15px;line-height:20px;text-align:center;width: 30%;">MAKEUP</td>
                                    <td class="rwd-on-mobile" align="center" valign="middle" height="20" style="font-size:15px;line-height:20px;text-align:center;width: 30%;">SKINCARE</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" class="container-padding" style="background-color:white;">

                            <!-- Content -->
                            <table border="0" align="center" cellpadding="0" cellspacing="0"
                                role="presentation" class="row" width="580"
                                style="width:580px;max-width:580px;">
                                <tr>
                                    <td height="20" style="font-size:30px;line-height:15px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <!-- Social Icons -->
                                        <table border="0" align="center" cellpadding="0" cellspacing="0"
                                            role="presentation" width="100%" style="width:100%;max-width:100%;">
                                            <tr>
                                                <td align="center">
                                                    <table border="0" align="center" cellpadding="0"
                                                        cellspacing="0" role="presentation">
                                                        <tr>
                                                            <td class="rwd-on-mobile" align="center" valign="middle"
                                                                height="36" style="height: 36px;">
                                                                    <table border="0" align="center"
                                                                        cellpadding="0" cellspacing="0"
                                                                        role="presentation">
                                                                        <tr>
                                                                            <td width="10"></td>
                                                                            <td align="center">
                                                                                <a
                                                                                    href="{{ config('facebook_url') }}"><img
                                                                                        style="width:36px;border:0px;display: inline!important;background-color:white;"
                                                                                        src="{{ asset('/images/email/Facebook.png') }}"
                                                                                        width="36" border="0"
                                                                                        alt="icon"></a>
                                                                            </td>
                                                                            <td width="10"></td>
                                                                        </tr>
                                                                    </table>
                                                            </td>
                                                            <td class="rwd-on-mobile" align="center" valign="middle"
                                                                height="36" style="height: 36px;">
                                                                    <table border="0" align="center"
                                                                        cellpadding="0" cellspacing="0"
                                                                        role="presentation">
                                                                        <tr>
                                                                            <td width="10"></td>
                                                                            <td align="center">
                                                                                <a
                                                                                    href="{{ config('instagram_url') }}"><img
                                                                                        style="width:36px;border:0px;display: inline!important;background-color:white;"
                                                                                        src="{{ asset('/images/email/Instagram.png') }}"
                                                                                        width="36" border="0"
                                                                                        alt="icon"></a>
                                                                            </td>
                                                                            <td width="10"></td>
                                                                        </tr>
                                                                    </table>
                                                            </td>
                                                            <td class="rwd-on-mobile" align="center" valign="middle"
                                                                height="36" style="height: 36px;">
                                                                    <table border="0" align="center"
                                                                        cellpadding="0" cellspacing="0"
                                                                        role="presentation">
                                                                        <tr>
                                                                            <td width="10"></td>
                                                                            <td align="center">
                                                                                <a href="{{ config('twitter_url') }}"><img
                                                                                        style="width:36px;border:0px;display: inline!important;background-color:white;"
                                                                                        src="{{ asset('/images/email/Twitter.png') }}"
                                                                                        width="36" border="0"
                                                                                        alt="icon" ></a>
                                                                            </td>
                                                                            <td width="10"></td>
                                                                        </tr>
                                                                    </table>
                                                            </td>
                                                            <td class="rwd-on-mobile" align="center" valign="middle"
                                                                height="36" style="height: 36px;">
                                                                    <table border="0" align="center"
                                                                        cellpadding="0" cellspacing="0"
                                                                        role="presentation">
                                                                        <tr>
                                                                            <td width="10"></td>
                                                                            <td align="center">
                                                                                <a
                                                                                    href="{{ config('pinterest_url') }}"><img
                                                                                        style="width:36px;border:0px;display: inline!important;background-color:white;"
                                                                                        src="{{ asset('/images/email/Pinterest.png') }}"
                                                                                        width="36" border="0"
                                                                                        alt="icon"></a>
                                                                            </td>
                                                                            <td width="10"></td>
                                                                        </tr>
                                                                    </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <!-- Social Icons -->
                                    </td>
                                </tr>
                                <tr>
                                    <td height="30" style="font-size:30px;line-height:30px;">&nbsp;</td>
                                </tr>
                               
                                <tr>
                                    <td align="center" class="center-text" style="font-size:12px;line-height:13px;padding-left:20px;padding-right:20px;">
                                        <p style="text-align: center;">
                                        Chanel protects the personal data and privacy of its members, in compliance with the most
                                        stningent European and French regulation applied in this area. All processing personal data performed 
                                        within this the scopeof the chanel emailing program has been lawtully notified to the French Data protection Authority (CNIL),
                                        Filled under number 1097571.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="50" style="font-size:50px;line-height:50px;">&nbsp;</td>
                                </tr>
                            </table>
                            <!-- Content -->

                        </td>
                    </tr>
                </table>

            </td>
        </tr><!-- Outer-Table -->
    </table>

</body>

</html>
