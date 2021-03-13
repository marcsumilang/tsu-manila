<?php 
    $contact_us_json = file_get_contents(SERVER_NAME.'cms/wp-json/wp/v2/pages?slug=contact-us');
    $contact_us_page = json_decode($contact_us_json);
    $contact_us_page = $contact_us_page[0];
    $drop_down = explode(';',$contact_us_page->acf->drop_down_menu);
?> 

<script type="text/x-template" id="contact-us">
    <div id='contact-us-content' class='inner-container'>
        <h2>CONTACT US</h2>
        <br/>
        <div class='title margin-30 text-center' style='color:#000;'>We want to hear from you.</div>
        <div class='subtitle text-center' style='color:#585858;'>Please do not hesitate to contact us for whatever.</div>
        <br/><br/>
        <div class='team-container'>

            <?php
                $contactUsTeam = "";
                for($i=0 ; $i<count($members); $i++){
                    if($members[$i]->acf->contact_us_featured != false){
                        $contactUsTeam .= "
                        <div class='team-member'>
                            <div class='image-container' style='background-image:url(".$members[$i]->acf->image.");'></div>
                            <div class='description'>
                                <div class='name'>".$members[$i]->acf->name."</div>
                                <div class='position'>".$members[$i]->acf->position."</div>";
                       
                        if(isset($members[$i]->acf->email)){
                            $contactUsTeam .= "<div class='email'>".$members[$i]->acf->email."</div>";
                        }  

                        $contactUsTeam .= "   </div>
                        </div>";
                    }
                }
                echo $contactUsTeam;
            ?>
        </div>
        <div id='map-form-container'>
            
            <form id='contact-form' method='POST' action='send-email.php' ref='contactUsForm'>
                <?php
                    if(isset($_SESSION['contact_form_status'])){
                        if($_SESSION['contact_form_status']){
                            echo "<p  class='fjalla' style='font-size:1em; color:#B20614;'>".$contact_us_page->acf->message_sent_notification."</p>";
                        }
                        else{
                            echo "<p class='fjalla' style='font-size:1em; color:#B20614;'>".$contact_us_page->acf->message_failed_notification."</p>";
                        }
                        echo '<br/>';
                        unset($_SESSION['contact_form_status']);
                    }
                ?>
                <select v-model='formData.about.value' name='about' v-on:change='valueChanged("about")' v-bind:class='{invalid: !checkIfValid(formData.about)}'>
                    <option class='disabled' selected="true" disabled="disabled" value=''>What can we help you with?</option>
                    <?php
                        for($i=0; $i<count($drop_down); $i++){
                            echo '<option value="'.$drop_down[$i].'">'.$drop_down[$i].'</option>';
                        }
                    ?>
                    <!-- <option>General Inquiry</option> -->
                    <!-- <option>Collaborations & Partnerships</option> -->
                </select>
                <div class='auto-spacing'>
                    <input class='half-width' type='text' name='name' placeholder='Name' v-model='formData.name.value' v-on:change='valueChanged("name")' v-bind:class='{invalid: !checkIfValid(formData.name)}'/>
                    <input class='half-width' type='email' name='email' placeholder='Email' v-model='formData.email.value' v-on:change='valueChanged("email")' v-bind:class='{invalid: !isEmail(formData.email)}' />
                </div>
                <input type='text' placeholder='Subject' name='subject' v-model='formData.subject.value' v-on:change='valueChanged("subject")' v-bind:class='{invalid: !checkIfValid(formData.subject)}'/>
                <input type='hidden' name='recipient' value='<?php echo $contact_us_page->acf->form_email_recipients; ?>' />
                <textarea v-model='formData.body.value' name='body' v-on:change='valueChanged("body")' v-bind:class='{invalid: !checkIfValid(formData.body)}'>

                </textarea>
                <div class='button' style='background-color:#B20614; color:white; margin:auto;' v-on:click='checkForm()'>Send Message</div>
            </form>
            <div class='map-container'>
                <div class="mapouter">
                    <div class="gmap_canvas">
                        <iframe id="gmap_canvas" src="https://maps.google.com/maps?q=G%26A%20Building&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                    </div>
                </div>
                <br/>
                <p class='subtitle' style='color:#585858;'><?php 
                    echo $contact_us_page->acf->address;
                ?></p><br/>
                <p class='subtitle' style='color:#585858;'><?php 
                    echo $contact_us_page->acf->footer_message;
                ?></p>
            </div>
        </div>

        
        <br/><br/>
        <!-- <p class='subtitle text-center' style='color:#585858;'>For inquiries on career opportunities and internships, <br/>
            email: info@thissideupmanila.com</p> -->
        
        <?php echo $bottomNavigation;?>
    </div>
</script>
