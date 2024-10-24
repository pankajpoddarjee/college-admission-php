<table class="table table-bordered table-striped">
    <tbody>
        <!--<tr>
            <td class="TD1">ID #</td>
            <td class="TD2"><a href="<?php echo BASE_URL;?>/<?php echo $folder_name;?>/<?php echo $file_name;?>" title="										<?php echo strtolower ($college_name);?>"></a></td>
        </tr>-->
        <tr>
            <td class="TD1">College Code</td>
            <td class="TD2"><?php echo $record['college_code'];?></td>
        </tr>
        <tr>
            <td class="TD1">College Name</td>
            <td class="TD2"><?php echo $record['college_name'];?></td>
        </tr>
        <tr>
            <td class="TD1">Other Name</td>
            <td class="TD2"><?php echo $record['other_name'];?></td>
        </tr>
        <tr>
            <td class="TD1">Established</td>
            <td class="TD2"><?php echo $record['eshtablish'];?></td>
        </tr>
        <tr>
            <td class="TD1">Type</td>
            <td class="TD2"><?php echo $record['college_type_name'];?></td>
        </tr>
        <tr>
            <td class="TD1">Undertaking</td>
            <td class="TD2"><?php echo $record['undertaking_name'];?></td>
        </tr>
        <tr>
            <td class="TD1">Landmark</td>
            <td class="TD2"><?php echo $record['landmark'];?></td>
        </tr>
        <tr>
            <td class="TD1">City</td>
            <td class="TD2"><?php echo $record['city_name'];?></td>
        </tr>
        <tr>
            <td class="TD1">State</td>
            <td class="TD2"><?php echo $record['state_name'];?></td>
        </tr>
        <tr>
            <td class="TD1">Country</td>
            <td class="TD2"><?php echo $record['country_name'];?></td>
        </tr>
        <!-- <tr>
            <td class="TD1">Course Type</td>
            <td class="TD2"><?php //echo $courseName;?> (<?php //echo $courseCode;?>)</td>
        </tr> -->
        <tr>
            <td class="TD1">Affiliation</td>
            <td class="TD2"><?php echo $record['university_name'];?></td>
        </tr>
        <tr>
            <td class="TD1">Accreditation / Recognition</td>
            <td class="TD2"><?php echo $record['accreditation'];?></td>
        </tr>
    </tbody>
</table>