<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class NewThemePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'Dashboard-View',
                'category' => 'Dashboard',
            ],


            [
                'name' => 'Employee-List',
                'category' => 'Employee',
            ],
            
            [
                'name' => 'Employee-Create',
                'category' => 'Employee',
            ],
            
            [
                'name' => 'Employee-Edit',
                'category' => 'Employee',
            ],
            
            [
                'name' => 'Employee-Delete',
                'category' => 'Employee',
            ],

            [
                'name' => 'Employee-Export',
                'category' => 'Employee',
            ],
            [
                'name'     => 'Employee-Print',
                'category' => 'Employee',
            ],



            [
                'name' => 'Shift-List',
                'category' => 'Shift',
            ],
            [
                'name' => 'Shift-Create',
                'category' => 'Shift',
            ],
            
            [
                'name' => 'Shift-Edit',
                'category' => 'Shift',
            ],
            
            [
                'name' => 'Shift-Delete',
                'category' => 'Shift',
            ],
            
            [
                'name' => 'Shift-Export',
                'category' => 'Shift',
            ],
            [
                'name'     => 'Shift-Print',
                'category' => 'Shift',
            ],




            [
                'name'     => 'Attendance-List',
                'category' => 'Attendance',
            ],
            [
                'name'     => 'Attendance-Export',
                'category' => 'Attendance',
            ],
            [
                'name'     => 'Attendance-Print',
                'category' => 'Attendance',
            ],



            [
                'name'     => 'Saturationdeduction-List',
                'category' => 'Saturationdeduction',
            ],
            [
                'name'     => 'Saturationdeduction-Create',
                'category' => 'Saturationdeduction',
            ],
            [
                'name'     => 'Saturationdeduction-Edit',
                'category' => 'Saturationdeduction',
            ],
            
            [
                'name'     => 'Saturationdeduction-Delete',
                'category' => 'Saturationdeduction',
            ],
            
            [
                'name'     => 'Saturationdeduction-Export',
                'category' => 'Saturationdeduction',
            ],
            [
                'name'     => 'Saturationdeduction-Print',
                'category' => 'Saturationdeduction',
            ],



            [
                'name'     => 'Task-List',
                'category' => 'Task',
            ],
            [
                'name'     => 'Task-Create',
                'category' => 'Task',
            ],
            [
                'name'     => 'Task-Edit',
                'category' => 'Task',
            ],
            
            [
                'name'     => 'Task-Delete',
                'category' => 'Task',
            ],
            
            [
                'name'     => 'Task-Export',
                'category' => 'Task',
            ],
            [
                'name'     => 'Task-Filter',
                'category' => 'Task',
            ],




            [
                'name' => 'EmployeePermission-List',
                'category' => 'EmployeePermission',
            ],
            
            [
                'name' => 'EmployeePermission-Create',
                'category' => 'EmployeePermission',
            ],
            
            [
                'name' => 'EmployeePermission-Edit',
                'category' => 'EmployeePermission',
            ],
            
            [
                'name' => 'EmployeePermission-Delete',
                'category' => 'EmployeePermission',
            ],
            
            [
                'name' => 'EmployeePermission-Export',
                'category' => 'EmployeePermission',
            ],
            
            [
                'name' => 'EmployeePermission-Accept',
                'category' => 'EmployeePermission',
            ],
            
            [
                'name' => 'EmployeePermission-Reject',
                'category' => 'EmployeePermission',
            ],
            [
                'name' => 'EmployeePermission-Print',
                'category' => 'EmployeePermission',
            ],



            [
                'name'     => 'Vacation-List',
                'category' => 'Vacation',
            ],
            
            [
                'name' => 'Vacation-Create',
                'category' => 'Vacation',
            ],
            
            [
                'name' => 'Vacation-Edit',
                'category' => 'Vacation',
            ],
            
            [
                'name' => 'Vacation-Delete',
                'category' => 'Vacation',
            ],
            
            [
                'name' => 'Vacation-Export',
                'category' => 'Vacation',
            ],

            [
                'name' => 'Vacation-Print',
                'category' => 'Vacation',
            ],
            
            [
                'name' => 'Vacation-Accept',
                'category' => 'Vacation',
            ],
            
            [
                'name' => 'Vacation-Reject',
                'category' => 'Vacation',
            ],


            [
                'name' => 'WorkFromHome-List',
                'category' => 'Work From Home',
            ],
            
            [
                'name' => 'WorkFromHome-Create',
                'category' => 'Work From Home',
            ],
            
            [
                'name' => 'WorkFromHome-Edit',
                'category' => 'Work From Home',
            ],
            
            [
                'name' => 'WorkFromHome-Delete',
                'category' => 'Work From Home',
            ],
            
            [
                'name' => 'WorkFromHome-Export',
                'category' => 'Work From Home',
            ],
            [
                'name' => 'WorkFromHome-Print',
                'category' => 'Work From Home',
            ],
            
            [
                'name'     => 'WorkFromHome-Accept',
                'category' => 'Work From Home',
            ],
            
            [
                'name'     => 'WorkFromHome-Reject',
                'category' => 'Work From Home',
            ],





            [
                'name'     => 'Loan-List',
                'category' => 'Loan',
            ],
            
            [
                'name'     => 'Loan-Create',
                'category' => 'Loan',
            ],
            
            [
                'name'     => 'Loan-Edit',
                'category' => 'Loan',
            ],
            
            [
                'name'     => 'Loan-Delete',
                'category' => 'Loan',
            ],
            
            [
                'name'     => 'Loan-Export',
                'category' => 'Loan',
            ],
            [
                'name' => 'Loan-Print',
                'category' => 'Loan',
            ],
            [
                'name'     => 'Loan-Accept',
                'category' => 'Loan',
            ],
            
            [
                'name'     => 'Loan-Reject',
                'category' => 'Loan',
            ],







            [
                'name'     => 'Mission-List',
                'category' => 'Mission',
            ],
            
            [
                'name'     => 'Mission-Create',
                'category' => 'Mission',
            ],
            
            [
                'name'     => 'Mission-Edit',
                'category' => 'Mission',
            ],
            
            [
                'name'     => 'Mission-Delete',
                'category' => 'Mission',
            ],
            
            [
                'name'     => 'Mission-Export',
                'category' => 'Mission',
            ],
            [
                'name' => 'Mission-Print',
                'category' => 'Mission',
            ],
            [
                'name'     => 'Mission-Accept',
                'category' => 'Mission',
            ],
            
            [
                'name'     => 'Mission-Reject',
                'category' => 'Mission',
            ],




            [
                'name'     => 'OverTime-List',
                'category' => 'OverTime',
            ],
            
            [
                'name'     => 'OverTime-Create',
                'category' => 'OverTime',
            ],
            
            [
                'name'     => 'OverTime-Edit',
                'category' => 'OverTime',
            ],
            
            [
                'name'     => 'OverTime-Delete',
                'category' => 'OverTime',
            ],
            
            [
                'name'     => 'OverTime-Export',
                'category' => 'OverTime',
            ],
            [
                'name' => 'OverTime-Print',
                'category' => 'OverTime',
            ],
            [
                'name'     => 'OverTime-Accept',
                'category' => 'OverTime',
            ],
            
            [
                'name'     => 'OverTime-Reject',
                'category' => 'OverTime',
            ],




            [
                'name'     => 'Evaluation-List',
                'category' => 'Evaluation',
            ],
            
            [
                'name'     => 'Evaluation-Create',
                'category' => 'Evaluation',
            ],
            
            [
                'name'     => 'Evaluation-Edit',
                'category' => 'Evaluation',
            ],
            
            [
                'name'     => 'Evaluation-Delete',
                'category' => 'Evaluation',
            ],
            
            [
                'name'     => 'Evaluation-Export',
                'category' => 'Evaluation',
            ],
            [
                'name' => 'Evaluation-Print',
                'category' => 'Evaluation',
            ],




            [
                'name'     => 'Performance-List',
                'category' => 'Performance',
            ],
            
            [
                'name'     => 'Performance-Create',
                'category' => 'Performance',
            ],
            
            [
                'name'     => 'Performance-Edit',
                'category' => 'Performance',
            ],
            
            [
                'name'     => 'Performance-Delete',
                'category' => 'Performance',
            ],
            
            [
                'name'     => 'Performance-Export',
                'category' => 'Performance',
            ],
            [
                'name' => 'Performance-Print',
                'category' => 'Performance',
            ],



            [
                'name'     => 'Meeting-List',
                'category' => 'Meeting',
            ],
            
            [
                'name'     => 'Meeting-Create',
                'category' => 'Meeting',
            ],
            
            [
                'name'     => 'Meeting-Edit',
                'category' => 'Meeting',
            ],
            
            [
                'name'     => 'Meeting-Delete',
                'category' => 'Meeting',
            ],
            
            [
                'name'     => 'Meeting-Export',
                'category' => 'Meeting',
            ],
            [
                'name' => 'Meeting-Print',
                'category' => 'Meeting',
            ],




            [
                'name'     => 'Event-List',
                'category' => 'Event',
            ],
            
            [
                'name'     => 'Event-Create',
                'category' => 'Event',
            ],
            
            [
                'name'     => 'Event-Edit',
                'category' => 'Event',
            ],
            
            [
                'name'     => 'Event-Delete',
                'category' => 'Event',
            ],
            
            [
                'name'     => 'Event-Export',
                'category' => 'Event',
            ],
            [
                'name' => 'Event-Print',
                'category' => 'Event',
            ],




            [
                'name'     => 'News-List',
                'category' => 'News',
            ],
            
            [
                'name'     => 'News-Create',
                'category' => 'News',
            ],
            
            [
                'name'     => 'News-Edit',
                'category' => 'News',
            ],
            
            [
                'name'     => 'News-Delete',
                'category' => 'News',
            ],




            [
                'name'     => 'Offers-List',
                'category' => 'Offers',
            ],
            
            [
                'name'     => 'Offers-Create',
                'category' => 'Offers',
            ],
            
            [
                'name'     => 'Offers-Edit',
                'category' => 'Offers',
            ],
            
            [
                'name'     => 'Offers-Delete',
                'category' => 'Offers',
            ],




            [
                'name'     => 'JobOffers-List',
                'category' => 'JobOffers',
            ],
            
            [
                'name'     => 'JobOffers-Create',
                'category' => 'JobOffers',
            ],
            
            [
                'name'     => 'JobOffers-Edit',
                'category' => 'JobOffers',
            ],
            
            [
                'name'     => 'JobOffers-Delete',
                'category' => 'JobOffers',
            ],
            [
                'name'     => 'JobOffers-Export',
                'category' => 'JobOffers',
            ],
            [
                'name'     => 'JobOffers-Print',
                'category' => 'JobOffers',
            ],






            [
                'name'     => 'Payroll-List',
                'category' => 'Payroll',
            ],
            [
                'name'     => 'Payroll-View',
                'category' => 'Payroll',
            ],
            [
                'name'     => 'Payroll-Create',
                'category' => 'Payroll',
            ],
            [
                'name'     => 'Payroll-Export',
                'category' => 'Payroll',
            ],
            [
                'name'     => 'Payroll-Print',
                'category' => 'Payroll',
            ],
            [
                'name'     => 'Payroll-MonthlySalaryRecord',
                'category' => 'Payroll',
            ],
            [
                'name'     => 'Payroll-PayrollTape',
                'category' => 'Payroll',
            ],
            [
                'name'     => 'Payroll-Payment',
                'category' => 'Payroll',
            ],








            [
                'name'     => 'Assets-List',
                'category' => 'Assets',
            ],
            
            [
                'name'     => 'Assets-Create',
                'category' => 'Assets',
            ],
            
            [
                'name'     => 'Assets-Edit',
                'category' => 'Assets',
            ],
            
            [
                'name'     => 'Assets-Delete',
                'category' => 'Assets',
            ],
            [
                'name'     => 'Assets-Export',
                'category' => 'Assets',
            ],
            [
                'name'     => 'Assets-Print',
                'category' => 'Assets',
            ],





            [
                'name'     => 'companyStructures-List',
                'category' => 'companyStructures',
            ],
            [
                'name'     => 'companyStructures-Assign',
                'category' => 'companyStructures',
            ],






            [
                'name'     => 'Library-List',
                'category' => 'Library',
            ],
            [
                'name'     => 'Library-Create',
                'category' => 'Library',
            ],
            [
                'name'     => 'Library-Edit',
                'category' => 'Library',
            ],
            [
                'name'     => 'Library-Delete',
                'category' => 'Library',
            ],
            






            [
                'name'     => 'AttendanceReport-List',
                'category' => 'AttendanceReport',
            ],
            [
                'name'     => 'AttendanceReport-Export',
                'category' => 'AttendanceReport',
            ],
            [
                'name'     => 'AttendanceReport-Print',
                'category' => 'AttendanceReport',
            ],



            [
                'name'     => 'VacationReport-List',
                'category' => 'VacationReport',
            ],
            [
                'name'     => 'VacationReport-Export',
                'category' => 'VacationReport',
            ],
            [
                'name'     => 'VacationReport-Print',
                'category' => 'VacationReport',
            ],


            [
                'name'     => 'EmailReport-List',
                'category' => 'EmailReport',
            ],
            [
                'name'     => 'EmailReport-Export',
                'category' => 'EmailReport',
            ],
            [
                'name'     => 'EmailReport-Print',
                'category' => 'EmailReport',
            ],


            [
                'name'     => 'PayrollReport-List',
                'category' => 'PayrollReport',
            ],
            [
                'name'     => 'PayrollReport-Export',
                'category' => 'PayrollReport',
            ],
            [
                'name'     => 'PayrollReport-Print',
                'category' => 'PayrollReport',
            ],



            [
                'name'     => 'Users-List',
                'category' => 'Users',
            ],
            [
                'name'     => 'Users-Create',
                'category' => 'Users',
            ],
            [
                'name'     => 'Users-Edit',
                'category' => 'Users',
            ],
            [
                'name'     => 'Users-Delete',
                'category' => 'Users',
            ],



            [
                'name'     => 'Branch-List',
                'category' => 'Branch',
            ],
            [
                'name'     => 'Branch-Create',
                'category' => 'Branch',
            ],
            [
                'name'     => 'Branch-Edit',
                'category' => 'Branch',
            ],
            [
                'name'     => 'Branch-Delete',
                'category' => 'Branch',
            ],



            [
                'name'     => 'Department-List',
                'category' => 'Department',
            ],
            [
                'name'     => 'Department-Create',
                'category' => 'Department',
            ],
            [
                'name'     => 'Department-Edit',
                'category' => 'Department',
            ],
            [
                'name'     => 'Department-Delete',
                'category' => 'Department',
            ],




            [
                'name'     => 'PerformanceFactor-List',
                'category' => 'PerformanceFactor',
            ],
            [
                'name'     => 'PerformanceFactor-Create',
                'category' => 'PerformanceFactor',
            ],
            [
                'name'     => 'PerformanceFactor-Edit',
                'category' => 'PerformanceFactor',
            ],
            [
                'name'     => 'PerformanceFactor-Delete',
                'category' => 'PerformanceFactor',
            ],



            [
                'name'     => 'PerformancePeriod-List',
                'category' => 'PerformancePeriod',
            ],
            [
                'name'     => 'PerformancePeriod-Create',
                'category' => 'PerformancePeriod',
            ],
            [
                'name'     => 'PerformancePeriod-Edit',
                'category' => 'PerformancePeriod',
            ],
            [
                'name'     => 'PerformancePeriod-Delete',
                'category' => 'PerformancePeriod',
            ],



            [
                'name'     => 'InsuranceCompanies-List',
                'category' => 'InsuranceCompanies',
            ],
            [
                'name'     => 'InsuranceCompanies-Create',
                'category' => 'InsuranceCompanies',
            ],
            [
                'name'     => 'InsuranceCompanies-Edit',
                'category' => 'InsuranceCompanies',
            ],
            [
                'name'     => 'InsuranceCompanies-Delete',
                'category' => 'InsuranceCompanies',
            ],


            [
                'name'     => 'AssetTypes-List',
                'category' => 'AssetTypes',
            ],
            [
                'name'     => 'AssetTypes-Create',
                'category' => 'AssetTypes',
            ],
            [
                'name'     => 'AssetTypes-Edit',
                'category' => 'AssetTypes',
            ],
            [
                'name'     => 'AssetTypes-Delete',
                'category' => 'AssetTypes',
            ],


            [
                'name'     => 'Document-List',
                'category' => 'Document',
            ],
            [
                'name'     => 'Document-Create',
                'category' => 'Document',
            ],
            [
                'name'     => 'Document-Edit',
                'category' => 'Document',
            ],
            [
                'name'     => 'Document-Delete',
                'category' => 'Document',
            ],


            [
                'name'     => 'ContractTemplates-List',
                'category' => 'ContractTemplates',
            ],
            [
                'name'     => 'ContractTemplates-Create',
                'category' => 'ContractTemplates',
            ],
            [
                'name'     => 'ContractTemplates-Edit',
                'category' => 'ContractTemplates',
            ],
            [
                'name'     => 'ContractTemplates-Delete',
                'category' => 'ContractTemplates',
            ],


            [
                'name'     => 'SalarySetting-List',
                'category' => 'SalarySetting',
            ],


            [
                'name'     => 'PayrollSetting-List',
                'category' => 'PayrollSetting',
            ],



            [
                'name'     => 'PayslipType-List',
                'category' => 'PayslipType',
            ],
            [
                'name'     => 'PayslipType-Create',
                'category' => 'PayslipType',
            ],
            [
                'name'     => 'PayslipType-Edit',
                'category' => 'PayslipType',
            ],
            [
                'name'     => 'PayslipType-Delete',
                'category' => 'PayslipType',
            ],



            [
                'name'     => 'AllowanceOption-List',
                'category' => 'AllowanceOption',
            ],
            [
                'name'     => 'AllowanceOption-Create',
                'category' => 'AllowanceOption',
            ],
            [
                'name'     => 'AllowanceOption-Edit',
                'category' => 'AllowanceOption',
            ],
            [
                'name'     => 'AllowanceOption-Delete',
                'category' => 'AllowanceOption',
            ],




            [
                'name'     => 'AwardType-List',
                'category' => 'AwardType',
            ],
            [
                'name'     => 'AwardType-Create',
                'category' => 'AwardType',
            ],
            [
                'name'     => 'AwardType-Edit',
                'category' => 'AwardType',
            ],
            [
                'name'     => 'AwardType-Delete',
                'category' => 'AwardType',
            ],



            [
                'name'     => 'DeductionOption-List',
                'category' => 'DeductionOption',
            ],
            [
                'name'     => 'DeductionOption-Create',
                'category' => 'DeductionOption',
            ],
            [
                'name'     => 'DeductionOption-Edit',
                'category' => 'DeductionOption',
            ],
            [
                'name'     => 'DeductionOption-Delete',
                'category' => 'DeductionOption',
            ],




            [
                'name'     => 'LoanOption-List',
                'category' => 'LoanOption',
            ],
            [
                'name'     => 'LoanOption-Create',
                'category' => 'LoanOption',
            ],
            [
                'name'     => 'LoanOption-Edit',
                'category' => 'LoanOption',
            ],
            [
                'name'     => 'LoanOption-Delete',
                'category' => 'LoanOption',
            ],



            [
                'name'     => 'PaymentType-List',
                'category' => 'PaymentType',
            ],
            [
                'name'     => 'PaymentType-Create',
                'category' => 'PaymentType',
            ],
            [
                'name'     => 'PaymentType-Edit',
                'category' => 'PaymentType',
            ],
            [
                'name'     => 'PaymentType-Delete',
                'category' => 'PaymentType',
            ],



            [
                'name'     => 'AttendanceSetting-List',
                'category' => 'AttendanceSetting',
            ],



            [
                'name'     => 'VacationSetting-List',
                'category' => 'VacationSetting',
            ],
            [
                'name'     => 'VacationSetting-Create',
                'category' => 'VacationSetting',
            ],
            [
                'name'     => 'VacationSetting-Edit',
                'category' => 'VacationSetting',
            ],
            [
                'name'     => 'VacationSetting-Delete',
                'category' => 'VacationSetting',
            ],
      
        ];
        
        foreach($permissions as $permission){
            Permission::firstOrCreate([
                'name'     => $permission['name'],
                'category' => $permission['category'],
            ]);
        }
    }
}
