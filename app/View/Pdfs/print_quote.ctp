<body style="font-family: serif; font-size: 9pt;A_CSS_ATTRIBUTE:all;position: absolute;top: 25px; left:150; right:150; ">
    <?php //echo $terms_info; ?>
     
<p  style="margin-top: 30px;font-size:12px"> <b> Terms and Conditions </b> </p>
<?php echo $terms; ?> 
<p>We would like to thank you for giving us the opportunity to serve you. </p> 
<p>We hope to hear your confirmation soon.</p><br/><br/><br/><br/><br/> 

<table align="center" width="1000">
    <tr>
        <td width="300" align="left">
            <p  style=" width:500 ">Very Truly yours,</p><br/><br/>
            <img src="../img/employee_signatures/<?php echo $agent_signature; ?>" class="signature"
                 style="margin-top:-15px;width:70px;margin-left:50px;margin-bottom:-15px;"/>
             <p> ___________________________________________</p>
            <p> <?php echo $prepared_by; ?> - Account Executive</p> 
        </td>
        <td width="300">
            <p >Acceptance Signature (Sign Below),</p><br/><br/><br/><br/><br/> 
             <p> ___________________________________________</p>
            <p> <?php echo $contact_person; ?> - Client Name </p> 
        </td>
    </tr>
    <tr>
        <td width="300" align="left" style="padding-top:30px">
            <p >Approved by:</p><br/><br/>
            <img src="../img/employee_signatures/<?php echo $team_signature; ?>" class="signature" 
                 style="margin-top:-15px;width:70px;margin-left:50px;margin-bottom:-15px;"/>
             <p> ___________________________________________</p>
            <p> <?php echo $team_manager; ?> - Sales Manager</p> 
        </td> 
    </tr>
</table>
 
</body>