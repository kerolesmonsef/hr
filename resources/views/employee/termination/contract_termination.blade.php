@php
    header('Access-Control-Allow-Origin: *');
    $logo=asset(Storage::url('uploads/logo/'));
    $company_logo=Utility::getValByName('company_logo');
    $profile=asset(Storage::url('uploads/avatar/'));
@endphp

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Latest compiled and minified CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

        <title> {{__('Salary Receipt')}} </title>
    </head>

    <style>
        * {
            padding: 0px;
            margin: 0px;
        }

        body {
            background: #ccc;
        }
        .ar{
            direction:rtl;
        }

        tfoot {
            font-size:20px;
        }

        .logo_img svg{
            width:100px;
            height:100px;
        }
        .order_ {
            font-family: Arial, Helvetica, sans-serif;
            background: #fff;
            width: 600px;
            margin: auto;
            padding: 5px;
            font-size: 14px;
        }

        @media print {
          .order_ {
               height:auto;
              page-break-inside: avoid}
        }


        .orderItems {
            justify-content: space-between;
            align-items: center;
            margin: 13px 0px;
            padding:1%;
        }

        table, th, td {
        border:1px solid black;
        }

        .logo {
            align-items: center;
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #f7f7f7;
        }

        .logo h1 {
            margin-bottom: 10px;
        }

        #scissors {
            height: 43px;
            width: 100%;
            margin: auto auto;
            background-image: url('http://i.stack.imgur.com/cXciH.png');
            background-size: 5% 40%;
            background-repeat: no-repeat;
            background-position: right;
            position: relative;
        }
        #scissors div {
            position: relative;
            top: 50%;
            border-top: 3px dashed black;
            margin-top: -3px;
        }

        .ForderItems {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .order_total {
            display: flex;
            justify-content: space-between;
        }

        .Receivedby {

            padding-bottom: 17px;
            width: 144px;
            text-align: center;
        }

        .date_logo {
            display: flex;
            flex-direction: column;
        }

        .date_logo span:last-child {
            margin-top: 7px;
        }

        .scissor {

            margin: 16px 0px;
        }

        .scissor img {
            width: 100%;
            height: 14px;
        }
    </style>



    <body>
        <div @if(env('SITE_RTL') == 'on' || app()->getLocale() == "ar") class="ar" @endif id="printableArea">

                <div class="order_">
                    <div class="logo">
                        <div class="logo_img">
                            <img style="width: 100px;" src="{{ auth()->user()->avatar ? $profile.'/'.auth()->user()->avatar : $profile.'/avatar.png'}}" />
                        </div>

                        <div>
                            <h4>{{ __("TerminationReciept.Liquidation of the end of an employee's contract") }}</h4>
                            <div class="date" style="text-align: center;">سبتمبر / <strong>2022</strong></div>
                        </div>

                        <div class="date_logo">
                            <span>{{date("Y/m/d")}}</span>
                            <span>{{date("H:i:s")}}</span>
                            <span> {{__('TerminationReciept.Created By')}}  {{auth()->user()->name}} </span>
                        </div>
                    </div>

                    <div class="front">

                        <div class="orderItems_">
                            <div class="orderItems">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="order_item">
                                            <strong>{{__('TerminationReciept.Employee')}} : </strong>
                                            <span>saad nabil</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="order_item">
                                            <strong>{{__('TerminationReciept.Position')}} : </strong>
                                            <span>مطور برامج</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="order_item">
                                            <strong>{{__('TerminationReciept.Branch')}} : </strong>
                                            <span>فرع العباسية</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="order_item">
                                            <strong>{{__('TerminationReciept.Department')}} : </strong>
                                            <span>قسم التخطيط</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <table style="width:100%" class="table table-responsive table-bordered-y table-bordered-x">
                            <tr class="table-active">
                                <th>{{ __('TerminationReciept.Filter date') }}</th>
                                <th>{{ __('TerminationReciept.Nationality') }}</th>
                                <th>{{ __('TerminationReciept.Residency number') }}</th>
                                <th> {{ __('TerminationReciept.Employee') }}</th>
                                <th>{{ __('TerminationReciept.Employee code') }}</th>
                            </tr>
                            <tr>
                                <td>ssdsd</td>
                                <td>dsdsd</td>
                                <td>sdsdsd</td>
                                <td>dsdsd</td>
                                <td>sdsdsd</td>
                            </tr>
                            <tr class="table-active">
                                <th>{{ __('TerminationReciept.Date of hiring') }}</th>
                                <th>{{ __('TerminationReciept.Branch') }}</th>
                                <th>{{ __('TerminationReciept.Administration') }} </th>
                                <th> {{ __('TerminationReciept.Job title') }}</th>
                                <th>{{ __('TerminationReciept.Last filter date') }}</th>
                            </tr>
                            <tr>
                                <td>ssdsd</td>
                                <td>dsdsd</td>
                                <td>sdsdsd</td>
                                <td>dsdsd</td>
                                <td>sdsdsd</td>
                            </tr>
                        </table>

                        <table style="width:100%" class="table table-responsive table-bordered-y table-bordered-x">
                            <tr class="table-active">
                                <th>{{ __('TerminationReciept.Due date') }}</th>
                                <th>{{ __('TerminationReciept.Total accrual') }}</th>
                                <th>{{ __('TerminationReciept.Total deductions') }}</th>
                                <th>{{ __('TerminationReciept.Net salary') }}</th>
                                <th>{{ __('TerminationReciept.The remaining balance') }}</th>
                            </tr>
                            <tr>
                                <td>ssdsd</td>
                                <td>dsdsd</td>
                                <td>sdsdsd</td>
                                <td>dsdsd</td>
                                <td>sdsdsd</td>
                            </tr>
                            <tr>
                                <td>ssdsd</td>
                                <td>dsdsd</td>
                                <td>sdsdsd</td>
                                <td>dsdsd</td>
                                <td>sdsdsd</td>
                            </tr>
                            <tr>
                                <td>ssdsd</td>
                                <td>dsdsd</td>
                                <td>sdsdsd</td>
                                <td>dsdsd</td>
                                <td>sdsdsd</td>
                            </tr>
                            <tr>
                                <td>ssdsd</td>
                                <td>dsdsd</td>
                                <td>sdsdsd</td>
                                <td>dsdsd</td>
                                <td>sdsdsd</td>
                            </tr>
                            <tr class="table-active">
                                <td colspan="2">{{ __('TerminationReciept.Total salary') }}</td>
                                <td colspan="3"> 20,2665</td>
                            </tr>
                            <tr>
                                <td colspan="2">{{ __('TerminationReciept.Number of vacation days') }}</td>
                                <td colspan="3"> 20,2665</td>
                            </tr>
                            <tr class="table-active">
                                <td colspan="2"> {{ __('TerminationReciept.Leave settlement balance') }}</td>
                                <td colspan="3"> 20,2665</td>
                            </tr >
                            <tr class="table-active">
                                <td colspan="2">{{ __('TerminationReciept.Total Advance Balance') }}</td>
                                <td colspan="3"> 20,2665</td>
                            </tr>
                            <tr>
                                <td colspan="2"> {{ __('TerminationReciept.Duration of service in days') }}</td>
                                <td colspan="3"> 20,2665</td>
                            </tr>
                            <tr class="table-active">
                                <td colspan="2">{{ __('TerminationReciept.Indemnity') }}</td>
                                <td colspan="3"> 20,2665</td>
                            </tr>
                            <tr style="background: #777;color:#fff;">
                                <td colspan="2">{{ __('TerminationReciept.Net end of service liquidation') }}</td>
                                <td colspan="3"> 515056</td>
                            </tr>

                        </table>

                        <div class="row">
                            <div class="col-4">
                                <div class="Receivedby">
                                    <strong>{{ __('TerminationReciept.The accountant') }}</strong>
                                    <p>-----------------------</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="Receivedby">
                                    <strong>{{ __('TerminationReciept.The accounts') }}</strong>
                                    <p>-----------------------</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="Receivedby">
                                    <strong>{{ __('TerminationReciept.Chief Financial Officer') }}</strong>
                                    <p>-----------------------</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div style="margin-top:15px">
                                    <strong> {{ __('TerminationReciept.I, the undersigned, have received all my entitlements, including salaries, leave balance, end-of-service gratuity, etc., for the above-mentioned period. Therefore, the company has released its responsibility for any other claims.') }} </strong>
                                </div>
                                <div class="Receivedby" style="margin-top:15px;">
                                    <strong> {{ __('TerminationReciept.Employee signature') }}</strong>
                                    <p>-----------------------</p>
                                </div>

                            </div>
                        </div>

                        {{--  <div class="ForderItems">
                            <div class="Forder_item">
                                <span>
                                    @if(env('SITE_RTL') == 'on' || app()->getLocale() == "ar")
                                        sdl;sld;sld;
                                    @else
                                        dsldlskdlskd
                                    @endif
                                </span>
                            </div>

                            <div class="Receivedby">
                                <strong>{{__('Received By')}}</strong>
                                <p>-----------------------</p>
                            </div>
                        </div>  --}}
                    </div>

                    {{--  <div id="scissors">
                        <div></div>
                    </div>  --}}
                </div>
        </div>

        <script type="text/javascript" src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>


    </body>
</html>

