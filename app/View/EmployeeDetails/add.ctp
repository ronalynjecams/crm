<!--MASKS-->
<script src="/js/validation/jquery.maskedinput.js"></script>
<script src="/js/validation/jquery.maskedinput.min.js"></script>
 
<!--Select2 [ OPTIONAL ]-->
<!--<link href="/js/plug/select2/css/select2.min.css" rel="stylesheet">-->
 
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.min.css"; rel="stylesheet">
<!--<link href="/js/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">-->
<!--<link href="/js/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">-->

<!--<script src="/js/plug/datatables/media/js/jquery.dataTables.js"></script>-->
<!--<script src="/js/plug/datatables/media/js/dataTables.bootstrap.js"></script>-->
<!--<script src="/js/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.min.js"></script>

<!--Select2 [ OPTIONAL ]-->
<!--<script src="/js/plug/select2/js/select2.min.js"></script>-->
<script src="/css/plug/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>

<!--SWEET ALERT-->
<link href="/css/sweetalert.css" rel="stylesheet">
<script src="/js/sweetalert.min.js"></script>

<!--Page Title-->
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<div id="page-title">
    <h1 class="page-header text-overflow"> Application for Employment or Employee Details</h1>
</div>

<!--Page content-->
<!--===================================================-->
<div id="page-content">
    <div class="row">
        <div class="col-md-12">

                <!-- Classic Form Wizard -->
                <!--===================================================-->
                <div id="demo-cls-wz">
                    <!--Nav-->
                    <ul class="wz-nav-off wz-icon-inline">
                        <li class="col-xs-3 bg-mint">
                            <a data-toggle="tab" href="#demo-cls-tab1">
                                <span class="icon-wrap icon-wrap-xs bg-trans-dark"><i class="demo-pli-male icon-lg"></i></span> Personal Information
                            </a>
                        </li>
                        <li class="col-xs-3 bg-mint">
                            <a data-toggle="tab" href="#demo-cls-tab2">
                                <span class="icon-wrap icon-wrap-xs bg-trans-dark"><i class="demo-pli-home icon-lg"></i></span> Family Information
                            </a>
                        </li>
                        <li class="col-xs-3 bg-mint">
                            <a data-toggle="tab" href="#demo-cls-tab3">
                                <span class="icon-wrap icon-wrap-xs bg-trans-dark"><i class="demo-pli-information icon-lg"></i></span> Educational Background
                            </a>
                        </li>
                        <li class="col-xs-3 bg-mint">
                            <a data-toggle="tab" href="#demo-cls-tab4">
                                <span class="icon-wrap icon-wrap-xs bg-trans-dark"><i class="demo-pli-medal-2 icon-lg"></i></span> Work Experience & References
                            </a>
                        </li>
                    </ul>
                    <!--Progress bar-->
                    <div class="progress progress-xs progress-striped active">
                        <div class="progress-bar progress-bar-dark"></div>
                    </div>
                    <!--Form-->
                    <form class="form-horizontal mar-top">
                        <div class="panel-body">
                            <div class="tab-content">
                                <!--First tab-->
                                <div id="demo-cls-tab1" class="tab-pane">
                                <!-- PERSONAL INFORMATION START -->
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label>Last name <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="lastname"  id="lastname" required> 
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label>Middle Name <span class="text-danger">*</span></label> 
                                                            <input type="text" class="form-control" name="middlename"  id="middlename" required> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-1">
                                                        <div class="row">
                                                            <label>Nick name</label> 
                                                            <input type="text" class="form-control" name="nickname"  id="nickname"  >
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="row">
                                                            <label>Expected Salary <span class="text-danger">*</span></label> 
                                                            <input type="number" step="any" min='1' class="form-control" name="expected_salary"  id="expected_salary"  required>  
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="row">
                                                            <label>Mobile Number <span class="text-danger">*</span></label> 
                                                            <input type="text"   class="form-control" name="mobile_no"  id="mobile_no" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="row">
                                                            <label>Citizenship <span class="text-danger">*</span></label>
                                                            <input type="text"   class="form-control" name="citizenship"  id="citizenship" value="Filipino" required>  
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="row">
                                                            <label>Position Applied <span class="text-danger">*</span></label>
                                                            <input type="text"   class="form-control" name="position_applied"  id="position_applied" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-1">
                                                        <div class="row">
                                                            <label>Religion <span class="text-danger">*</span></label> 
                                                            <input type="text"   class="form-control" name="religion"  id="religion" required>     
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3" required>
                                                        <div class="row">
                                                            <label>Gender <span class="text-danger">*</span></label>
                                                            <select class="form-control" id="gender">
                                                                <option>---- Select Gender ----</option>
                                                                <option>Female</option>
                                                                <option>Male</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="row">
                                                            <label>Birthdate</label>
                                                            <input type="date" class="form-control" id="birthdate" /> 
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="row">
                                                            <label>Civil Status <span class="text-danger">*</span></label>
                                                            <select class="form-control" id="civil_status">
                                                                <option>---- Select Civil Status ----</option>
                                                                <option>Single</option>
                                                                <option>Married</option>
                                                                <option>Widow</option>
                                                                <option>Widower</option>
                                                                <option>Annulled</option>
                                                                <option>Divorced</option>
                                                                <option>Common Law Wife</option>
                                                                <option>Common Law Husband</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="row">
                                                            <label>Birth Place <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="birthplace">   
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-3">
                                                        <div class="row">
                                                            <label>SSS <span class="text-danger">*</span></label> 
                                                            <input type="text" class="form-control" id="sss">   
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="row">
                                                            <label>PAG - IBIG <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="pagibig">   
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="row">
                                                            <label>Philhealth <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="philhealth">   
                                                        </div>
                                                   </div>
                                                    <div class="col-sm-3">
                                                        <div class="row">
                                                            <label>TIN <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="tin_number">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <h2>Address</h2>
                                                    <label>Present Address <span class="text-danger">*</span></label>
                                                    <div class="PresentAddress">
                                                        <div class="col-sm-4">
                                                            <div class="row">
                                                            <input type="text" class="form-control" id="present_address", placeholder="No./Street/Brgy./District & Municipality"> 
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="row">
                                                            <input type="text" class="form-control" id="present_city", placeholder="City"> 
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="row">
                                                            <input type="text" class="form-control" id="present_province", placeholder="Province">  
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="row"> 
                                                            <input type="text" class="form-control" id="present_zip", placeholder="Zip Code">   
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Provincial Address <span class="text-danger">*</span></label>
                                                    <input type="checkbox" name="same_address" id="same_address"> <em class="text-danger">Check if different provincial address.</em>
                                                
                                                    <div class="ProvincialAddress"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                <!-- PERSONAL INFORMATION END -->
                                </div>
                               
                                <!--Second tab-->
                                <div id="demo-cls-tab2" class="tab-pane fade">
                                <!-- FAMILY INFORMATION START -->
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <h2>In case of Emergency</h2>
                                                    <div class="col-lg-4">
                                                        <div class="row">
                                                            <label>Name <span class="text-danger">*</span></label>
                                                            <input id="emergency_name" name="emergency_name" type="text" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="row">
                                                            <label>Address <span class="text-danger">*</span></label>
                                                            <input id="emergency_address" name="emergency_address" type="text" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="row">
                                                            <label>Mobile Number <span class="text-danger">*</span></label>
                                                            <input id="emergency_mobile" name="emergency_mobile" type="text" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                            
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <h2>Family Information</h2>
                                                    <em class="text-success">Note: If Father/Spouse/Child is not available, please leave the fields blank.</em>
                                                
                                                    <table class="table">
                                                        <tr>
                                                            <td>Father</td>
                                                            <td><input id="fathers_name" name="fathers_name" type="text" class="form-control" placeholder="Name"> </td>
                                                            <td><input id="fathers_bday" name="fathers_bday" type="date" class="form-control" > </td>
                                                            <td><input id="fathers_occupation" name="fathers_occupation" type="text" class="form-control" placeholder="Occupation"> </td>
                                                            <td><input id="fathers_employer" name="fathers_employer" type="text" class="form-control" placeholder="Employer"> </td>
                                                            <td><input id="fathers_mobile" name="fathers_mobile" type="text" class="form-control" placeholder="Mobile No."> </td>
                                                            <td><input id="fathers_address" name="fathers_address" type="text" class="form-control" placeholder="Address"> </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mother</td>
                                                            <td><input id="mothers_name" name="mothers_name" type="text" class="form-control required" placeholder="Name"> </td>
                                                            <td><input id="mothers_bday" name="mothers_bday" type="date" class="form-control required" > </td>
                                                            <td><input id="mothers_occupation" name="mothers_occupation" type="text" class="form-control required" placeholder="Occupation"> </td>
                                                            <td><input id="mothers_employer" name="mothers_employer" type="text" class="form-control required" placeholder="Employer"> </td>
                                                            <td><input id="mothers_mobile" name="mothers_mobile" type="text" class="form-control required" placeholder="Mobile No."> </td>
                                                            <td><input id="mothers_address" name="mothers_address" type="text" class="form-control required" placeholder="Address"> </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Spouse</td>
                                                            <td><input id="spouse_name" name="spouse_name" type="text" class="form-control" placeholder="Name"> </td>
                                                            <td><input id="spouse_bday" name="spouse_bday" type="date" class="form-control" > </td>
                                                            <td><input id="spouse_occupation" name="spouse_occupation" type="text" class="form-control" placeholder="Occupation"> </td>
                                                            <td><input id="spouse_employer" name="spouse_employer" type="text" class="form-control" placeholder="Employer"> </td>
                                                            <td><input id="spouse_mobile" name="spouse_mobile" type="text" class="form-control" placeholder="Mobile No."> </td>
                                                            <td><input id="spouse_address" name="spouse_address" type="text" class="form-control" placeholder="Address"> </td>
                                                        </tr>
                                                        <tr class="familyOrigin">
                                                            <td colspan="8">
                                                                <div class="form-group">
                                                                    <label>Children</label>
                                                                    <a id="addFamilyBtn" class="btn btn-primary btn-xs"><i class="fa fa-plus-circle"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                <!-- FAMILY INFORMATION END -->
                                </div>
                                
                                <!--Third tab-->
                                <!-- EDUCATIONAL BACKGROUND START-->
                                <div id="demo-cls-tab3" class="tab-pane">
                                    <fieldset>
                                        <h2>Educational Background <a id="addEducationBtn" class="btn btn-primary btn-xs"><i class="fa fa-plus-circle"></i></a></h2>
                                        <table class="table table-bordered">
                                            <tr class="educationOrigin">
                                                <td><a id="removeEducationBtn" class="btn btn-danger btn-xs"><i class="fa fa-times-circle"></i></a></td>
                                                <td>
                                                    <select class="form-control" id="type">
                                                        <option>---- Select Type ----</option>
                                                        <option>Elementary</option>
                                                        <option>High School</option>
                                                        <option>High School Undergraduate</option>
                                                        <option>College Level</option>
                                                        <option>Vocational</option>
                                                        <option>Post Graduate</option>
                                                    </select>
                                                </td>
                                                <td><input id="school" name="school" type="text" class="form-control" placeholder="Name of School"> </td>
                                                <td><input id="location" name="location" type="text" class="form-control" placeholder="Location"> </td>
                                                <td><input id="degree" name="degree" type="text" class="form-control" placeholder="Major & Degree"> </td>
                                                <td><input id="years" name="years" type="text" class="form-control" placeholder="Years"> </td>
                                            </tr>
                                        </table>
                                    </fieldset>
                                </div>
                                <!-- EDUCATIONAL BACKGROUND END-->
                                
                                <!--Fourth tab-->
                                <!-- WORK EXPERIENCES START-->
                                <div id="demo-cls-tab4" class="tab-pane mar-btm">
                                   <fieldset>
                                        <h2>Work Experience <a id="addWorkBtn" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></a></h2>
                                        <em class="text-success">Note: If applicant has no working experience, please leave the fields blank.</em>
                                        <table class="table table-bordered">
                                            <tr class="workOrigin">
                                                <td colspan="8"> </td>
                                            </tr>
                                        </table>
                                        <h2>References <a id="addReferenceBtn" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></a></h2>
                                        <table class="table table-bordered">
                                            <tr class="referenceOrigin">
                                                <td><a id="removeReferenceBtn" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></a></td>
                                                <td><input id="ref_name" name="ref_name" type="text" class="form-control required" placeholder="Name"> </td>
                                                <td><input id="ref_occupation" name="ref_occupation" type="text" class="form-control required" placeholder="Occupation"> </td>
                                                <td><input id="ref_company" name="ref_company" type="text" class="form-control required" placeholder="Company Name"> </td>
                                                <td><input id="ref_address" name="ref_address" type="text" class="form-control required" placeholder="Address"> </td>
                                                <td><input id="ref_phone" name="ref_phone" type="text" class="form-control required" placeholder="Phone No." data-mask="999-9999"> </td>
                                                <td><input id="ref_email" name="ref_email" type="email" class="form-control required" placeholder="E-mail"> </td>
                                                <td><input id="ref_years" name="ref_years" type="text" class="form-control required" placeholder="Years Acquainted"> </td>
                                            </tr>
                                        </table>
                                    </fieldset>
                                </div>
                                <!-- WORK EXPERIENCES END-->
                            </div>
                        </div>
                        <!--Footer button-->
                        <div class="panel-footer text-right">
                            <div class="box-inline">
                                <button type="button" class="previous btn btn-mint">Previous</button>
                                <button type="button" class="next btn btn-mint">Next</button>
                                <button type="button" class="finish btn btn-mint" disabled>Finish</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!--===================================================-->
                <!-- End Classic Form Wizard -->
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    // CLASSIC STYLE
    // =================================================================
    // expected salary,child_mobile,email, years
    $("#sss").mask("99-9999999-9");
    $("#pagibig").mask("9999-9999-9999");
    $("#philhealth").mask("99-999999999-999");
    $("#tin_number").mask("999-999-999-999");
    $("#mobile_no, #emergency_mobile, #fathers_mobile, #mothers_mobile, #spouse_mobile").mask("(9999)999-9999");
    $("#ref_phone, #employer_phone").mask("999-9999");
    $("#present_zip, #provincial_zip").mask('9999');
    
    var tabindex = 0;
    var tab1;
    var tab2;
    var tab3;
    var tab4;
    var lastname;
    var middlename;
    var nickname;
    var expected_salary;
    var mobile_no;
    var citizenship;
    var position_applied;
    var religion;
    var gender;
    var birthdate;
    var civil_status;
    var birthplace;
    var sss;
    var pagibig;
    var philhealth;
    var tin_number;
    var present_address;
    var present_city;
    var present_province;
    var present_zip;
    var same_address;
    var provincial_address;
    var provincial_city;
    var provincial_province;
    var provincial_zip;
    // tab 2
    var emergency_name;
    var emergency_address;
    var emergency_mobile;
    var fathers_name;
    var fathers_bday;
    var fathers_occupation;
    var fathers_employer;
    var fathers_mobile;
    var fathers_address;
    var mothers_name;
    var mothers_bday;
    var mothers_occupation;
    var mothers_employer;
    var mothers_mobile;
    var mothers_address
    var spouse_name;
    var spouse_bday;
    var spouse_occupation;
    var spouse_employer;
    var spouse_mobile;
    var spouse_address;
    var added_child_name = [];
    var added_child_bday = [];
    var added_child_occupation = [];
    var added_child_mobile = [];
    var added_child_address = [];
    // tab 3
    var type;
    var school;
    var location;
    var degree;
    var years;
    var added_type = [];
    var added_school = [];
    var added_location = [];
    var added_degree = [];
    var added_years = [];
    // tab 4
    var ref_name;
    var ref_occupation;
    var ref_company;
    var ref_address;
    var ref_phone;
    var ref_email;
    var ref_years;
    var employer_name = [];
    var employer_address = [];
    var employer_phone = [];
    var employer_supervisor = [];
    var employer_salary = [];
    var employer_job = [];
    var employer_reason = [];
    var added_ref_name = [];
    var added_ref_occupation = [];
    var added_ref_company = [];
    var added_ref_address = [];
    var added_ref_phone = [];
    var added_ref_email = [];
    var added_ref_years = [];
    
    $('#demo-cls-wz').bootstrapWizard({
        tabClass: 'wz-classic',
        nextSelector: '.next',
        previousSelector: '.previous',
        onNext: function(tab, navigation, index) {
            // var retval = true; // For Testing
            var retval = false;
            // tab 1
            lastname = $("#lastname");
            middlename = $("#middlename");
            nickname = $("#nickname");
            expected_salary = $("#expected_salary");
            mobile_no = $("#mobile_no");
            citizenship = $("#citizenship");
            position_applied = $("#position_applied");
            religion = $("#religion");
            gender = $("#gender");
            birthdate = $("#birthdate");
            civil_status = $("#civil_status");
            birthplace = $("#birthplace");
            sss = $("#sss");
            pagibig = $("#pagibig");
            philhealth = $("#philhealth");
            tin_number = $("#tin_number");
            present_address = $("#present_address");
            present_city = $("#present_city");
            present_province = $("#present_province");
            present_zip = $("#present_zip");
            same_address = $("#same_address");
            provincial_address = $("#provincial_address");
            provincial_city = $("#provincial_city");
            provincial_province = $("#provincial_province");
            provincial_zip = $("#provincial_zip");
            // tab 2
            emergency_name = $("#emergency_name");
            emergency_address = $("#emergency_address");
            emergency_mobile = $("#emergency_mobile");
            fathers_name = $("#fathers_name");
            fathers_bday = $("#fathers_bday");
            fathers_occupation = $("#fathers_occupation");
            fathers_employer = $("#fathers_employer");
            fathers_mobile = $("#fathers_mobile");
            fathers_address = $("#fathers_address");
            mothers_name = $("#mothers_name");
            mothers_bday = $("#mothers_bday");
            mothers_occupation = $("#mothers_occupation");
            mothers_employer = $("#mothers_employer");
            mothers_mobile = $("#mothers_mobile");
            mothers_address = $("#mothers_address");
            spouse_name = $("#spouse_name");
            spouse_bday = $("#spouse_bday");
            spouse_occupation = $("#spouse_occupation");
            spouse_employer = $("#spouse_employer");
            spouse_mobile = $("#spouse_mobile");
            spouse_address = $("#spouse_address");
            added_child_name = $("input#added_child_name").map(function(){return $(this).val();}).get();
            added_child_bday = $("input#added_child_bday").map(function(){return $(this).val();}).get();
            added_child_occupation = $("input#added_child_occupation").map(function(){return $(this).val();}).get();
            added_child_mobile = $("input#added_child_mobile").map(function(){return $(this).val();}).get();
            added_child_address = $("input#added_child_address").map(function(){return $(this).val();}).get();
            // tab 3
            type = $("#type");
            school = $("#school");
            location = $("#location");
            degree = $("#degree");
            years = $("#years");
            added_type = $("select#added_type").map(function(){return $(this).val();}).get();
            added_school = $("input#added_school").map(function(){return $(this).val();}).get();
            added_location = $("input#added_location").map(function(){return $(this).val();}).get();
            added_degree = $("input#added_degree").map(function(){return $(this).val();}).get();
            added_years = $("input#added_years").map(function(){return $(this).val();}).get();
            
            if(index==2) {
                if(emergency_name.val()!="") {
                    if(emergency_address.val()!="") {
                        if(emergency_mobile.val()!="") {
                            retval = true;
                        }
                        else {
                            emergency_mobile.css({'border-color':'red'}).focus();
                        }
                    }
                    else {
                        emergency_address.css({'border-color':'red'}).focus();
                    }
                }
                else {
                    emergency_name.css({'border-color':'red'}).focus();
                }
            }
            else if(index==3) {
                if(type.val()!="---- Select Type ----") {
                    if(school.val()!="") {
                        if(location.val()!="") {
                            if(degree.val()!="") {
                                if(years.val()!="") {
                                    retval = true;
                                }
                                else{
                                    years.css({'border-color':'red'}).focus();
                                }
                            }
                            else {
                                degree.css({'border-color':'red'}).focus();
                            }
                        }
                        else {
                            location.css({'border-color':'red'}).focus();
                        }
                    }
                    else {
                        school.css({'border-color':'red'}).focus();
                    }
                }
                else {
                    type.css({'border-color':'red'}).focus();
                }
            }
            else {
                if(lastname.val()!="") {
                    if(middlename.val()!="") {
                        if(expected_salary.val()!="") {
                            if(mobile_no.val()!="") {
                                if(citizenship.val()!="") {
                                    if(position_applied.val()!="") {
                                        if(religion.val()!="") {
                                            if(gender.val()!="---- Select Gender ----") {
                                                if(civil_status.val()!="---- Select Civil Status ----") {
                                                    if(birthplace.val()!="") {
                                                        if(sss.val()!="") {
                                                            if(pagibig.val()!="") {
                                                                if(philhealth.val()!="") {
                                                                    if(tin_number.val()!="") {
                                                                        if(present_address.val()!="") {
                                                                            if(present_city.val()!="") {
                                                                                if(present_province.val()!="") {
                                                                                    if(present_zip.val()!="") {
                                                                                        if(same_address.is(":checked")) {
                                                                                            if(provincial_address.val()!="") {
                                                                                                if(provincial_city.val()!="") {
                                                                                                    if(provincial_province.val()!="") {
                                                                                                        if(provincial_zip.val()!="") {
                                                                                                            retval = true;
                                                                                                        }
                                                                                                        else {
                                                                                                            provincial_zip.css({'border-color':'red'}).focus();
                                                                                                        }
                                                                                                    }
                                                                                                    else {
                                                                                                        provincial_province.css({'border-color':'red'}).focus();
                                                                                                    }
                                                                                                }
                                                                                                else {
                                                                                                    provincial_city.css({'border-color':'red'}).focus();
                                                                                                }
                                                                                            }
                                                                                            else {
                                                                                                provincial_address.css({'border-color':'red'}).focus();
                                                                                            }
                                                                                        }
                                                                                        else {
                                                                                            retval = true;
                                                                                        }
                                                                                    }
                                                                                    else {
                                                                                        present_zip.css({'border-color':'red'}).focus();
                                                                                    }
                                                                                }
                                                                                else {
                                                                                    present_province.css({'border-color':'red'}).focus();
                                                                                }
                                                                            }
                                                                            else {
                                                                                present_city.css({'border-color':'red'}).focus();
                                                                            }
                                                                        }
                                                                        else {
                                                                            present_address.css({'border-color':'red'}).focus();
                                                                        }
                                                                    }
                                                                    else {
                                                                        tin_number.css({'border-color':'red'}).focus();
                                                                    }
                                                                }
                                                                else {
                                                                    philhealth.css({'border-color':'red'}).focus();
                                                                }
                                                            }
                                                            else {
                                                                pagibig.css({'border-color':'red'}).focus();
                                                            }
                                                        }
                                                        else {
                                                            sss.css({'border-color':'red'}).focus();
                                                        }
                                                    }
                                                    else {
                                                        birthplace.css({'border-color':'red'}).focus();
                                                    }
                                                }
                                                else {
                                                    civil_status.css({'border-color':'red'}).focus();
                                                }
                                            }
                                            else {
                                                gender.css({'border-color':'red'}).focus();
                                            }
                                        }
                                        else {
                                            religion.css({'border-color':'red'}).focus();
                                        }
                                    }
                                    else {
                                        position_applied.css({'border-color':'red'}).focus();
                                    }
                                }
                                else {
                                    citizenship.css({'border-color':'red'}).focus();
                                }
                            }
                            else {
                                mobile_no.css({'border-color':'red'}).focus();
                            }
                        }
                        else {
                            expected_salary.css({'border-color':'red'}).focus();
                        }
                    }
                    else {
                        middlename.css({'border-color':'red'}).focus();
                    }
                }
                else {
                    lastname.css({'border-color':'red'}).focus();
                }
            }
            
            
            tab1 = {
                "lastname": lastname.val(), 
                "middlename": middlename.val(), 
                "nickname": nickname.val(), 
                "expected_salary": expected_salary.val(), 
                "mobile_no": mobile_no.val(), 
                "citizenship": citizenship.val(), 
                "position_applied": position_applied.val(), 
                "religion": religion.val(), 
                "gender": gender.val(), 
                "birthdate": birthdate.val(), 
                "civil_status": civil_status.val(), 
                "birthplace": birthplace.val(), 
                "sss": sss.val(), 
                "pagibig": pagibig.val(), 
                "philhealth": philhealth.val(), 
                "tin_number": tin_number.val(), 
                "present_address": present_address.val(), 
                "present_city": present_city.val(), 
                "present_province": present_province.val(), 
                "present_zip": present_zip.val(), 
                "same_address": same_address.is(":checked"), 
                "provincial_address": provincial_address.val(), 
                "provincial_city": provincial_city.val(), 
                "provincial_province": provincial_province.val(), 
                "provincial_zip": provincial_zip.val()
            };
            tab2 = {
                "emergency_name": emergency_name.val(), 
                "emergency_address": emergency_address.val(), 
                "emergency_mobile": emergency_mobile.val(), 
                "fathers_name": fathers_name.val(), 
                "fathers_bday": fathers_bday.val(),
                "fathers_occupation": fathers_occupation.val(), 
                "fathers_employer": fathers_employer.val(), 
                "fathers_mobile": fathers_mobile.val(), 
                "fathers_address": fathers_address.val(), 
                "mothers_name": mothers_name.val(), 
                "mothers_bday": mothers_bday.val(), 
                "mothers_occupation": mothers_occupation.val(), 
                "mothers_employer": mothers_employer.val(), 
                "mothers_mobile": mothers_mobile.val(), 
                "mothers_address": mothers_address.val(), 
                "spouse_name": spouse_name.val(), 
                "spouse_bday": spouse_bday.val(), 
                "spouse_occupation": spouse_occupation.val(), 
                "spouse_employer": spouse_employer.val(), 
                "spouse_mobile": spouse_mobile.val(), 
                "spouse_address": spouse_address.val(),
                "added_child_name": added_child_name, 
                "added_child_bday": added_child_bday,
                "added_child_occupation": added_child_occupation, 
                "added_child_mobile": added_child_mobile, 
                "added_child_address": added_child_address
            };
            tab3 = {
                "type": type.val(), 
                "school": school.val(), 
                "location": location.val(), 
                "degree": degree.val(), 
                "years": years.val(),
                "added_type": added_type, 
                "added_school": added_school, 
                "added_location": added_location, 
                "added_degree": added_degree, 
                "added_years": added_years
            };
            
            return retval;
        },
        onTabClick: function(tab, navigation, index) {
            return false;
        },
        onInit: function() {
            $('#demo-cls-wz').find('.finish').hide().prop('disabled', true);
        },
        onTabShow: function(tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index + 1;
            var $percent = ($current / $total) * 100;
            var wdt = 100 / $total;
            var lft = wdt * index;
            $('#demo-cls-wz').find('.progress-bar').css({ width: $percent + '%' });
    
            // If it's the last tab then hide the last button and show the finish instead
            if ($current >= $total) {
                $('#demo-cls-wz').find('.next').hide();
                $('#demo-cls-wz').find('.finish').show();
                $('#demo-cls-wz').find('.finish').prop('disabled', false);
            } else {
                $('#demo-cls-wz').find('.next').show();
                $('#demo-cls-wz').find('.finish').hide().prop('disabled', true);
            } 
        }
    });
    
    $(".finish").on('click', function() {
        ref_name = $("#ref_name");
        ref_occupation = $("#ref_occupation");
        ref_company = $("#ref_company");
        ref_address = $("#ref_address");
        ref_phone = $("#ref_phone");
        ref_email = $("#ref_phine");
        ref_years = $("#ref_years");
        
        if(ref_name.val()!="") {
            if(ref_occupation.val()!="") {
                if(ref_company.val()!="") {
                    if(ref_address.val()!="") {
                        if(ref_phone.val()!="") {
                            if(ref_email.val()!="") {
                                if(ref_years.val()!="") {
                                    //tab 4
                                    employer_name = $("input#employer_name").map(function(){return $(this).val();}).get();
                                    employer_address = $("input#employer_address").map(function(){return $(this).val();}).get();
                                    employer_phone = $("input#employer_phone").map(function(){return $(this).val();}).get();
                                    employer_supervisor = $("input#employer_supervisor").map(function(){return $(this).val();}).get();
                                    employer_salary = $("input#employer_salary").map(function(){return $(this).val();}).get();
                                    employer_job = $("input#employer_job").map(function(){return $(this).val();}).get();
                                    employer_reason = $("textarea#employer_reason").map(function(){return $(this).val();}).get();
                                    ref_name = $("#ref_name").val();
                                    ref_occupation = $("#ref_occupation").val();
                                    ref_company = $("#ref_company").val();
                                    ref_address = $("#ref_address").val();
                                    ref_phone = $("#ref_phone").val();
                                    ref_email = $("#ref_email").val();
                                    ref_years = $("#ref_years").val();
                                    added_ref_name = $("input#added_ref_name").map(function(){return $(this).val();}).get();
                                    added_ref_occupation = $("input#added_ref_occupation").map(function(){return $(this).val();}).get();
                                    added_ref_company = $("input#added_ref_company").map(function(){return $(this).val();}).get();
                                    added_ref_address = $("input#added_ref_address").map(function(){return $(this).val();}).get();
                                    added_ref_phone = $("input#added_ref_phone").map(function(){return $(this).val();}).get();
                                    added_ref_email = $("input#added_ref_email").map(function(){return $(this).val();}).get();
                                    added_ref_years = $("input#added_ref_years").map(function(){return $(this).val();}).get();
                                    
                                    tab4 = {
                                        "employer_name": employer_name,
                                        "employer_address": employer_address,
                                        "employer_phone": employer_phone,
                                        "employer_supervisor": employer_supervisor,
                                        "employer_salary": employer_salary,
                                        "employer_job": employer_job,
                                        "employer_reason": employer_reason,
                                        "ref_name": ref_name,
                                        "ref_occupation": ref_occupation,
                                        "ref_company": ref_address,
                                        "ref_address": ref_address,
                                        "ref_phone": ref_phone,
                                        "ref_email": ref_email,
                                        "ref_years": ref_years,
                                        "added_ref_name": added_ref_name,
                                        "added_ref_occupation": added_ref_occupation,
                                        "added_ref_company": added_ref_company,
                                        "added_ref_address": added_ref_address,
                                        "added_ref_phone": added_ref_phone,
                                        "added_ref_email": added_ref_email,
                                        "added_ref_years": added_ref_years
                                    };

                                    var data_tmp = {"tab1":tab1,"tab2":tab2,"tab3":tab3, "tab4":tab4};
                                    var data = JSON.stringify(data_tmp);
                                    
                                    $.ajax({
                                      url: "/employee_details/save_employee_details",
                                      type: "POST",
                                      data: {"data": data},
                                      dataType: "text",
                                      success: function(success) {
                                          console.log(success);
                                          swal({
                                            title: "Success!",
                                            text: "Details saved.",
                                            type: "success"
                                          },
                                          function(isConfirm) {
                                                  window.location.reload();
                                          });
                                      },
                                      error: function(error) {
                                          console.log(error);
                                      }
                                    });
                                }
                                else {
                                    ref_years.css({'border-color':'red'}).focus();
                                }
                            }
                            else {
                                ref_email.css({'border-color':'red'}).focus();
                            }
                        }
                        else {
                            ref_phone.css({'border-color':'red'}).focus();
                        }
                    }
                    else {
                        ref_address.css({'border-color':'red'}).focus();
                    }
                }
                else {
                    ref_company.css({'border-color':'red'}).focus();
                }
            }
            else {
                ref_occupation.css({'border-color':'red'}).focus();
            }
        }
        else {
            ref_name.css({'border-color':'red'}).focus();
        }
    
    });
    
///////////// Add References Start /////////////////////////////////
    $(document).on('click','#addReferenceBtn',function(){
        is_reference_added = true;
        var original = '<td><a id="removeReferenceBtn" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></a></td>'+
                        '<td><input id="added_ref_name" name="ref_name" type="text" class="form-control required" placeholder="Name"> </td>'+
                        '<td><input id="added_ref_occupation" name="ref_occupation" type="text" class="form-control required" placeholder="Occupation"> </td>'+
                        '<td><input id="added_ref_company" name="ref_company" type="text" class="form-control required" placeholder="Company Name"> </td>'+
                        '<td><input id="added_ref_address" name="ref_address" type="text" class="form-control required" placeholder="Address"> </td>'+
                        '<td><input id="added_ref_phone" name="ref_phone" type="text" class="form-control required" placeholder="Phone No." data-mask="999-9999"> </td>'+
                        '<td><input id="added_ref_email" name="ref_email" type="email" class="form-control required" placeholder="E-mail"> </td>'+
                        '<td><input id="added_ref_years" name="ref_years" type="text" class="form-control required" placeholder="Years Acquainted"> </td>';
        $("<tr class='added_reference'>" + original + "</tr>").insertAfter($(".referenceOrigin").closest("tr"));
    });

    $(document).on('click','#removeReferenceBtn',function(){
        $(this).closest('.added_reference').remove();
    });

///////////// Add References End /////////////////////////////////

///////////// Add Work Start /////////////////////////////////
    $(document).on('click','#addWorkBtn',function(){
        is_work_added = true;
        $('<tr class="added_work">' +
                '<td><a id="removeWorkBtn" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></a></td>' +
                '<td><input id="employer_name" name="employer_name" type="text" class="form-control required" placeholder="Employer">' +
                '<td><input id="employer_address" name="employer_address" type="text" class="form-control required" placeholder="Address"> </td>' +
                '<td><input id="employer_phone" name="employer_phone" type="text" class="form-control required" placeholder="Phone No." data-mask="999-9999"> </td> ' +
                '<td><input id="employer_supervisor" name="employer_dates" type="text" class="form-control required" placeholder="Supervisor"> </td> ' +
                '<td><input id="employer_salary" name="employer_salary" type="text" class="form-control numonly required" placeholder="Salary"> </td> ' +
                '<td><input id="employer_job" name="employer_job" type="text" class="form-control required" placeholder="Job Title"> </td> ' +
                '<td><textarea id="employer_reason" name="employer_reason"  class="form-control required" placeholder="Reason"></textarea> </td> ' +
                '</tr> ').insertAfter($(".workOrigin").closest("tr"));
    });

    $(document).on('click','#removeWorkBtn',function(){
        $(this).closest('.added_work').remove();
    });

///////////// Add Work End /////////////////////////////////

///////////// Add Education Start /////////////////////////////////
    $(document).on('click','#addEducationBtn',function(){
        is_education_added = true;
        var original = '<td><a id="removeEducationBtn" class="btn btn-danger btn-xs"><i class="fa fa-times-circle"></i></a></td>'+
                        '<td>'+
                            '<select class="form-control" id="added_type">'+
                                '<option>---- Select Type ----</option>'+
                                '<option>Elementary</option>'+
                                '<option>High School</option>'+
                                '<option>High School Undergraduate</option>'+
                                '<option>College Level</option>'+
                                '<option>Vocational</option>'+
                                '<option>Post Graduate</option>'+
                            '</select>'+
                        '</td>'+
                        '<td><input id="added_school" name="school" type="text" class="form-control" placeholder="Name of School"> </td>'+
                        '<td><input id="added_location" name="location" type="text" class="form-control" placeholder="Location"> </td>'+
                        '<td><input id="added_degree" name="degree" type="text" class="form-control" placeholder="Major & Degree"> </td>'+
                        '<td><input id="added_years" name="years" type="text" class="form-control" placeholder="Years"> </td>';
        $("<tr class='added_education'>" + original + "</tr>").insertAfter($(".educationOrigin").closest("tr"));
    });

    $(document).on('click','#removeEducationBtn',function(){
        $(this).closest('.added_education').remove();
    });

///////////// Add Education End /////////////////////////////////

///////////// Add Children Start /////////////////////////////////
    $(document).on('click','#addFamilyBtn',function(){
        $(' <tr class="added"> ' +
                '<td><a id="removeFamilyBtn" class="btn btn-danger btn-xs"><i class="fa fa-times-circle"></i></a></td>' +
                '<td colspan="2"> <input id="added_child_name" name="child_name" type="text" class="form-control required" placeholder="Name"> </td>' +
                '<td> <input id="added_child_bday" name="child_bday" type="date" class="form-control required" placeholder="Name"> </td>' +
                '<td> <input id="added_child_occupation" name="child_occupation" type="text" class="form-control required" placeholder="Occupation"> </td>' +
                '<td> <input id="added_child_mobile" name="child_mobile" type="text" class="form-control required" placeholder="Mobile No."> </td>' +
                '<td> <input id="added_child_address" name="child_address" type="text" class="form-control required" placeholder="Address"> </td>' +
                '</tr>').insertAfter( $(".familyOrigin").closest( "tr" ) );
    });

    $(document).on('click','#removeFamilyBtn',function(){
        $(this).closest('.added').remove();
    });
///////////// Add Children End /////////////////////////////////

///////////// Different Provincial Address Start /////////////////////////////////
    $(document).on('change','#same_address',function(){
        if(this.checked){
            $('.ProvincialAddress').last().append('<div class="ProvincialAddressAddnl"><div class="col-sm-4">' +
                    '<div class="row"><input type="text" name="provincial_address" id="provincial_address" class="form-control required" placeholder="No./Street/Brgy./District & Municipality">' +
                    '</div></div><div class="col-sm-4">' +
                    '<div class="row"><input type="text" name="provincial_city" id="provincial_city" class="form-control required" placeholder="City">' +
                    '</div></div><div class="col-sm-2"><div class="row">' +
                    '<input type="text" name="provincial_province" id="provincial_province" class="form-control required" placeholder="Province"></div></div>' +
                    '<div class="col-sm-2"><div class="row">' +
                    '<input type="text" name="provincial_zip" id="provincial_zip" class="form-control required numonly" placeholder="Zip Code"></div></div></div>');
        }else{
            $('.ProvincialAddressAddnl').remove();
        }
    });
///////////// Different Provincial Address End /////////////////////////////////

});
///////////// Wizard End /////////////////////////////////

</script>
@stop