@extends('new-theme.layout.layout1')

@push('styles')
    <link rel="stylesheet" href="{{ asset('new-theme/styles/settings.css') }}" />
@endpush



@section('content')
    <div class="salaryPage">
        <div class="pageS1">

            <div class="tabsS1">
                <ul class="detailsTabsHead scrollS2 nav nav-pills mb-3" id="pills-tab" role="tablist"
                    style="padding: 0px 10px;">
                    <li class="nav-item" role="presentation">
                        <div class="nav-link active" id="salary-tab" data-bs-toggle="tab" data-bs-target="#salary"
                            type="button" role="tab" aria-controls="salary" aria-selected="true">salary</div>
                    </li>
                    <li class="nav-item" role="presentation">
                        <div class="nav-link" id="Payroll-tab" data-bs-toggle="pill" data-bs-target="#Payroll"
                            type="button" role="tab" aria-controls="pills-Notes" aria-selected="false">Payroll</div>
                    </li>
                    <li class="nav-item" role="presentation">
                        <div class="nav-link" id="paySlip-tab" data-bs-toggle="pill" data-bs-target="#paySlip"
                            type="button" role="tab" aria-controls="pills-Notes" aria-selected="false">Pay Slip</div>
                    </li>
                    <li class="nav-item" role="presentation">
                        <div class="nav-link" id="allowance-tab" data-bs-toggle="pill" data-bs-target="#allowance"
                            type="button" role="tab" aria-controls="pills-Notes" aria-selected="false">Allowance</div>
                    </li>
                    <li class="nav-item" role="presentation">
                        <div class="nav-link" id="award-tab" data-bs-toggle="pill" data-bs-target="#award" type="button"
                            role="tab" aria-controls="pills-Notes" aria-selected="false">Award</div>
                    </li>
                    <li class="nav-item" role="presentation">
                        <div class="nav-link" id="deduction-tab" data-bs-toggle="pill" data-bs-target="#deduction"
                            type="button" role="tab" aria-controls="pills-Notes" aria-selected="false">Deduction</div>
                    </li>
                    <li class="nav-item" role="presentation">
                        <div class="nav-link" id="loan-tab" data-bs-toggle="pill" data-bs-target="#loan" type="button"
                            role="tab" aria-controls="pills-Notes" aria-selected="false">Loan</div>
                    </li>
                    <li class="nav-item" role="presentation">
                        <div class="nav-link" id="payment-tab" data-bs-toggle="pill" data-bs-target="#payment"
                            type="button" role="tab" aria-controls="pills-Notes" aria-selected="false">Payment</div>
                    </li>
                </ul>
            </div>

            <div class="tab-content" id="pills-tabContent">
                <!-- salary -->
                <div class="tab-pane fade show active" id="salary" role="tabpanel" aria-labelledby="salary-tab">
                    <form action="" class="formS1">
                        <div class='sectionS2'>
                            <div class="head withBorder flex align between">
                                <h3 class='small'>insurance Settings</h3>
                                <div class="inputS1 m-0" style="width: 100px">
                                    <select class='p-2' style="height: 35px;line-height: 1;">
                                        <option value="">saudi</option>
                                    </select>
                                </div>
                            </div>

                            <div class="content">
                                <div class="row">
                                    <h5 class='title'>Social Insurance</h5>
                                    <div class="col-lg-6">
                                        <label for="socialCompanyInsurance" class="form-label">saudi company insurance
                                            percentage (SAR)</label>
                                        <div class="inputS1">
                                            <input type="number" id="socialCompanyInsurance" value=""
                                                placeholder='0 SAR'>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="socialEmployeeInsurance" class="form-label">saudi employee insurance
                                            percentage (SAR)</label>
                                        <div class="inputS1">
                                            <input type="number" id="socialEmployeeInsurance" value=""
                                                placeholder='0 SAR'>
                                        </div>
                                    </div>

                                    <h5 class='title'>{{__("Medical Insurance")}}</h5>
                                    <div class="col-lg-6">
                                        <label for="companyInsurance" class="form-label">saudi company insurance
                                            percentage (SAR)</label>
                                        <div class="inputS1">
                                            <input type="number" id="companyInsurance" value=""
                                                placeholder='0 SAR'>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="employeeInsurance" class="form-label">saudi employee insurance
                                            percentage (SAR)</label>
                                        <div class="inputS1">
                                            <input type="number" id="employeeInsurance" value=""
                                                placeholder='0 SAR'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class='sectionS1'>
                            <div class="content">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="discountRate" class="form-label">Discount rate Absence with
                                            permission</label>
                                        <div class="inputS1">
                                            <input type="number" id="discountRate" value="" placeholder='00:00'>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="discountRateWithout" class="form-label">Discount rate Absence without
                                            permission</label>
                                        <div class="inputS1">
                                            <input type="number" id="discountRateWithout" value=""
                                                placeholder='00:00'>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="overtimeRate" class="form-label">overtime rate</label>
                                        <div class="inputS1">
                                            <input type="number" id="overtimeRate" value="" placeholder='00:00'>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="otherCurrencyUnit" class="form-label">Other currency unit
                                            price</label>
                                        <div class="inputS1">
                                            <input type="number" id="otherCurrencyUnit" value=""
                                                placeholder='00:00'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex align end gap-15 orders  mt-4">
                            <button class="buttonS1 rejected" type="button" data-bs-dismiss="modal" aria-label="Close">
                                Cancel
                            </button>
                            <button class="buttonS1 primary" type="submit">
                                Save
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Payroll -->
                <div class="tab-pane fade" id="Payroll" role="tabpanel" aria-labelledby="Payroll-tab">
                    <form action="" class="formS1">
                        <div class='sectionS2'>
                            <div class="head withBorder flex align between">
                                <h3 class='small'>Manage Payroll Type</h3>
                                <button class='buttonS1 primary' type="button" data-bs-toggle="modal"
                                    data-bs-target="#addNewPayroll">
                                    <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0.580872 7C0.580872 6.68934 0.869747 6.4375 1.22609 6.4375H15.4209C15.7773 6.4375 16.0662 6.68934 16.0662 7C16.0662 7.31066 15.7773 7.5625 15.4209 7.5625H1.22609C0.869747 7.5625 0.580872 7.31066 0.580872 7Z"
                                            fill="white" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.32352 0.25C8.67986 0.25 8.96874 0.50184 8.96874 0.8125V13.1875C8.96874 13.4982 8.67986 13.75 8.32352 13.75C7.96717 13.75 7.6783 13.4982 7.6783 13.1875V0.8125C7.6783 0.50184 7.96717 0.25 8.32352 0.25Z"
                                            fill="white" />
                                    </svg>
                                    Add New
                                </button>
                            </div>

                            <div class="content">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label class="inputCheckbox" for="payroll_reports_view">
                                            <input type="checkbox" name="payroll_reports_view" id="payroll_reports_view">
                                            <p>Employee Code</p>
                                        </label>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="inputCheckbox" for="name">
                                            <input type="checkbox" name="name" id="name">
                                            <p>Name</p>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex align end gap-15 orders  mt-4">
                            <button class="buttonS1 rejected" type="button" data-bs-dismiss="modal" aria-label="Close">
                                Cancel
                            </button>
                            <button class="buttonS1 primary" type="submit">
                                Save
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Pay Slip -->
                <div class="tab-pane fade" id="paySlip" role="tabpanel" aria-labelledby="paySlip-tab">
                    <div class='sectionS2'>
                        <div class="head withBorder flex align between">
                            <h3 class='small'>Manage Payslip Type</h3>
                            <button class='buttonS1 primary' type="button" data-bs-toggle="modal"
                                data-bs-target="#addNewPaySlip">
                                <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0.580872 7C0.580872 6.68934 0.869747 6.4375 1.22609 6.4375H15.4209C15.7773 6.4375 16.0662 6.68934 16.0662 7C16.0662 7.31066 15.7773 7.5625 15.4209 7.5625H1.22609C0.869747 7.5625 0.580872 7.31066 0.580872 7Z"
                                        fill="white" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8.32352 0.25C8.67986 0.25 8.96874 0.50184 8.96874 0.8125V13.1875C8.96874 13.4982 8.67986 13.75 8.32352 13.75C7.96717 13.75 7.6783 13.4982 7.6783 13.1875V0.8125C7.6783 0.50184 7.96717 0.25 8.32352 0.25Z"
                                        fill="white" />
                                </svg>
                                Add New
                            </button>
                        </div>

                        <div class="search">
                            <div class="inputS1">
                                <input type="text" placeholder="Search....">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11 20.75C5.62 20.75 1.25 16.38 1.25 11C1.25 5.62 5.62 1.25 11 1.25C11.41 1.25 11.75 1.59 11.75 2C11.75 2.41 11.41 2.75 11 2.75C6.45 2.75 2.75 6.45 2.75 11C2.75 15.55 6.45 19.25 11 19.25C15.55 19.25 19.25 15.55 19.25 11C19.25 10.59 19.59 10.25 20 10.25C20.41 10.25 20.75 10.59 20.75 11C20.75 16.38 16.38 20.75 11 20.75Z"
                                        fill="#D9D9D9"></path>
                                    <path
                                        d="M20 5.75H14C13.59 5.75 13.25 5.41 13.25 5C13.25 4.59 13.59 4.25 14 4.25H20C20.41 4.25 20.75 4.59 20.75 5C20.75 5.41 20.41 5.75 20 5.75Z"
                                        fill="#D9D9D9"></path>
                                    <path
                                        d="M17 8.75H14C13.59 8.75 13.25 8.41 13.25 8C13.25 7.59 13.59 7.25 14 7.25H17C17.41 7.25 17.75 7.59 17.75 8C17.75 8.41 17.41 8.75 17 8.75Z"
                                        fill="#D9D9D9"></path>
                                    <path
                                        d="M20.1601 22.79C20.0801 22.79 20.0001 22.78 19.9301 22.77C19.4601 22.71 18.6101 22.39 18.1301 20.96C17.8801 20.21 17.9701 19.46 18.3801 18.89C18.7901 18.32 19.4801 18 20.2701 18C21.2901 18 22.0901 18.39 22.4501 19.08C22.8101 19.77 22.7101 20.65 22.1401 21.5C21.4301 22.57 20.6601 22.79 20.1601 22.79ZM19.5601 20.49C19.7301 21.01 19.9701 21.27 20.1301 21.29C20.2901 21.31 20.5901 21.12 20.9001 20.67C21.1901 20.24 21.2101 19.93 21.1401 19.79C21.0701 19.65 20.7901 19.5 20.2701 19.5C19.9601 19.5 19.7301 19.6 19.6001 19.77C19.4801 19.94 19.4601 20.2 19.5601 20.49Z"
                                        fill="#D9D9D9"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="tableS1 scroll">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Payslip N...</th>
                                        <th>Payslip Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>01</td>
                                        <td>Annual Leaves</td>
                                        <td>
                                            <div class='action flex gap-3'>
                                                <div data-bs-toggle="modal" data-bs-target="#addNewPaySlip">
                                                    <img src="/new-theme/icons/all/edit.svg" alt="" />
                                                </div>
                                                <div data-bs-toggle="modal" data-bs-target="#confirm1">
                                                    <img src="/new-theme/icons/all/delete.svg" alt="" />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="paginationS1 flex gap-4 align">
                        <span class="Showing">
                            Showing 4 of 256 data
                        </span>

                        <div>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">

                                    <li class="page-item active" aria-current="page">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                </div>

                <!--Allowance -->
                <div class="tab-pane fade" id="allowance" role="tabpanel" aria-labelledby="allowance-tab">
                    <div class='sectionS2'>
                        <div class="head withBorder flex align between">
                            <h3 class='small'>Manage Allowance Options</h3>
                            <button class='buttonS1 primary' type="button" data-bs-toggle="modal"
                                data-bs-target="#addNewAllowance">
                                <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0.580872 7C0.580872 6.68934 0.869747 6.4375 1.22609 6.4375H15.4209C15.7773 6.4375 16.0662 6.68934 16.0662 7C16.0662 7.31066 15.7773 7.5625 15.4209 7.5625H1.22609C0.869747 7.5625 0.580872 7.31066 0.580872 7Z"
                                        fill="white" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8.32352 0.25C8.67986 0.25 8.96874 0.50184 8.96874 0.8125V13.1875C8.96874 13.4982 8.67986 13.75 8.32352 13.75C7.96717 13.75 7.6783 13.4982 7.6783 13.1875V0.8125C7.6783 0.50184 7.96717 0.25 8.32352 0.25Z"
                                        fill="white" />
                                </svg>
                                Add New
                            </button>
                        </div>

                        <div class="search">
                            <div class="inputS1">
                                <input type="text" placeholder="Search....">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11 20.75C5.62 20.75 1.25 16.38 1.25 11C1.25 5.62 5.62 1.25 11 1.25C11.41 1.25 11.75 1.59 11.75 2C11.75 2.41 11.41 2.75 11 2.75C6.45 2.75 2.75 6.45 2.75 11C2.75 15.55 6.45 19.25 11 19.25C15.55 19.25 19.25 15.55 19.25 11C19.25 10.59 19.59 10.25 20 10.25C20.41 10.25 20.75 10.59 20.75 11C20.75 16.38 16.38 20.75 11 20.75Z"
                                        fill="#D9D9D9"></path>
                                    <path
                                        d="M20 5.75H14C13.59 5.75 13.25 5.41 13.25 5C13.25 4.59 13.59 4.25 14 4.25H20C20.41 4.25 20.75 4.59 20.75 5C20.75 5.41 20.41 5.75 20 5.75Z"
                                        fill="#D9D9D9"></path>
                                    <path
                                        d="M17 8.75H14C13.59 8.75 13.25 8.41 13.25 8C13.25 7.59 13.59 7.25 14 7.25H17C17.41 7.25 17.75 7.59 17.75 8C17.75 8.41 17.41 8.75 17 8.75Z"
                                        fill="#D9D9D9"></path>
                                    <path
                                        d="M20.1601 22.79C20.0801 22.79 20.0001 22.78 19.9301 22.77C19.4601 22.71 18.6101 22.39 18.1301 20.96C17.8801 20.21 17.9701 19.46 18.3801 18.89C18.7901 18.32 19.4801 18 20.2701 18C21.2901 18 22.0901 18.39 22.4501 19.08C22.8101 19.77 22.7101 20.65 22.1401 21.5C21.4301 22.57 20.6601 22.79 20.1601 22.79ZM19.5601 20.49C19.7301 21.01 19.9701 21.27 20.1301 21.29C20.2901 21.31 20.5901 21.12 20.9001 20.67C21.1901 20.24 21.2101 19.93 21.1401 19.79C21.0701 19.65 20.7901 19.5 20.2701 19.5C19.9601 19.5 19.7301 19.6 19.6001 19.77C19.4801 19.94 19.4601 20.2 19.5601 20.49Z"
                                        fill="#D9D9D9"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="tableS1 scroll">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Allowance N...</th>
                                        <th>Allowance Options</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>01</td>
                                        <td>Commission sales</td>
                                        <td>
                                            <div class='action flex gap-3'>
                                                <div data-bs-toggle="modal" data-bs-target="#addNewAllowance">
                                                    <img src="/new-theme/icons/all/edit.svg" alt="" />
                                                </div>
                                                <div data-bs-toggle="modal" data-bs-target="#confirm1">
                                                    <img src="/new-theme/icons/all/delete.svg" alt="" />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="paginationS1 flex gap-4 align">
                        <span class="Showing">
                            Showing 4 of 256 data
                        </span>

                        <div>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">

                                    <li class="page-item active" aria-current="page">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                </div>

                <!--Award -->
                <div class="tab-pane fade" id="award" role="tabpanel" aria-labelledby="award-tab">
                    <div class='sectionS2'>
                        <div class="head withBorder flex align between">
                            <h3 class='small'>Manage Award Type</h3>
                            <button class='buttonS1 primary' type="button" data-bs-toggle="modal"
                                data-bs-target="#addNewAward">
                                <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0.580872 7C0.580872 6.68934 0.869747 6.4375 1.22609 6.4375H15.4209C15.7773 6.4375 16.0662 6.68934 16.0662 7C16.0662 7.31066 15.7773 7.5625 15.4209 7.5625H1.22609C0.869747 7.5625 0.580872 7.31066 0.580872 7Z"
                                        fill="white" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8.32352 0.25C8.67986 0.25 8.96874 0.50184 8.96874 0.8125V13.1875C8.96874 13.4982 8.67986 13.75 8.32352 13.75C7.96717 13.75 7.6783 13.4982 7.6783 13.1875V0.8125C7.6783 0.50184 7.96717 0.25 8.32352 0.25Z"
                                        fill="white" />
                                </svg>
                                Add New
                            </button>
                        </div>

                        <div class="search">
                            <div class="inputS1">
                                <input type="text" placeholder="Search....">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11 20.75C5.62 20.75 1.25 16.38 1.25 11C1.25 5.62 5.62 1.25 11 1.25C11.41 1.25 11.75 1.59 11.75 2C11.75 2.41 11.41 2.75 11 2.75C6.45 2.75 2.75 6.45 2.75 11C2.75 15.55 6.45 19.25 11 19.25C15.55 19.25 19.25 15.55 19.25 11C19.25 10.59 19.59 10.25 20 10.25C20.41 10.25 20.75 10.59 20.75 11C20.75 16.38 16.38 20.75 11 20.75Z"
                                        fill="#D9D9D9"></path>
                                    <path
                                        d="M20 5.75H14C13.59 5.75 13.25 5.41 13.25 5C13.25 4.59 13.59 4.25 14 4.25H20C20.41 4.25 20.75 4.59 20.75 5C20.75 5.41 20.41 5.75 20 5.75Z"
                                        fill="#D9D9D9"></path>
                                    <path
                                        d="M17 8.75H14C13.59 8.75 13.25 8.41 13.25 8C13.25 7.59 13.59 7.25 14 7.25H17C17.41 7.25 17.75 7.59 17.75 8C17.75 8.41 17.41 8.75 17 8.75Z"
                                        fill="#D9D9D9"></path>
                                    <path
                                        d="M20.1601 22.79C20.0801 22.79 20.0001 22.78 19.9301 22.77C19.4601 22.71 18.6101 22.39 18.1301 20.96C17.8801 20.21 17.9701 19.46 18.3801 18.89C18.7901 18.32 19.4801 18 20.2701 18C21.2901 18 22.0901 18.39 22.4501 19.08C22.8101 19.77 22.7101 20.65 22.1401 21.5C21.4301 22.57 20.6601 22.79 20.1601 22.79ZM19.5601 20.49C19.7301 21.01 19.9701 21.27 20.1301 21.29C20.2901 21.31 20.5901 21.12 20.9001 20.67C21.1901 20.24 21.2101 19.93 21.1401 19.79C21.0701 19.65 20.7901 19.5 20.2701 19.5C19.9601 19.5 19.7301 19.6 19.6001 19.77C19.4801 19.94 19.4601 20.2 19.5601 20.49Z"
                                        fill="#D9D9D9"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="tableS1 scroll">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Award N...</th>
                                        <th>Award Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>01</td>
                                        <td>Reward for hard work</td>
                                        <td>
                                            <div class='action flex gap-3'>
                                                <div data-bs-toggle="modal" data-bs-target="#addNewAward">
                                                    <img src="/new-theme/icons/all/edit.svg" alt="" />
                                                </div>
                                                <div data-bs-toggle="modal" data-bs-target="#confirm1">
                                                    <img src="/new-theme/icons/all/delete.svg" alt="" />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="paginationS1 flex gap-4 align">
                        <span class="Showing">
                            Showing 4 of 256 data
                        </span>

                        <div>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">

                                    <li class="page-item active" aria-current="page">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                </div>

                <!--Deducation -->
                <div class="tab-pane fade" id="deduction" role="tabpanel" aria-labelledby="deduction-tab">
                    <div class='sectionS2'>
                        <div class="head withBorder flex align between">
                            <h3 class='small'>Manage Deduction Option</h3>
                            <button class='buttonS1 primary' type="button" data-bs-toggle="modal"
                                data-bs-target="#addNewDeduction">
                                <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0.580872 7C0.580872 6.68934 0.869747 6.4375 1.22609 6.4375H15.4209C15.7773 6.4375 16.0662 6.68934 16.0662 7C16.0662 7.31066 15.7773 7.5625 15.4209 7.5625H1.22609C0.869747 7.5625 0.580872 7.31066 0.580872 7Z"
                                        fill="white" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8.32352 0.25C8.67986 0.25 8.96874 0.50184 8.96874 0.8125V13.1875C8.96874 13.4982 8.67986 13.75 8.32352 13.75C7.96717 13.75 7.6783 13.4982 7.6783 13.1875V0.8125C7.6783 0.50184 7.96717 0.25 8.32352 0.25Z"
                                        fill="white" />
                                </svg>
                                Add New
                            </button>
                        </div>

                        <div class="search">
                            <div class="inputS1">
                                <input type="text" placeholder="Search....">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11 20.75C5.62 20.75 1.25 16.38 1.25 11C1.25 5.62 5.62 1.25 11 1.25C11.41 1.25 11.75 1.59 11.75 2C11.75 2.41 11.41 2.75 11 2.75C6.45 2.75 2.75 6.45 2.75 11C2.75 15.55 6.45 19.25 11 19.25C15.55 19.25 19.25 15.55 19.25 11C19.25 10.59 19.59 10.25 20 10.25C20.41 10.25 20.75 10.59 20.75 11C20.75 16.38 16.38 20.75 11 20.75Z"
                                        fill="#D9D9D9"></path>
                                    <path
                                        d="M20 5.75H14C13.59 5.75 13.25 5.41 13.25 5C13.25 4.59 13.59 4.25 14 4.25H20C20.41 4.25 20.75 4.59 20.75 5C20.75 5.41 20.41 5.75 20 5.75Z"
                                        fill="#D9D9D9"></path>
                                    <path
                                        d="M17 8.75H14C13.59 8.75 13.25 8.41 13.25 8C13.25 7.59 13.59 7.25 14 7.25H17C17.41 7.25 17.75 7.59 17.75 8C17.75 8.41 17.41 8.75 17 8.75Z"
                                        fill="#D9D9D9"></path>
                                    <path
                                        d="M20.1601 22.79C20.0801 22.79 20.0001 22.78 19.9301 22.77C19.4601 22.71 18.6101 22.39 18.1301 20.96C17.8801 20.21 17.9701 19.46 18.3801 18.89C18.7901 18.32 19.4801 18 20.2701 18C21.2901 18 22.0901 18.39 22.4501 19.08C22.8101 19.77 22.7101 20.65 22.1401 21.5C21.4301 22.57 20.6601 22.79 20.1601 22.79ZM19.5601 20.49C19.7301 21.01 19.9701 21.27 20.1301 21.29C20.2901 21.31 20.5901 21.12 20.9001 20.67C21.1901 20.24 21.2101 19.93 21.1401 19.79C21.0701 19.65 20.7901 19.5 20.2701 19.5C19.9601 19.5 19.7301 19.6 19.6001 19.77C19.4801 19.94 19.4601 20.2 19.5601 20.49Z"
                                        fill="#D9D9D9"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="tableS1 scroll">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Deduction N...</th>
                                        <th>Deduction Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>01</td>
                                        <td>25%</td>
                                        <td>
                                            <div class='action flex gap-3'>
                                                <div data-bs-toggle="modal" data-bs-target="#addNewDeduction">
                                                    <img src="/new-theme/icons/all/edit.svg" alt="" />
                                                </div>
                                                <div data-bs-toggle="modal" data-bs-target="#confirm1">
                                                    <img src="/new-theme/icons/all/delete.svg" alt="" />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="paginationS1 flex gap-4 align">
                        <span class="Showing">
                            Showing 4 of 256 data
                        </span>

                        <div>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">

                                    <li class="page-item active" aria-current="page">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                </div>

                <!--Loan -->
                <div class="tab-pane fade" id="loan" role="tabpanel" aria-labelledby="loan-tab">
                    <div class='sectionS2'>
                        <div class="head withBorder flex align between">
                            <h3 class='small'>Manage Loan Option</h3>
                            <button class='buttonS1 primary' type="button" data-bs-toggle="modal"
                                data-bs-target="#addNewLoan">
                                <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0.580872 7C0.580872 6.68934 0.869747 6.4375 1.22609 6.4375H15.4209C15.7773 6.4375 16.0662 6.68934 16.0662 7C16.0662 7.31066 15.7773 7.5625 15.4209 7.5625H1.22609C0.869747 7.5625 0.580872 7.31066 0.580872 7Z"
                                        fill="white" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8.32352 0.25C8.67986 0.25 8.96874 0.50184 8.96874 0.8125V13.1875C8.96874 13.4982 8.67986 13.75 8.32352 13.75C7.96717 13.75 7.6783 13.4982 7.6783 13.1875V0.8125C7.6783 0.50184 7.96717 0.25 8.32352 0.25Z"
                                        fill="white" />
                                </svg>
                                Add New
                            </button>
                        </div>

                        <div class="search">
                            <div class="inputS1">
                                <input type="text" placeholder="Search....">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11 20.75C5.62 20.75 1.25 16.38 1.25 11C1.25 5.62 5.62 1.25 11 1.25C11.41 1.25 11.75 1.59 11.75 2C11.75 2.41 11.41 2.75 11 2.75C6.45 2.75 2.75 6.45 2.75 11C2.75 15.55 6.45 19.25 11 19.25C15.55 19.25 19.25 15.55 19.25 11C19.25 10.59 19.59 10.25 20 10.25C20.41 10.25 20.75 10.59 20.75 11C20.75 16.38 16.38 20.75 11 20.75Z"
                                        fill="#D9D9D9"></path>
                                    <path
                                        d="M20 5.75H14C13.59 5.75 13.25 5.41 13.25 5C13.25 4.59 13.59 4.25 14 4.25H20C20.41 4.25 20.75 4.59 20.75 5C20.75 5.41 20.41 5.75 20 5.75Z"
                                        fill="#D9D9D9"></path>
                                    <path
                                        d="M17 8.75H14C13.59 8.75 13.25 8.41 13.25 8C13.25 7.59 13.59 7.25 14 7.25H17C17.41 7.25 17.75 7.59 17.75 8C17.75 8.41 17.41 8.75 17 8.75Z"
                                        fill="#D9D9D9"></path>
                                    <path
                                        d="M20.1601 22.79C20.0801 22.79 20.0001 22.78 19.9301 22.77C19.4601 22.71 18.6101 22.39 18.1301 20.96C17.8801 20.21 17.9701 19.46 18.3801 18.89C18.7901 18.32 19.4801 18 20.2701 18C21.2901 18 22.0901 18.39 22.4501 19.08C22.8101 19.77 22.7101 20.65 22.1401 21.5C21.4301 22.57 20.6601 22.79 20.1601 22.79ZM19.5601 20.49C19.7301 21.01 19.9701 21.27 20.1301 21.29C20.2901 21.31 20.5901 21.12 20.9001 20.67C21.1901 20.24 21.2101 19.93 21.1401 19.79C21.0701 19.65 20.7901 19.5 20.2701 19.5C19.9601 19.5 19.7301 19.6 19.6001 19.77C19.4801 19.94 19.4601 20.2 19.5601 20.49Z"
                                        fill="#D9D9D9"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="tableS1 scroll">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Loan N...</th>
                                        <th>Loan Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>01</td>
                                        <td>loan</td>
                                        <td>
                                            <div class='action flex gap-3'>
                                                <div data-bs-toggle="modal" data-bs-target="#addNewLoan">
                                                    <img src="/new-theme/icons/all/edit.svg" alt="" />
                                                </div>
                                                <div data-bs-toggle="modal" data-bs-target="#confirm1">
                                                    <img src="/new-theme/icons/all/delete.svg" alt="" />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="paginationS1 flex gap-4 align">
                        <span class="Showing">
                            Showing 4 of 256 data
                        </span>

                        <div>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">

                                    <li class="page-item active" aria-current="page">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                </div>

                <!--Payment -->
                <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                    <div class='sectionS2'>
                        <div class="head withBorder flex align between">
                            <h3 class='small'>Manage Payment Type</h3>
                            <button class='buttonS1 primary' type="button" data-bs-toggle="modal"
                                data-bs-target="#addNewPayment">
                                <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0.580872 7C0.580872 6.68934 0.869747 6.4375 1.22609 6.4375H15.4209C15.7773 6.4375 16.0662 6.68934 16.0662 7C16.0662 7.31066 15.7773 7.5625 15.4209 7.5625H1.22609C0.869747 7.5625 0.580872 7.31066 0.580872 7Z"
                                        fill="white" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8.32352 0.25C8.67986 0.25 8.96874 0.50184 8.96874 0.8125V13.1875C8.96874 13.4982 8.67986 13.75 8.32352 13.75C7.96717 13.75 7.6783 13.4982 7.6783 13.1875V0.8125C7.6783 0.50184 7.96717 0.25 8.32352 0.25Z"
                                        fill="white" />
                                </svg>
                                Add New
                            </button>
                        </div>

                        <div class="search">
                            <div class="inputS1">
                                <input type="text" placeholder="Search....">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11 20.75C5.62 20.75 1.25 16.38 1.25 11C1.25 5.62 5.62 1.25 11 1.25C11.41 1.25 11.75 1.59 11.75 2C11.75 2.41 11.41 2.75 11 2.75C6.45 2.75 2.75 6.45 2.75 11C2.75 15.55 6.45 19.25 11 19.25C15.55 19.25 19.25 15.55 19.25 11C19.25 10.59 19.59 10.25 20 10.25C20.41 10.25 20.75 10.59 20.75 11C20.75 16.38 16.38 20.75 11 20.75Z"
                                        fill="#D9D9D9"></path>
                                    <path
                                        d="M20 5.75H14C13.59 5.75 13.25 5.41 13.25 5C13.25 4.59 13.59 4.25 14 4.25H20C20.41 4.25 20.75 4.59 20.75 5C20.75 5.41 20.41 5.75 20 5.75Z"
                                        fill="#D9D9D9"></path>
                                    <path
                                        d="M17 8.75H14C13.59 8.75 13.25 8.41 13.25 8C13.25 7.59 13.59 7.25 14 7.25H17C17.41 7.25 17.75 7.59 17.75 8C17.75 8.41 17.41 8.75 17 8.75Z"
                                        fill="#D9D9D9"></path>
                                    <path
                                        d="M20.1601 22.79C20.0801 22.79 20.0001 22.78 19.9301 22.77C19.4601 22.71 18.6101 22.39 18.1301 20.96C17.8801 20.21 17.9701 19.46 18.3801 18.89C18.7901 18.32 19.4801 18 20.2701 18C21.2901 18 22.0901 18.39 22.4501 19.08C22.8101 19.77 22.7101 20.65 22.1401 21.5C21.4301 22.57 20.6601 22.79 20.1601 22.79ZM19.5601 20.49C19.7301 21.01 19.9701 21.27 20.1301 21.29C20.2901 21.31 20.5901 21.12 20.9001 20.67C21.1901 20.24 21.2101 19.93 21.1401 19.79C21.0701 19.65 20.7901 19.5 20.2701 19.5C19.9601 19.5 19.7301 19.6 19.6001 19.77C19.4801 19.94 19.4601 20.2 19.5601 20.49Z"
                                        fill="#D9D9D9"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="tableS1 scroll">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Payment N...</th>
                                        <th>Payment Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>01</td>
                                        <td>Cash</td>
                                        <td>
                                            <div class='action flex gap-3'>
                                                <div data-bs-toggle="modal" data-bs-target="#addNewPayment">
                                                    <img src="/new-theme/icons/all/edit.svg" alt="" />
                                                </div>
                                                <div data-bs-toggle="modal" data-bs-target="#confirm1">
                                                    <img src="/new-theme/icons/all/delete.svg" alt="" />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="paginationS1 flex gap-4 align">
                        <span class="Showing">
                            Showing 4 of 256 data
                        </span>

                        <div>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">

                                    <li class="page-item active" aria-current="page">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>


            <!-- delete modal  -->
            <div class="modal fade" id="confirm1" abindex="-1" aria-hidden="true">
                <div class="modal-dialog confirmS1 ">
                    <div class="content">
                        <div class="des">Are you sure you want to remove this Item?</div>
                        <div class="btns">
                            <button type="submit" class="buttonS2 danger">remove</button>
                            <button type="button" class="buttonS2 cancel" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add New Payroll Modal -->
            <div class="modal fade customeModal" id="addNewPayroll" tabindex="-1" aria-labelledby="addNewPayrollLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form class="formS1">
                                <div class="sectionS2">
                                    <div class="head withBorder flex align between">
                                        <h3 class='small'>Add New Payroll type</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="content">
                                        <div class="">
                                            <label for="payrollType" class="form-label">Payroll type</label>
                                            <div class="inputS1">
                                                <input type="text" id="payrollType" placeholder='Enter Payroll type'>
                                            </div>
                                        </div>

                                        <div class="flex align end gap-15 orders  mt-5 mb-4">
                                            <button class="buttonS1 rejected" type="button" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                Cancel
                                            </button>
                                            <button class="buttonS1 primary" type="submit">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add New paySlip Modal -->
            <div class="modal fade customeModal" id="addNewPaySlip" tabindex="-1" aria-labelledby="addNewPaySlipLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form class="formS1">
                                <div class="sectionS2">
                                    <div class="head withBorder flex align between">
                                        <h3 class='small'>Add New payslip type</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="content">
                                        <div class="">
                                            <label for="paySlipType" class="form-label">Payslip Type</label>
                                            <div class="inputS1">
                                                <input type="text" id="paySlipType" placeholder='Enter Payslip Type'>
                                            </div>
                                        </div>

                                        <div class="flex align end gap-15 orders  mt-5 mb-4">
                                            <button class="buttonS1 rejected" type="button" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                Cancel
                                            </button>
                                            <button class="buttonS1 primary" type="submit">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add New Allowance Modal -->
            <div class="modal fade customeModal" id="addNewAllowance" tabindex="-1"
                aria-labelledby="addNewAllowanceLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form class="formS1">
                                <div class="sectionS2">
                                    <div class="head withBorder flex align between">
                                        <h3 class='small'>Add New Allowance option</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="content">
                                        <div class="">
                                            <label for="allowanceOption" class="form-label">Allowance option</label>
                                            <div class="inputS1">
                                                <input type="text" id="allowanceOption"
                                                    placeholder='Enter Allowance option'>
                                            </div>
                                        </div>

                                        <div class="flex align end gap-15 orders  mt-5 mb-4">
                                            <button class="buttonS1 rejected" type="button" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                Cancel
                                            </button>
                                            <button class="buttonS1 primary" type="submit">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add New Award Modal -->
            <div class="modal fade customeModal" id="addNewAward" tabindex="-1" aria-labelledby="addNewAwardLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form class="formS1">
                                <div class="sectionS2">
                                    <div class="head withBorder flex align between">
                                        <h3 class='small'>Add New Award Type</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="content">
                                        <div class="">
                                            <label for="awardType" class="form-label">Award type</label>
                                            <div class="inputS1">
                                                <input type="text" id="awardType" placeholder='Enter Award type'>
                                            </div>
                                        </div>

                                        <div class="flex align end gap-15 orders  mt-5 mb-4">
                                            <button class="buttonS1 rejected" type="button" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                Cancel
                                            </button>
                                            <button class="buttonS1 primary" type="submit">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Add New Deduction Modal -->
            <div class="modal fade customeModal" id="addNewDeduction" tabindex="-1"
                aria-labelledby="addNewDeductionLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form class="formS1">
                                <div class="sectionS2">
                                    <div class="head withBorder flex align between">
                                        <h3 class='small'>Add New Deduction Type</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="content">
                                        <div class="">
                                            <label for="deductionType" class="form-label">Deduction Type</label>
                                            <div class="inputS1">
                                                <input type="text" id="deductionType"
                                                    placeholder='Enter Deduction Type'>
                                            </div>
                                        </div>

                                        <div class="flex align end gap-15 orders  mt-5 mb-4">
                                            <button class="buttonS1 rejected" type="button" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                Cancel
                                            </button>
                                            <button class="buttonS1 primary" type="submit">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add New Loan Modal -->
            <div class="modal fade customeModal" id="addNewLoan" tabindex="-1" aria-labelledby="addNewLoanLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form class="formS1">
                                <div class="sectionS2">
                                    <div class="head withBorder flex align between">
                                        <h3 class='small'>Add New Loan Type</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="content">
                                        <div class="">
                                            <label for="loanType" class="form-label">Loan Type</label>
                                            <div class="inputS1">
                                                <input type="text" id="loanType" placeholder='Enter Loan Type'>
                                            </div>
                                        </div>

                                        <div class="flex align end gap-15 orders  mt-5 mb-4">
                                            <button class="buttonS1 rejected" type="button" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                Cancel
                                            </button>
                                            <button class="buttonS1 primary" type="submit">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add New Payment Modal -->
            <div class="modal fade customeModal" id="addNewPayment" tabindex="-1" aria-labelledby="addNewPaymentLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form class="formS1">
                                <div class="sectionS2">
                                    <div class="head withBorder flex align between">
                                        <h3 class='small'>{{__("Add New payment Type")}}</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="content">
                                        <div class="">
                                            <label for="paymentType" class="form-label">payment Type</label>
                                            <div class="inputS1">
                                                <input type="text" id="paymentType" placeholder='{{__("Enter payment Type")}}'>
                                            </div>
                                        </div>

                                        <div class="flex align end gap-15 orders  mt-5 mb-4">
                                            <button class="buttonS1 rejected" type="button" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                Cancel
                                            </button>
                                            <button class="buttonS1 primary" type="submit">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
