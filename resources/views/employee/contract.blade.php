<!DOCTYPE html>
<html >
    <head>

    </head>
    <body>
        <div title="header">


            <p dir="rtl"><img src="https://manager.mwardi.com/storage/uploads/logo/22_logo.png" style="float:left; height:115px; width:196px" /></p>

            <p dir="rtl" style="text-align:center">&nbsp;</p>

            <p dir="rtl" style="text-align:center">&nbsp;</p>

            <p dir="rtl" style="text-align:center">&nbsp;</p>
            <br />
            <p dir="rtl" style="text-align:center"><span style="font-family:Calibri"><u><span style="font-family:Changa"><span style="font-size:x-large">عقـــــــــــد عمـــــــــــــــل </span></span></u></span><br />
            <u><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:x-large">محدد المدة</span></span></span></u></p>
            </div>
            @php
                $month_arr = [
                    "Jan" => "يناير",
                    "Feb" => "فبراير",
                    "Mar" => "مارس",
                    "Apr" => "أبريل",
                    "May" => "مايو",
                    "Jun" => "يونيو",
                    "Jul" => "يوليو",
                    "Aug" => "أغسطس",
                    "Sep" => "سبتمبر",
                    "Oct" => "أكتوبر",
                    "Nov" => "نوفمبر",
                    "Dec" => "ديسمبر"
                ];
                $days_arr = [
                    "Saturday" => "السبت",
                    "Sunday" => "الاحد",
                    "Monday" => "الاثنين",
                    "Tuesday" => "الثلاثاء",
                    "Wednesday" => "الاربعاء",
                    "Thursday" => "الخميس",
                    "Friday" => "الجمعه",

                ];
            @endphp
            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">انه في يوم </span></span><span style="font-family:Changa"><span style="font-size:medium">{{ $days_arr[Carbon\Carbon::now()->format('l')]}} </span></span><span style="font-family:Changa"><span style="font-size:medium">الموافق </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium"><strong>{{ Carbon\Carbon::now()->format('d / m / Y') }} </strong></span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">م</span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium"><strong>.</strong></span></span></p>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">تم الاتفاق والتراضي و تحرر هذا العقد بين كلا من</span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">:</span></span></p>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="color:#ff0000"><u><span style="font-family:Changa"><span style="font-size:medium">أولاً</span></span></u></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">: </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">شركة </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">/ </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium"> {{ $company_settings['company_name'] }} </span></span></span><span style="font-family:Changa,serif"></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">شركة ذات مسؤولية محدودة </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">- </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">و مقرها القانونى </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">17 </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium"> {{ $company_settings['company_address'] }} - {{ $company_settings['company_city'] }}</span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">-</span></span><span style="font-family:Calibri"><span style="font-family:Changa"></span></span><span style="font-family:Changa,serif"><span style="font-size:medium"> - </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium"> سجل تجارى رقم </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">: 168053</span></span><br />
            <span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">ويمثلها فى هذا العقد السيد </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">/ </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">     أحمد عادل إبراهيم عبد الوهاب </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">- </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium"> مصري الجنسيه </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">- </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">بصفته </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">/ </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">  مدير اداري</span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">.<br />
            (</span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">الطرف الأول</span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">)</span></span></p>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="color:#ff0000"><u><span style="font-family:Changa"><span style="font-size:medium">ثانياً </span></span></u></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">: </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">السيد </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">/ </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium"> {{ $employee->name_ar }}</span></span></span><br />
            <span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">ومحل إقامة </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">: </span></span><span style="font-family:Changa,serif"><span style="font-size:medium"><strong> {{ $employee->address }} </strong></span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium"> {{ $employee->street_name }}</span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium"><strong>- </strong></span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium"> {{ $employee->region }} </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium"><strong>- </strong></span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">{{ $employee->city }} </span></span></span><br />
            <span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">رقم قومى </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">: </span></span><span style="font-family:Changa,serif"><span style="font-size:medium"><strong>{{ $employee->residence_number }}</strong></span></span><br />
            <span style="font-family:Changa,serif"><span style="font-size:medium">(</span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">الطرف الثانى</span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">)</span></span></p>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><u><span style="font-family:Changa"><span style="font-size:medium">أتفق الطرفان على هذا العقد وفقا للأحكام والشروط التالية</span></span></u></span><u><span style="font-family:Changa,serif"><span style="font-size:medium"><strong>:</strong></span></span></u></p>

            <table align="right" cellpadding="0" cellspacing="0" dir="rtl" style="width:100%">
                <tbody>
                    <tr>
                        <td style="background-color:#f3f3f3">
                        <p style="margin-right:-0.06in; text-align:center"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:large">البند الاول</span></span></span></p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">تعين الشركة الموظف بموجب هذا العقد بوظيفة </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">( </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:m edium">
                  {{ $employee->jobtitle ? $employee->jobtitle->name_ar : '' }} 
                  </span></span><span style="font-family:Changa"><span style="font-size:medium"> </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">) </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">ويقبل الموظف </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">(</span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">الطرف الثانى</span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">) </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">هذا التعيين طبقا للشروط الواردة فى العقد وأن يكرس كل وقته لخدمة الشركة ويتم تحديد مسئوليات وواجبات تلك الوظيفة بمعرفة إدارة الشركة بما يتفق والغرض من الوظيفة عند بدء التعيين </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">- </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">كما يقر الموظف بموافقته على اى تغيير تتطلبه طبيعة الوظيفة وتقره إدارة الشركة ويجب على الموظف أن يؤدي واجبات وظيفته بكل إخلاص وأن يتقيد بالتوجيهات والتعليمات الصادرة اليه من الشركة وعلى الموظف أن يخصص كل جهوده وخبراته لصالح الشركة </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">.</span></span></p>

            <p dir="rtl" style="margin-right:-0.06in"><br />
            &nbsp;</p>

            <p dir="rtl" style="margin-right:-0.06in"><br />
            &nbsp;</p>

            <table cellpadding="0" cellspacing="0" dir="rtl" style="width:100%">
                <tbody>
                    <tr>
                        <td style="background-color:#f3f3f3">
                        <p style="margin-right:-0.06in; text-align:center"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:large">البند الثانى</span></span></span></p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">يعين الموظف للعمل مبدئيا بمدينة القاهرة ويكون من حق الشركة أن تنقل الموظف الى اى مكان داخل مصر أو خارجها طبقا لمتطلبات عملها على أن تتحمل الشركة النفقات الضرورية والمناسبة لنقل الموظف وذلك كله طبقا لأحكام قانون العمل المصرى وسياسة الشركة فى هذا الشأن </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">.</span></span></p>

            <table cellpadding="0" cellspacing="0" dir="rtl" style="width:100%">
                <tbody>
                    <tr>
                        <td style="background-color:#f3f3f3">
                        <p style="margin-right:-0.06in; text-align:center"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:large">البند الثالث</span></span></span></p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">أ </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">- </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">مقابل الأداء المرضى للواجبات والمسئوليات التى يقدمها الموظف طبقا لهذا العقد تدفع الشركة للموظف راتبا شهريا اجماليا وقدره </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">(</span></span><span style="font-family:Changa,serif"><span style="font-size:medium"><strong> {{ $employee->salary }} - </strong></span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">
                <script> MoneyToWords( {{  abs( $employee->salary ) }} ) </script> </span></span><span style="font-family:Changa"><span style="font-size:medium"> <script> MoneyToWords( {{  abs( $employee->salary ) }} ) </script>     {{ $arabiSalary }} </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">) </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">نقدا أو بشيكات لأمره ويتم الدفع فى مكان العمل خلال العشرة أيام الأولى من الشهر التالى المستحق عنه الراتب ويقر الموظف بأن راتبه الشهرى يشمل اجرة عن كل ايام الشهر بما فيها أيام الراحة الأسبوعية ، يتعهد الموظف ويوافق على أن قيمة الراتب الشهري شامل </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">(</span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">اساسي وبدلات ومكافآت وخلافه</span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">) </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">وتعد من أسرار العمل التي لا يجوز أن يبوح بها للعاملين الآخرين او للغير مع علمه أن مخالفة هذا الحكم يعتبر إخلال بنظام الشركة وسياستها مما قد يعرضه للجزاء وفقا للقواعد المتبعة من قبل الشركة في هذا الشأن</span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">.</span></span></p>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">ب</span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">- </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">يتضمن أجر الموظف الشامل جميع العلاوات المقررة قانونا وحسب آخر التعديلات بما فى ذلك علاوة المعيشة محسوبة على أساس أقصى النسب المحددة قانونا </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">.</span></span></p>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">جـ </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">- </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">لا يستحق الموظف في أي حال تعويض آخر أو أجر عن أي عمل إضافي يقوم به ما لم يكن العمل الإضافي أو الأجر الخاص به مصرحا به كتابة وبشكل مسبق من جانب الشركة</span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">.</span></span></p>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">د </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">- </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">تستقطع من الأجر و أى ملحقات له كل المبالغ التى يقتضى القانون واللوائح والنظم المعمول بها لدى صاحب العمل خصمها كالضرائب و حصة التأمينات الاجتماعية وغير ذلك من الالتزامات المقررة على العامل </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">.</span></span></p>

            <table cellpadding="0" cellspacing="0" dir="rtl" style="width:100%">
                <tbody>
                    <tr>
                        <td style="background-color:#f3f3f3">
                        <p style="margin-right:-0.06in; text-align:center"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:large">البند الرابع</span></span></span></p>
                        </td>
                    </tr>
                </tbody>
            </table>
            @php
                $contract = App\Models\EmployeeContracts::where('employee_id' , $employee->id)->first();
                $duration = 0;
                if($contract != null){
                    $start_date = Carbon\Carbon::parse($contract->contract_startdate);
                    $end_date = Carbon\Carbon::parse($contract->contract_enddate);
                    $duration = $start_date->diffInMonths($end_date);
                }
            @endphp
            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">مدة هذا العقد هى  {{ $duration }}شهرا  تبدأ من</span></span><span style="font-family:Changa"><span style="font-size:medium"> </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium"><strong> {{ $contract != null ?  Carbon\Carbon::createFromFormat('Y-m-d',$contract->contract_startdate)->format('Y/m/d') : ''  }} </strong></span></span><span style="font-family:Changa,serif"><span style="font-size:medium"> </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">وتنتهى فى </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium"><strong>  {{ $contract != null ? Carbon\Carbon::createFromFormat('Y-m-d',$contract->contract_enddate)->format('Y/m/d') : ''  }} </strong></span></span><br />
            <span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">على أن يتجدد هذا العقد لمدد اخرى ما لم يخطر أحد الطرفين كتابيا برغبته فى عدم التجديد </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">.</span></span><br />
            <br />
            &nbsp;</p>

            <p dir="rtl" style="margin-right:-0.06in"><br />
            &nbsp;</p>

            <table cellpadding="0" cellspacing="0" dir="rtl" style="width:100%">
                <tbody>
                    <tr>
                        <td style="background-color:#f3f3f3">
                        <p style="margin-right:-0.06in; text-align:center"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:large">البند الخامس</span></span></span></p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">من المتفق عليه أن الموظف يخضع لكافة القواعد والنظم الحكومية التى تحكم العمل فى الشركة سواء كان فى قانون العمل أو لوائح الشركة </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">- </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">وفى حالة الغياب الغير مصرح به يتم الخصم من مرتب الموظف بما يعادل أجره عن كل يوم يستمر فيه هذا الغياب غير المصرح به مع عدم الإخلال بأحقية الشركة في توقيع الجزاء المناسب للغياب بدون إذن طبقا للائحة الجزاءات الخاصة بالشركة ويتم حساب الأجر اليومى بقسمة الراتب الأساسى الشهرى على ثلاثين يوم</span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">.</span></span><br />
            <span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">على الطرف الثانى مراعاة إتباع التعليمات والتوجيهات التي تصدر إليه من الطرف الأول الشفوية والمكتوبة ولوائح ونظم العمل كما يتعهد بالخضوع لنظم الجزاءات المقررة فى القانون والسائدة فى المنشأة كما يقر بأنه إطلع على لائحة العمل الداخلية ونظم الجزاءات الخاصة بالشركة</span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">.</span></span></p>

            <table cellpadding="0" cellspacing="0" dir="rtl" style="width:100%">
                <tbody>
                    <tr>
                        <td style="background-color:#f3f3f3">
                        <p style="margin-right:-0.06in; text-align:center"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:large">البند السادس</span></span></span></p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">يوافق الموظف أن يعرض نفسه لفحص طبي وأن يأخذ التطعيم واللقاحات إذا لزم ذلك طبقا لانظمة جمهورية مصر العربيه او اذا طلبت الشركة ذلك حسبما تقتضيه طبيعة العمل </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">.</span></span></p>

            <table cellpadding="0" cellspacing="0" dir="rtl" style="width:100%">
                <tbody>
                    <tr>
                        <td style="background-color:#f3f3f3">
                        <p style="margin-right:-0.06in; text-align:center"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:large">البند السابع</span></span></span></p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">يحق للشركة إنهاء خدمة الموظف دون استحقاق مكافأة أو تعويض اعمالا لنص المادة </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">( 69 ) </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">من القانون رقم </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">( 12 ) </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">لسنة </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">2003 </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">وذلك فى الحالات المنصوص عليها بهذه المادة</span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">.</span></span></p>

            <table cellpadding="0" cellspacing="0" dir="rtl" style="width:100%">
                <tbody>
                    <tr>
                        <td style="background-color:#f3f3f3">
                        <p style="margin-right:-0.06in; text-align:center"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:large">البند الثامن</span></span></span></p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">عند إنهاء او انتهاء هذا العقد يجب على الموظف كشرط مسبق لاستلام أية مبالغ مستحقة له أن يعيد كافة الاوراق و المستندات و الأموال والأدوات واى ممتلكات أخرى تخص الشركة الموجودة في عهدته أو حوزته و أن يوقع على مخالصة تامة نهائيه يقر بموجبها بعدم وجود اى مستحقات أخرى له لدى الشركة ولا تمنح الشركة اخلاء طرف نهائى للموظف الا بعد اعادة المهمات والمستندات التى فى حوزته والتوقيع على المخالصة النهائية</span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">.</span></span><br />
            <span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">فى حالة رغبة الطرف الثانى فى تقديم إستقالته من العمل لدى الطرف الأول فإنه يلتزم بإخطار الطرف الاول كتابياً قبل سريان الاستقالة بمدة شهر على الأقل </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">.</span></span><br />
            <span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">وفى حالة عدم الإلتزام بذلك يكون متنازلاً عن جميع مستحقاته ولا يحق للطرف الثانى فى هذه الحالة مطالبة الطرف الأول بأي مستحقات من أى نوع كانت </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">.</span></span></p>

            <p dir="rtl" style="margin-right:-0.06in"><br />
            &nbsp;</p>

            <table cellpadding="0" cellspacing="0" dir="rtl" style="width:100%">
                <tbody>
                    <tr>
                        <td style="background-color:#f3f3f3">
                        <p style="margin-right:-0.06in; text-align:center"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:large">البند التاسع</span></span></span></p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">أ</span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">- </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">يجب على الموظف أن يراعى فى جميع الاوقات الأنظمة واللوائح المصرية ويقر الطرفان بأن قانون العمل المصرى رقم </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">137 </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">لسنة </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">1981 </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">المعدل بالقانون </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">12 </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">لسنة </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">2003 </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">المعدل بالقانون رقم </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">90 </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">لسنة </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">2005 </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">وقانون التأمينات الاجتماعية رقم </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">79 </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">لسنة </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">2005 </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">وقانون التأمينات الاجتماعية رقم </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">79 </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">لسنة </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">1975 </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">واية تعديلات تدخل عليها سوف تسرى على هذا العقد كما يسري عليه قانون الخدمة العسكرية والمدنية رقم </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">27 </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">لسنة </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">1980 </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">وأن أحكام تلك القوانين تشكل جزءا ضمنيا من هذا العقد وأن القوانين المذكورة سوف تنظم كافة الأمور غير المنصوص عليها على وجه التحديد فى هذا العقد </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">.</span></span></p>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">ب </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">- </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">تعتبر لائحة العمل والأوامر التى تقررها إدارة الشركة جزءا متمما لأحكام هذا العقد ويقر الموظف بموافقته واحترامه لتلك اللوائح والنظم والتعليمات فى حدود القوانين المعمول بها بجمهورية مصر العربية </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">.</span></span></p>

            <p dir="rtl" style="margin-right:-0.06in"><br />
            &nbsp;</p>

            <table cellpadding="0" cellspacing="0" dir="rtl" style="width:100%">
                <tbody>
                    <tr>
                        <td style="background-color:#f3f3f3">
                        <p style="margin-right:-0.06in; text-align:center"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:large">البند العاشر</span></span></span></p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">يلتزم الموظف بالاتى </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">:-</span></span></p>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">أ </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">- </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">أن يقدم للشركة خلال عشرة أيام من تاريخ توقيعه على هذا العقد كافة البيانات والمستندات والشهادات المطلوبة لتعيينه كما يلتزم بإخطار الشركة كتابة باى تعديل او تغيير يطرأ على هذه البيانات أو المستندات فور وقوعها واذا تبين عدم صحة تلك البيانات يصبح العقد مفسوخا تلقائيا دون اخطار او اتخاذ اي اجراء او الحصول على حكم قضائى </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">. </span></span></p>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">ب</span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">- </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">احترام مواعيد العمل المنوط به أو أدائه بدقة وأمانة وإيجابية و بشكل مرضى للشركة </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">.</span></span></p>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">ج </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">- </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">المحافظة على كرامة الوظيفة التى يشغلها وأن يكون حسن السير والسلوك والسمعة </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">.</span></span></p>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">د </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">- </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">يخطر الشركة فورا كلما بدا له أو حدث تعارض بين مصالح الشركة أو أحد عملائها وبين مصالحه الشخصية او مصالح احد اقربائه </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">- </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">كما يلتزم بأن يطلع الشركة على اى ملكيه او مصلحه او علاقات خاصة قد تؤثر على مقدرته في القيام بمهام عمله بنزاهة و استقلالية </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">.</span></span></p>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">هـ</span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">- </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">يلتزم بتسليم الشركة كل ما يكون لديه من أموال وعهدة او مستندات تخص الشركة أو عملائها وذلك فور انقضاء علاقة العمل لأي سبب من الأسباب </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">.</span></span></p>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">و ألا يعمل اطلاقاً لحسابه الخاص أو لحساب الغير بأجر أو بدون اجر وذلك طوال فترة عمله لدى الشركة وسواء كان ذلك بعد مواعيد العمل الرسمية أو خلال فترة الإجازات وفى حالة المخالفة يحق للشركة فسخ العقد فورا وبدون أي تعويض أو مكافأة مع عدم الإخلال بالرجوع على الموظف بالتعويض عن الأضرار نشأت عن ذلك </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">.</span></span></p>

            <table cellpadding="0" cellspacing="0" dir="rtl" style="width:100%">
                <tbody>
                    <tr>
                        <td style="background-color:#f3f3f3">
                        <p style="margin-right:-0.06in; text-align:center"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:large">البند الحادى عشر</span></span></span></p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">يحظر على الموظف ما يلي </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">:- </span></span></p>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">أ </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">- </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">إفشاء أسرار العمل الخاص بالشركة أو بأحد عملائها أو اطلاع الغير على طرق أدائه وذلك خلال مدة عمله لدى الشركة وفى حالة مخالفته لهذا البند يحق للشركة إنهاء العقد فورا دون انذار او مكافأه مع احتفاظ الشركة بحقها في الرجوع عليه بالتعويض عن الأضرار الناشئة عن ذلك </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">- </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">كما يحق لها اقتضاء هذا التعويض بكافة الطرق القانونية و يمتد سريان هذا البند لمدة عام بعد انتهاء العقد لأي سبب من الأسباب ، فى حالة مخالفة الموظف للحظر الوارد بهذا البند خلال هذه المدة </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">. </span></span></p>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">ب</span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">- </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">استقطاب أي من موظفي الشركة للعمل في منشأة تمارس نشاط منافس للشركة وذلك خلال فترة اثني عشر شهرا من تاريخ انتهاء عمله بالشركة لأى سبب من الأسباب </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">. </span></span></p>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">ج </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">- </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">الدخول في اتفاقات مع عملاء الشركة بغرض قيام الموظف بتقديم خدمات للغير سواء كان ذلك بطريقة مباشرة أو غير مباشرة وذلك خلال اثنى عشر شهرا من تاريخ انتهاء عمله بالشركة </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">.</span></span></p>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">د </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">- </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">لا يحق للطرف الثانى إستخدام أعمال الشركة سواء كانت أكواد او تصميمات أو غيره من اعمال الشركة إستخدام تجارى بأى شكل من الأشكال وفى هذه الحالة يحق للطرف الأول التقاضى والمطالبة بالتعويض المادي حسب الأضرار الواقعة عليه </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">.</span></span></p>

            <p dir="rtl" style="margin-right:-0.06in"><br />
            &nbsp;</p>

            <table align="right" cellpadding="0" cellspacing="0" dir="rtl" style="width:100%">
                <tbody>
                    <tr>
                        <td style="background-color:#f3f3f3">
                        <p style="margin-right:-0.06in; text-align:center"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:large">البند الثانى عشر</span></span></span></p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">عنوان الموظف مبين فى صدر هذا العقد </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">- </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">اية اخطارات ترسل على العنوان المذكور تعتبر انها ارسلت بشكل قانوني وعلى الموظف اخطار الشركة باى تعديل في عنوانه خلال أسبوع من هذا التعديل وفى حالة عدم الإبلاغ فإنه يتحمل كل ما يترتب على ذلك من آثار قانونية </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">.</span></span></p>

            <table align="right" cellpadding="0" cellspacing="0" dir="rtl" style="width:100%">
                <tbody>
                    <tr>
                        <td style="background-color:#f3f3f3">
                        <p style="margin-right:-0.06in; text-align:center"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:large">البند الثالث عشر</span></span></span></p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">تختص محاكم شمال القاهرة بالفصل فى أى نزاع ينشأ بين الطرفين حول هذا العقد </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">.</span></span></p>

            <table align="right" cellpadding="0" cellspacing="0" dir="rtl" style="width:100%">
                <tbody>
                    <tr>
                        <td style="background-color:#f3f3f3">
                        <p style="margin-right:-0.06in; text-align:center"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:large">البند الرابع عشر</span></span></span></p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">يشمل هذا العقد الاتفاق الكامل بين الطرفين ويسمو على اية اتفاقات او تفاهمات سابقة سواء كانت شفوية أو كتابية ولا يحق لأي موظف آخر أو وكيل عن الشركة بخلاف مدير الشركة إعطاء أية تعهدات تخص عمل الموظف أو اية شروط تتعلق بهذا التوظيف سواء فى تاريخ هذا العقد أو بعده بخلاف الشروط الواردة فى هذا العقد ولا يتم تعديل هذا العقد إلا كتابة وبتوقيع كل من الشركة والموظف</span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">.</span></span></p>

            <table align="right" cellpadding="0" cellspacing="0" dir="rtl" style="width:100%">
                <tbody>
                    <tr>
                        <td style="background-color:#f3f3f3">
                        <p style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:large">البند الخامس عشر</span></span></span></p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p dir="rtl" style="margin-right:-0.06in"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">يقر الموظف بالاطلاع على هذا العقد وكل ما يرتبط به من نظم ولوائح وقواعد و خلافة ووافق على كل ما ورد به وبناءا عليه فقد وقع الطرفان ثلاثة نسخ من هذا العقد </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">- </span></span><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">نسخة بيد كل طرف من هذا العقد والنسخة الثالثة بمكتب التأمينات االجتماعية </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">.</span></span></p>

            <p dir="rtl" style="margin-right:-0.06in"><br />
            &nbsp;</p>

            <p dir="rtl" style="margin-right:-0.06in"><br />
            &nbsp;</p>

            <p dir="rtl" style="margin-right:-0.06in"><br />
            &nbsp;</p>

            <table align="right" cellpadding="7" cellspacing="0" dir="rtl" style="width:100%">
                <tbody>
                    <tr>
                        <td style="background-color:#f3f3f3">
                        <p style="margin-right:-0.06in; text-align:center"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">توقيع الطرف الأول</span></span></span></p>
                        </td>
                        <td style="background-color:#f3f3f3">
                        <p style="margin-right:-0.06in; text-align:center"><span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">توقيع الطرف الثاني</span></span></span></p>
                        </td>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                        <td>
                        <p style="margin-right:-0.06in"><br />
                        <span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">التوقيع </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">/ </span></span><br />
                        <br />
                        <span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">التاريخ </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">/ </span></span><br />
                        <br />
                        <span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">الرقم القومى </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">/ </span></span><br />
                        &nbsp;</p>
                        </td>
                        <td>
                        <p style="margin-right:-0.06in"><br />
                        <span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">التوقيع </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">/ </span></span><br />
                        <br />
                        <span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">التاريخ </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">/ </span></span><br />
                        <br />
                        <span style="font-family:Calibri"><span style="font-family:Changa"><span style="font-size:medium">الرقم القومى </span></span></span><span style="font-family:Changa,serif"><span style="font-size:medium">/ </span></span><br />
                        &nbsp;</p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p dir="rtl" style="margin-left:-0.75in; margin-right:-0.06in"><br />
            &nbsp;</p>

            <div title="footer">
            <p><span style="background-color:#c0c0c0">1</span></p>
            </div>

    </body>

</html>
