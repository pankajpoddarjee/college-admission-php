<div class="row justify-content-center mt-1">
    <div class="col-md-12">
        <table class="table table-bordered links1">
            <tbody>
                <tr>
                    <td class="TD1"><i class="fa-solid fa-map-location-dot"></i> Address</td>
                    <td class="TD2"><?php echo $address;?></td>
                </tr>
                <tr>
                    <td class="TD1"><i class="fa-solid fa-city"></i> City</td>
                    <td class="TD2"><?php echo $city_name;?></td>
                </tr>
                <tr>
                    <td class="TD1"><i class="fa-solid fa-landmark-flag"></i> State</td>
                    <td class="TD2"><?php echo $state_name;?></td>
                </tr>
                <tr>
                    <td class="TD1"><i class="fa-solid fa-flag"></i> Country</td>
                    <td class="TD2"><?php echo $country_name;?></td>
                </tr>
                <tr>
                    <td class="TD1"><i class="fa-solid fa-at"></i> E-mail Id</td>
                    <td class="TD2"><a href="mailto:<?php echo $email;?>" title="<?php echo strtolower ($college_name);?> official email"><?php echo $email;?></a> | <a href="mailto:<?php echo $email2;?>" title="<?php echo strtolower ($college_name);?> official email"><?php echo $email2;?></a></td>
                </tr>
                <tr>
                    <td class="TD1"><i class="fa-solid fa-earth-asia"></i> Website</td>
                    <td class="TD2"><a href="<?php echo $websiteURL;?>" title="<?php echo strtolower ($college_name);?> official website" target="_blank"><?php echo $websiteDisplay;?></a></td>
                </tr>
                <tr>
                    <td class="TD1"><i class="fa-solid fa-square-phone"></i> Phone</td>
                    <td class="TD2"><?php echo $phone;?></td>
                </tr>                
            </tbody>
        </table>
    </div>
</div>

<div class="row justify-content-center mt-2 mb-4">
    <div class="col-md-4 text-center">
        <a class="btn btn-secondary" href="https://maps.google.com/maps?q=<?php echo $college_name;?> <?php echo $city_name;?>" target="_blank">
        <i class="fa-solid fa-location-arrow"></i> Find us on <i class="fa-brands fa-google"></i>oogle Map
        </a>
    </div>
</div>