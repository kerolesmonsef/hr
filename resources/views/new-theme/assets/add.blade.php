@extends('new-theme.layout.layout3')



@section('content')
    <div class="addPayroll">
        <div class="pageS1">

            <a href='/assets/index'>
                <div class='heading mb-4'>
                    <div class='flex align gap-15'>
                        <img src='/new-theme/icons/arrowLeft.svg' alt='' />
                        <h3>Add New Assets </h3>
                    </div>
                </div>
            </a> 

            <form class="formS1 inputsS1" action="" method="post">

                <div class='sectionS2'>
                    <div class='content p-4'>

                        <div class="row">
                            <div class="col-lg-6">
                                <label for="assetsName" class="form-label">Assets Name</label>
                                <div class="inputS1">
                                    <input type="text" id="assetsName" placeholder='Enter Assets Name'>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="type" class="form-label">Type</label>
                                <div class="inputS1">
                                    <input type="text" id="type" list="Type" placeholder='Enter Type'>
                                    <datalist id="Type">
                                        <option value="Boston">
                                        <option value="Cambridge">
                                    </datalist>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="snCode" class="form-label">S/N</label>
                                <div class="inputS1">
                                    <input type="text" id="snCode" placeholder='Enter S/N'>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="amount" class="form-label">Amount</label>
                                <div class="inputS1 noHeight">
                                    <input type="number" value="" id="amount" placeholder="Enter Amount"
                                        autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="employeeName" class="form-label">Employee Name</label>
                                <div class="inputS1">
                                    <input type="text" id="employeeName" placeholder='Enter Employee Name'>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="status" class="form-label">Status</label>
                                <div class="inputS1">
                                    <select id="status">
                                        <option value="not">not available</option>
                                    </select>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>

                <div class="flex align end gap-15 orders ">
                    <button class='buttonS1 rejected'>
                        Cancel
                    </button>
                    <button class='buttonS1 primary' type="submit">
                        Save
                    </button>
                </div>

            </form>
        </div>



    </div>
    </div>
@endsection
