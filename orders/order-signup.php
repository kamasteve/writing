<table width="95%" align="center" class="td_borders">
<tr>
  <td colspan="2"  class="sec_titles">Sign Up Details</td>
  </tr> <br>
  <tr>  <td colspan="2">&nbsp;</td> </tr> 
  <tr>
    <td><label for="firstname">First name:<font color="reqStar"><strong>&nbsp;*</strong></font></label></td>
    <td><input id="firstname" name="firstname" class="required" type="text"><div id="err_firstname"></div></td>
    </tr>
  <tr>
    <td><label for="lastname">Last name:<font color="reqStar"><strong>&nbsp;*</strong></font></label></td>
    <td><input id="lastname" name="lastname"  class="required" type="text"><div id="err_lastname"></div></td>
    </tr>
  <tr>
    <td><label for="email">Email:<font color="reqStar"><strong>&nbsp;*</strong></font></label></td>
    <td>
<input id="email" name="email"class="required email" type="text" onChange='$("#checkemail").html("Please wait..."); $.get("../checkuser.php",{ cmd_email: "checkTheEmail", user_email: $("#email").val() } ,function(data){  $("#checkemail").html(data); }); isEmail()'  > 
<span style="color:green; font: bold 12px Verdana, Arial, Helvetica, sans-serif;" id="checkemail" ></span></td>
    </tr>
  <tr>
	<td ><div align="left">Username:<font color="reqStar"><strong>&nbsp;*</strong></font>&nbsp;</div></td>
	<td>
<input name="username" type="text" id="username" class="required username" minlength="6" onChange='$("#checkid").html("Please wait..."); $.get("../checkuser.php",{ cmd: "check", user: $("#username").val() } ,function(data){  $("#checkid").html(data); }); isValidUsername()'> 
<span style="color:green; font: bold 12px Verdana, Arial, Helvetica, sans-serif;" id="checkid" ></span>	</td>
</tr>
<tr>
	<td> <div align="left">Choose a password:<font color="reqStar"><strong>&nbsp;*</strong></font>&nbsp;</div></td>
	<td><input name="pwd" id="pwd" value="" style="width: 200px;" minlength="6" class="required password" type="password"></td>
	</tr>
<tr>
	<td> <div align="left">Re-enter password:<font color="reqStar"><strong>&nbsp;*</strong></font>&nbsp;</div></td>
	<td><input name="pwd2"   id="pwd2" style="width: 200px;"  class="required password" type="password" minlength="6" equalto="#pwd"></td>
	</tr>  
  <tr>
    <td>Country<font color="reqStar"><strong>&nbsp;*</strong></font></td>
    <td><div>
      <select name="country" class="required" id="country">
        <option value="" selected></option>
        <option value="Afghanistan">Afghanistan</option>
        <option value="Albania">Albania</option>
        <option value="Algeria">Algeria</option>
        <option value="Andorra">Andorra</option>
        <option value="Anguila">Anguila</option>
        <option value="Antarctica">Antarctica</option>
        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
        <option value="Argentina">Argentina</option>
        <option value="Armenia ">Armenia </option>
        <option value="Aruba">Aruba</option>
        <option value="Australia">Australia</option>
        <option value="Austria">Austria</option>
        <option value="Azerbaidjan">Azerbaidjan</option>
        <option value="Bahamas">Bahamas</option>
        <option value="Bahrain">Bahrain</option>
        <option value="Bangladesh">Bangladesh</option>
        <option value="Barbados">Barbados</option>
        <option value="Belarus">Belarus</option>
        <option value="Belgium">Belgium</option>
        <option value="Belize">Belize</option>
        <option value="Bermuda">Bermuda</option>
        <option value="Bhutan">Bhutan</option>
        <option value="Bolivia">Bolivia</option>
        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
        <option value="Brazil">Brazil</option>
        <option value="Brunei">Brunei</option>
        <option value="Bulgaria">Bulgaria</option>
        <option value="Cambodia">Cambodia</option>
        <option value="Canada">Canada</option>
        <option value="Cape Verde">Cape Verde</option>
        <option value="Cayman Islands">Cayman Islands</option>
        <option value="Chile">Chile</option>
        <option value="China">China</option>
        <option value="Christmans Islands">Christmans Islands</option>
        <option value="Cocos Island">Cocos Island</option>
        <option value="Colombia">Colombia</option>
        <option value="Cook Islands">Cook Islands</option>
        <option value="Costa Rica">Costa Rica</option>
        <option value="Croatia">Croatia</option>
        <option value="Cuba">Cuba</option>
        <option value="Cyprus">Cyprus</option>
        <option value="Czech Republic">Czech Republic</option>
        <option value="Denmark">Denmark</option>
        <option value="Dominica">Dominica</option>
        <option value="Dominican Republic">Dominican Republic</option>
        <option value="Ecuador">Ecuador</option>
        <option value="Egypt">Egypt</option>
        <option value="El Salvador">El Salvador</option>
        <option value="Estonia">Estonia</option>
        <option value="Falkland Islands">Falkland Islands</option>
        <option value="Faroe Islands">Faroe Islands</option>
        <option value="Fiji">Fiji</option>
        <option value="Finland">Finland</option>
        <option value="France">France</option>
        <option value="French Guyana">French Guyana</option>
        <option value="French Polynesia">French Polynesia</option>
        <option value="Gabon">Gabon</option>
        <option value="Germany">Germany</option>
        <option value="Gibraltar">Gibraltar</option>
        <option value="Georgia">Georgia</option>
        <option value="Greece">Greece</option>
        <option value="Greenland">Greenland</option>
        <option value="Grenada">Grenada</option>
        <option value="Guadeloupe">Guadeloupe</option>
        <option value="Guatemala">Guatemala</option>
        <option value="Guinea-Bissau">Guinea-Bissau</option>
        <option value="Guinea">Guinea</option>
        <option value="Haiti">Haiti</option>
        <option value="Honduras">Honduras</option>
        <option value="Hong Kong">Hong Kong</option>
        <option value="Hungary">Hungary</option>
        <option value="Iceland">Iceland</option>
        <option value="India">India</option>
        <option value="Indonesia">Indonesia</option>
        <option value="Ireland">Ireland</option>
        <option value="Israel">Israel</option>
        <option value="Italy">Italy</option>
        <option value="Jamaica">Jamaica</option>
        <option value="Japan">Japan</option>
        <option value="Jordan">Jordan</option>
        <option value="Kazakhstan">Kazakhstan</option>
        <option value="Kenya">Kenya</option>
        <option value="Kiribati ">Kiribati </option>
        <option value="Kuwait">Kuwait</option>
        <option value="Kyrgyzstan">Kyrgyzstan</option>
        <option value="Lao People's Democratic Republic">Lao People's 
          Democratic Republic</option>
        <option value="Latvia">Latvia</option>
        <option value="Lebanon">Lebanon</option>
        <option value="Liechtenstein">Liechtenstein</option>
        <option value="Lithuania">Lithuania</option>
        <option value="Luxembourg">Luxembourg</option>
        <option value="Macedonia">Macedonia</option>
        <option value="Madagascar">Madagascar</option>
        <option value="Malawi">Malawi</option>
        <option value="Malaysia ">Malaysia </option>
        <option value="Maldives">Maldives</option>
        <option value="Mali">Mali</option>
        <option value="Malta">Malta</option>
        <option value="Marocco">Marocco</option>
        <option value="Marshall Islands">Marshall Islands</option>
        <option value="Mauritania">Mauritania</option>
        <option value="Mauritius">Mauritius</option>
        <option value="Mexico">Mexico</option>
        <option value="Micronesia">Micronesia</option>
        <option value="Moldavia">Moldavia</option>
        <option value="Monaco">Monaco</option>
        <option value="Mongolia">Mongolia</option>
        <option value="Myanmar">Myanmar</option>
        <option value="Nauru">Nauru</option>
        <option value="Nepal">Nepal</option>
        <option value="Netherlands Antilles">Netherlands Antilles</option>
        <option value="Netherlands">Netherlands</option>
        <option value="New Zealand">New Zealand</option>
        <option value="Niue">Niue</option>
        <option value="North Korea">North Korea</option>
        <option value="Norway">Norway</option>
        <option value="Oman">Oman</option>
        <option value="Pakistan">Pakistan</option>
        <option value="Palau">Palau</option>
        <option value="Panama">Panama</option>
        <option value="Papua New Guinea">Papua New Guinea</option>
        <option value="Paraguay">Paraguay</option>
        <option value="Peru ">Peru </option>
        <option value="Philippines">Philippines</option>
        <option value="Poland">Poland</option>
        <option value="Portugal ">Portugal </option>
        <option value="Puerto Rico">Puerto Rico</option>
        <option value="Qatar">Qatar</option>
        <option value="Republic of Korea Reunion">Republic of Korea Reunion</option>
        <option value="Romania">Romania</option>
        <option value="Russia">Russia</option>
        <option value="Saint Helena">Saint Helena</option>
        <option value="Saint kitts and nevis">Saint kitts and nevis</option>
        <option value="Saint Lucia">Saint Lucia</option>
        <option value="Samoa">Samoa</option>
        <option value="San Marino">San Marino</option>
        <option value="Saudi Arabia">Saudi Arabia</option>
        <option value="Seychelles">Seychelles</option>
        <option value="Singapore">Singapore</option>
        <option value="Slovakia">Slovakia</option>
        <option value="Slovenia">Slovenia</option>
        <option value="Solomon Islands">Solomon Islands</option>
        <option value="South Africa">South Africa</option>
        <option value="Spain">Spain</option>
        <option value="Sri Lanka">Sri Lanka</option>
        <option value="St.Pierre and Miquelon">St.Pierre and Miquelon</option>
        <option value="St.Vincent and the Grenadines">St.Vincent and the 
          Grenadines</option>
        <option value="Sweden">Sweden</option>
        <option value="Switzerland">Switzerland</option>
        <option value="Syria">Syria</option>
        <option value="Taiwan ">Taiwan </option>
        <option value="Tajikistan">Tajikistan</option>
        <option value="Thailand">Thailand</option>
        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
        <option value="Turkey">Turkey</option>
        <option value="Turkmenistan">Turkmenistan</option>
        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
        <option value="Ukraine">Ukraine</option>
        <option value="UAE">UAE</option>
        <option value="UK">UK</option>
        <option value="USA">USA</option>
        <option value="Uruguay">Uruguay</option>
        <option value="Uzbekistan">Uzbekistan</option>
        <option value="Vanuatu">Vanuatu</option>
        <option value="Vatican City">Vatican City</option>
        <option value="Vietnam">Vietnam</option>
        <option value="Virgin Islands (GB)">Virgin Islands (GB)</option>
        <option value="Virgin Islands (U.S.) ">Virgin Islands (U.S.) </option>
        <option value="Wallis and Futuna Islands">Wallis and Futuna Islands</option>
        <option value="Yemen">Yemen</option>
        <option value="Yugoslavia">Yugoslavia</option>
      </select>
    </div>    <label for="country"></label></td>
    </tr>
  <tr>
    <td><label for="phone1">Contact phone #1:<font color="reqStar"><strong>&nbsp;*</strong></font></label></td>
    <td><input id="phone1" name="phone1" type="text" class="required digits" maxlength="15"></td>
	</tr>
  <tr>
    <td><label for="phone2">Contact phone #2:</label></td>
    <td><input id="phone2" name="phone2" type="text" class="digits" maxlength="15"></td>
    </tr>
  </table>