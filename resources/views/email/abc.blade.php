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
    <title>{{ __('Welcome Title') }} | {{ config('app.name') }}</title>

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
            padding: 20px !important;
            display: block !important;
            min-width: 100% !important;
            width: 100% !important;
            -webkit-text-size-adjust: none;
        }
        p{
            /* text-indent: 50px; */
            padding-left:5em;
        }
        .space{
            padding-left:2px;
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
    style="margin-top: 0; margin-bottom: 0; padding-top: 0; padding-bottom: 0; width: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;"
    bgcolor="#f0f0f0">

    <span class="preheader-text"
        style="color: transparent; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; visibility: hidden; width: 0; display: none; mso-hide: all;"></span>

    <div
        style="display:none; font-size:0px; line-height:0px; max-height:0px; max-width:0px; opacity:0; overflow:hidden; visibility:hidden; mso-hide:all;">
    </div>

    <table border="0" align="center" cellpadding="0" cellspacing="0" width="100%"
        style="width:100%;max-width:100%;">
        <tr>
            <td height="10" style="font-size:10px;line-height:10px;">&nbsp;</td>
        </tr>
        <tr>
            <!-- Outer Table -->
            <td align="center" bgcolor="#f0f0f0" data-composer>

                <table border="0" align="center" cellpadding="0" cellspacing="0" role="presentation" width="100%"
                    style="width: 80%;max-width: 90%;">
                    <!-- lotus-header-1 -->
                    <tr>
                        <td align="center" bgcolor="white" class="container-padding">

                            <!-- Content -->
                            <table border="0" align="center" cellpadding="0" cellspacing="0" role="presentation"
                                class="row" width="580" style="width: 70%;max-width: 70%;">
                                <tr>
                                    <td><div class=""><img style="width:100%;display: inline!important;"
                                        src="{{ asset('/images/email/email_Unilever.png') }}" width="100%"
                                        border="1" alt="intro"></td>
                            </table>
                            <!-- Content -->

                        </td>
                    </tr>
                    <tr>
                        <td align="center" bgcolor="#FFFFFF" class="container-padding">

                            <!-- Content -->
                            <table border="0" align="center" cellpadding="0" cellspacing="0"
                                role="presentation" class="row" width="580"
                                style="width:580px;max-width:580px;">
                                <tr>
                                    <td height="50" style="font-size:50px;line-height:50px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="center-text" align="center"
                                        style="font-family:'Roboto Slab',Arial,Helvetica,sans-serif;font-size:25px;line-height:30px;font-weight:400;font-style:normal;color:#282828;text-decoration:none;letter-spacing:0px;">

                                        <div>
                                            {{ 'ONE MORE DAY to UniCon 2022!' }}
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td height="30" style="font-size:30px;line-height:30px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <!-- 2-columns -->
                                        <table border="0" align="center" cellpadding="0" cellspacing="0"
                                            role="presentation" width="100%" style="width:100%;max-width:100%;">
                                            <tr>
                                                <td align="center">

                                                    <!--[if (gte mso 9)|(IE)]><table border="0" cellpadding="0" cellspacing="0"><tr><td><![endif]-->

                                                    <!-- column -->
                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->

                                                    <!-- gap -->
                                                    <table border="0" align="left" cellpadding="0"
                                                        cellspacing="0" role="presentation" class="row"
                                                        width="30" style="width:30px;max-width:30px;">
                                                        <tr>
                                                            <td height="20"
                                                                style="font-size:20px;line-height:20px;"></td>
                                                        </tr>
                                                    </table>
                                                    <!-- gap -->

                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->

                                                    <!-- column -->
                                                    <table border="0" align="left" cellpadding="0"
                                                        cellspacing="0" role="presentation" class="row"
                                                        width="800" style="width:800px;max-width:800px;">
                                                        <tr>
                                                            <td height="5" style="font-size:5px;line-height:5px;">
                                                                &nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="center-text container-padding" align="left"
                                                                style="font-family:'Poppins',Arial,Helvetica,sans-serif;font-size:14px;line-height:24px;font-weight:400;font-style:normal;color:#6e6e6e;text-decoration:none;letter-spacing:0px;">

                                                                <div>
                                                                    <p class="space">Dear [Name of Participant],</p>

                                                                        <p class="space">The long-awaited UniCon 2022 is finally here! Whether you’ve decided to attend online, in person (or both!), you can expect two days of inspiring, engaging and thoughtfully curated networking opportunities and keynotes to kickstart your global career journey with us!</p>
                                                                        
                                                                        <p class="space">Mark your calendars so you don’t miss out on any of the <b>exciting keynotes</b> and our <b>first-ever networking event</b> as we gather the best-in-class leaders and hiring managers in Unilever!</p>
                                                                        
                                                                        <p class="space"><b>Login to www.unicon-22.com tomorrow, 8 Sept 2022. The full event schedule is available on the website. <b></p>

                                                                        <p class="space">If you have registered for the in-person campus tours, do head down to our Unilever Campus @ one-north on your selected date (8 or 9 Sept) and share your experience by tagging us on Instagram (@unileversgcareers) or LinkedIn (@unilever) with the hashtags #unicon2022 or #uniquelyunilever.</p>
                                                                        
                                                                        <p class="space">P.S. Head over to bit.ly/ULCareersSG to find out more about our career opportunities. </p>

                                                                        <p class="space"><b>Making your way to our Unilever Campus @ one-north and what to expect:</b></p>

                                                                        <p class="space">As the event will commence at 6:00pm sharp, please arrive 30 mins earlier to ensure a smooth check-in process. Upon arrival, you will be expected to scan a QR code to fill in check-in details and watch a short safety briefing video, before being guided into the campus by one of our volunteers. Kindly note that only fully vaccinated individuals will be allowed to enter the campus.
                                                                        <p class="space">Address: 18 Nepal Park, Singapore 139407</p>

                                                                        <p class="space">Parking: There are no parking spaces available at the Unilever Campus @ one-north, the nearest </p><p class="space">parking spaces are at:</p>
                                                                        <ul>
                                                                            <li>Fusionopolis (Hourly)</li>
                                                                            <li>Biopolis (Hourly)</li>
                                                                            <li>Galaxis (Hourly & Season)</li>
                                                                        </ul>
                                                                        
                                                                        <p class="space">If you are taking a Grab/Gojek/taxi, you can alight inside the Unilever Campus @ one-north lobby.</p>
                                                                        <p class="space">Nearest MRT stations:</p>
                                                                        
                                                                            <ul>
                                                                            <li>CC23 one-north (Circle Line)</li>
                                                                            <li>EW21/CC22 Buona Vista (East-West Line & Circle Line)</li>
                                                                            </ul>

                                                                        <p class="space">Bus services: 14, 74, 91, 92, 95, 191, 196, 198, 200</p>

                                                                        <p class="space text-center center-text" align="center" style="display: inline-flex;">See you at UniCon! &nbsp; 😎</p>
                                                                        {{-- <p class="space text-center center-text">See you at UniCon! 😎</p> --}}

                                                                </div>

                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <!-- column -->

                                                    <!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->

                                                </td>
                                            </tr>
                                        </table>
                                        <!-- 2-columns -->
                                    </td>
                                </tr>
                                <tr>
                                    <td height="15" style="font-size:15px;line-height:15px;">&nbsp;</td>
                                </tr>
                            </table>
                            <!-- Content -->

                        </td>
                    </tr>
                </table>
            </td>
        </tr><!-- Outer-Table -->
        <tr>
            <td height="10" style="font-size:10px;line-height:10px;">&nbsp;</td>
        </tr>
    </table>

</body>

</html>
