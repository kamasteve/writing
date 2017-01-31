<table width="95%" align="center">
<tr><td colspan="2" class="sec_titles">Custom Paper Details</td> </tr>
  <tr><td colspan="2">&nbsp;</td> </tr> 
  <tr>
    <td width="212"><label for="topic">Topic:<font color="reqStar"><strong>&nbsp;*</strong></font></label>	</td>
    <td width="974"><input id="topic" name="topic" maxlength="256" class="required" size="50" type="text">	</td>
  </tr>
  <tr>
    <td><label for="subjectarea">Subject area:<font color="reqStar"><strong>&nbsp;*</strong></font></label></td>
    <td>
	<div><select title="Subject area" class="required" name="order_category" onChange="javascript:doOrderFormCalculation();">
    <option selected="selected" value="">Please Select...</option>
		<option value="10">Art</option>
														<option value="12">&nbsp;&nbsp;Architecture</option>
														<option value="15">&nbsp;&nbsp;Dance</option>
														<option value="17">&nbsp;&nbsp;Design Analysis</option>
														<option value="13">&nbsp;&nbsp;Drama</option>
														<option value="16">&nbsp;&nbsp;Movies</option>
														<option value="18">&nbsp;&nbsp;Music</option>
														<option value="11">&nbsp;&nbsp;Paintings</option>
														<option value="14">&nbsp;&nbsp;Theatre</option>
														<option value="112">Biology</option>
														<option value="52">Business</option>
														<option value="111">Chemistry</option>
														<option value="102">Communications and Media</option>
														<option value="105">&nbsp;&nbsp;Advertising</option>
														<option value="107">&nbsp;&nbsp;Communication Strategies</option>
														<option value="103">&nbsp;&nbsp;Journalism</option>
														<option value="104">&nbsp;&nbsp;Public Relations</option>
														<option value="115">Creative writing</option>
														<option value="53">Economics</option>
														<option value="60">&nbsp;&nbsp;Accounting</option>
														<option value="61">&nbsp;&nbsp;Case Study</option>
														<option value="58">&nbsp;&nbsp;Company Analysis</option>
														<option value="62">&nbsp;&nbsp;E-Commerce</option>
														<option value="59">&nbsp;&nbsp;Finance</option>
														<option value="57">&nbsp;&nbsp;Investment</option>
														<option value="63">&nbsp;&nbsp;Logistics</option>
														<option value="64">&nbsp;&nbsp;Trade</option>
														<option value="87">Education</option>
														<option value="93">&nbsp;&nbsp;Application Essay</option>
														<option value="89">&nbsp;&nbsp;Education Theories</option>
														<option value="88">&nbsp;&nbsp;Pedagogy</option>
														<option value="90">&nbsp;&nbsp;Teacher's Career</option>
														<option value="67">Engineering</option>
														<option value="9">English</option>
														<option value="24">Ethics</option>
														<option value="36">History</option>
														<option value="38">&nbsp;&nbsp;African-American Studies</option>
														<option value="37">&nbsp;&nbsp;American History</option>
														<option value="42">&nbsp;&nbsp;Asian Studies</option>
														<option value="41">&nbsp;&nbsp;Canadian Studies</option>
														<option value="44">&nbsp;&nbsp;East European Studies</option>
														<option value="45">&nbsp;&nbsp;Holocaust</option>
														<option value="40">&nbsp;&nbsp;Latin-American Studies</option>
														<option value="39">&nbsp;&nbsp;Native-American Studies</option>
														<option value="43">&nbsp;&nbsp;West European Studies</option>
														<option value="47">Law</option>
														<option value="49">&nbsp;&nbsp;Criminology</option>
														<option value="48">&nbsp;&nbsp;Legal Issues</option>
														<option value="7">Linguistics</option>
														<option value="2">Literature</option>
														<option value="4">&nbsp;&nbsp;American Literature</option>
														<option value="5">&nbsp;&nbsp;Antique Literature</option>
														<option value="6">&nbsp;&nbsp;Asian Literature</option>
														<option value="3">&nbsp;&nbsp;English Literature</option>
														<option value="116">&nbsp;&nbsp;Shakespeare Studies</option>
														<option value="54">Management</option>
														<option value="56">Marketing</option>
														<option value="51">Mathematics</option>
														<option value="94">Medicine and Health</option>
														<option value="99">&nbsp;&nbsp;Alternative Medicine</option>
														<option value="97">&nbsp;&nbsp;Healthcare</option>
														<option value="101">&nbsp;&nbsp;Nursing</option>
														<option value="95">&nbsp;&nbsp;Nutrition</option>
														<option value="100">&nbsp;&nbsp;Pharmacology</option>
														<option value="96">&nbsp;&nbsp;Sport</option>
														<option value="78">Nature</option>
														<option value="85">&nbsp;&nbsp;Agricultural Studies</option>
														<option value="113">&nbsp;&nbsp;Anthropology</option>
														<option value="86">&nbsp;&nbsp;Astronomy</option>
														<option value="83">&nbsp;&nbsp;Environmental Issues</option>
														<option value="79">&nbsp;&nbsp;Geography</option>
														<option value="80">&nbsp;&nbsp;Geology</option>
														<option value="28">Philosophy</option>
														<option value="110">Physics</option>
														<option value="29">Political Science</option>
														<option value="21">Psychology</option>
														<option value="108">Religion and Theology</option>
														<option value="22">Sociology</option>
														<option value="65">Technology</option>
														<option value="71">&nbsp;&nbsp;Aeronautics</option>
														<option value="70">&nbsp;&nbsp;Aviation</option>
														<option value="72">&nbsp;&nbsp;Computer Science</option>
														<option value="73">&nbsp;&nbsp;Internet</option>
														<option value="75">&nbsp;&nbsp;IT Management</option>
														<option value="77">&nbsp;&nbsp;Web Design</option>
														<option value="114">Tourism</option>
						  </select>
			</div>	</td>
    </tr>
  <tr>
    <td><label for="typeofdocument">Type of document:</label></td>
    <td><div>			<select name="doctype_x" id="doctype_x" class="required" onChange="javascript:doOrderFormCalculation();">
                            <option selected="selected" value="">Please Select...</option>
								<option value="1">Essay</option>
								<option value="2">Term Paper</option>
								<option value="3">Research Paper</option>
								<option value="4">Coursework</option>
								<option value="5">Book Report</option>
								<option value="6">Book Review</option>
								<option value="7">Movie Review</option>
								<option value="8">Dissertation</option>
								<option value="9">Thesis</option>
								<option value="10">Thesis Proposal</option>
								<option value="11">Research Proposal</option>
								<option value="12">Dissertation Chapter - Abstract</option>
								<option value="13">Dissertation Chapter - Introduction Chapter</option>
								<option value="14">Dissertation Chapter - Literature Review</option>
								<option value="15">Dissertation Chapter - Methodology</option>
								<option value="16">Dissertation Chapter - Results</option>
								<option value="17">Dissertation Chapter - Discussion</option>
								<option value="18">Dissertation Services - Editing</option>
								<option value="19">Dissertation Services - Proofreading</option>
								<option value="20">Formatting</option>
								<option value="21">Admission Services - Admission Essay</option>
								<option value="22">Admission Services - Scholarship Essay</option>
								<option value="23">Admission Services - Personal Statement</option>
								<option value="24">Admission Services - Editing</option>
								<option value="25">Editing</option>
								<option value="26">Proofreading</option>
								<option value="27">Case Study</option>
								<option value="28">Lab Report</option>
								<option value="29">Speech Presentation</option>
								<option value="30">Math Problem</option>
								<option value="31">Article</option>
								<option value="32">Article Critique</option>
								<option value="33">Annotated Bibliography</option>
								<option value="34">Reaction Paper</option>
								<option value="35">PowerPoint Presentation</option>
								<option value="36">Statistics Project</option>
								<option value="37">Multiple Choice Questions (None-Time-Framed)</option>
								<option value="38">Other (Not listed)</option>
							</select>
						</div></td>
    </tr>
  <tr>
    <td><label for="numberofpages">Number of pages/words:<font color="reqStar"><strong>&nbsp;*</strong></font></label></td>
    <td><div>			<select title="Number of pages" class="required" name="numpages" onChange="javascript:doOrderFormCalculation();">
                         	<option selected="selected"value="1">1 page/approx 275 words</option>
							<option value="2">2 pages/approx 550 words</option>
							<option value="3">3 pages/approx 850 words</option>
							<option value="4">4 pages/approx 2200 words</option>
							<option value="5">5 pages/approx 2750 words</option>
							<option value="6">6 pages/approx 3300 words</option>
							<option value="7">7 pages/approx 3850 words</option>
							<option value="8">8 pages/approx 4400 words</option>
							<option value="9">9 pages/approx 4950 words</option>
							<option value="10">10 pages/approx 5500 words</option>
							<option value="11">11 pages/approx 6050 words</option>
							<option value="12">12 pages/approx 6600 words</option>
							<option value="13">13 pages/approx 7150 words</option>
							<option value="14">14 pages/approx 7700 words</option>
							<option value="15">15 pages/approx 8250 words</option>
							<option value="16">16 pages/approx 8800 words</option>
							<option value="17">17 pages/approx 9350 words</option>
							<option value="18">18 pages/approx 9900 words</option>
							<option value="19">19 pages/approx 10450 words</option>
							<option value="20">20 pages/approx 11000 words</option>
							<option value="21">21 pages/approx 11550 words</option>
							<option value="22">22 pages/approx 12100 words</option>
							<option value="23">23 pages/approx 12650 words</option>
							<option value="24">24 pages/approx 13200 words</option>
							<option value="25">25 pages/approx 13750 words</option>
							<option value="26">26 pages/approx 14300 words</option>
							<option value="27">27 pages/approx 14850 words</option>
							<option value="28">28 pages/approx 15400 words</option>
							<option value="29">29 pages/approx 15950 words</option>
							<option value="30">30 pages/approx 16500 words</option>
							<option value="31">31 pages/approx 17050 words</option>
							<option value="32">32 pages/approx 17600 words</option>
							<option value="33">33 pages/approx 18150 words</option>
							<option value="34">34 pages/approx 18700 words</option>
							<option value="35">35 pages/approx 19250 words</option>
							<option value="36">36 pages/approx 19800 words</option>
							<option value="37">37 pages/approx 20350 words</option>
							<option value="38">38 pages/approx 20900 words</option>
							<option value="39">39 pages/approx 21450 words</option>
							<option value="40">40 pages/approx 22000 words</option>
							<option value="41">41 pages/approx 22550 words</option>
							<option value="42">42 pages/approx 23100 words</option>
							<option value="43">43 pages/approx 23650 words</option>
							<option value="44">44 pages/approx 24200 words</option>
							<option value="45">45 pages/approx 24750 words</option>
							<option value="46">46 pages/approx 25300 words</option>
							<option value="47">47 pages/approx 25850 words</option>
							<option value="48">48 pages/approx 26400 words</option>
							<option value="49">49 pages/approx 26950 words</option>
							<option value="50">50 pages/approx 27500 words</option>
							<option value="51">51 pages/approx 28050 words</option>
							<option value="52">52 pages/approx 28600 words</option>
							<option value="53">53 pages/approx 29150 words</option>
							<option value="54">54 pages/approx 29700 words</option>
							<option value="55">55 pages/approx 30250 words</option>
							<option value="56">56 pages/approx 30800 words</option>
							<option value="57">57 pages/approx 31350 words</option>
							<option value="58">58 pages/approx 31900 words</option>
							<option value="59">59 pages/approx 32450 words</option>
							<option value="60">60 pages/approx 33000 words</option>
							<option value="61">61 pages/approx 33550 words</option>
							<option value="62">62 pages/approx 34100 words</option>
							<option value="63">63 pages/approx 34650 words</option>
							<option value="64">64 pages/approx 35200 words</option>
							<option value="65">65 pages/approx 35750 words</option>
							<option value="66">66 pages/approx 36300 words</option>
							<option value="67">67 pages/approx 36850 words</option>
							<option value="68">68 pages/approx 37400 words</option>
							<option value="69">69 pages/approx 37950 words</option>
							<option value="70">70 pages/approx 38500 words</option>
							<option value="71">71 pages/approx 39050 words</option>
							<option value="72">72 pages/approx 39600 words</option>
							<option value="73">73 pages/approx 40150 words</option>
							<option value="74">74 pages/approx 40700 words</option>
							<option value="75">75 pages/approx 41250 words</option>
							<option value="76">76 pages/approx 41800 words</option>
							<option value="77">77 pages/approx 42350 words</option>
							<option value="78">78 pages/approx 42900 words</option>
							<option value="79">79 pages/approx 43450 words</option>
							<option value="80">80 pages/approx 44000 words</option>
							<option value="81">81 pages/approx 44550 words</option>
							<option value="82">82 pages/approx 45100 words</option>
							<option value="83">83 pages/approx 45650 words</option>
							<option value="84">84 pages/approx 46200 words</option>
							<option value="85">85 pages/approx 46750 words</option>
							<option value="86">86 pages/approx 47300 words</option>
							<option value="87">87 pages/approx 47850 words</option>
							<option value="88">88 pages/approx 48400 words</option>
							<option value="89">89 pages/approx 48950 words</option>
							<option value="90">90 pages/approx 49500 words</option>
							<option value="91">91 pages/approx 50050 words</option>
							<option value="92">92 pages/approx 50600 words</option>
							<option value="93">93 pages/approx 51150 words</option>
							<option value="94">94 pages/approx 51700 words</option>
							<option value="95">95 pages/approx 52250 words</option>
							<option value="96">96 pages/approx 52800 words</option>
							<option value="97">97 pages/approx 53350 words</option>
							<option value="98">98 pages/approx 53900 words</option>
							<option value="99">99 pages/approx 54450 words</option>
							<option value="100">100 pages/approx 55000 words</option>
							<option value="101">101 pages/approx 55550 words</option>
							<option value="102">102 pages/approx 56100 words</option>
							<option value="103">103 pages/approx 56650 words</option>
							<option value="104">104 pages/approx 57200 words</option>
							<option value="105">105 pages/approx 57750 words</option>
							<option value="106">106 pages/approx 58300 words</option>
							<option value="107">107 pages/approx 58850 words</option>
							<option value="108">108 pages/approx 59400 words</option>
							<option value="109">109 pages/approx 59950 words</option>
							<option value="110">110 pages/approx 60500 words</option>
							<option value="111">111 pages/approx 61050 words</option>
							<option value="112">112 pages/approx 61600 words</option>
							<option value="113">113 pages/approx 62150 words</option>
							<option value="114">114 pages/approx 62700 words</option>
							<option value="115">115 pages/approx 63250 words</option>
							<option value="116">116 pages/approx 63800 words</option>
							<option value="117">117 pages/approx 64350 words</option>
							<option value="118">118 pages/approx 64900 words</option>
							<option value="119">119 pages/approx 65450 words</option>
							<option value="120">120 pages/approx 66000 words</option>
							<option value="121">121 pages/approx 66550 words</option>
							<option value="122">122 pages/approx 67100 words</option>
							<option value="123">123 pages/approx 67650 words</option>
							<option value="124">124 pages/approx 68200 words</option>
							<option value="125">125 pages/approx 68750 words</option>
							<option value="126">126 pages/approx 69300 words</option>
							<option value="127">127 pages/approx 69850 words</option>
							<option value="128">128 pages/approx 70400 words</option>
							<option value="129">129 pages/approx 70950 words</option>
							<option value="130">130 pages/approx 71500 words</option>
							<option value="131">131 pages/approx 72050 words</option>
							<option value="132">132 pages/approx 72600 words</option>
							<option value="133">133 pages/approx 73150 words</option>
							<option value="134">134 pages/approx 73700 words</option>
							<option value="135">135 pages/approx 74250 words</option>
							<option value="136">136 pages/approx 74800 words</option>
							<option value="137">137 pages/approx 75350 words</option>
							<option value="138">138 pages/approx 75900 words</option>
							<option value="139">139 pages/approx 76450 words</option>
							<option value="140">140 pages/approx 77000 words</option>
							<option value="141">141 pages/approx 77550 words</option>
							<option value="142">142 pages/approx 78100 words</option>
							<option value="143">143 pages/approx 78650 words</option>
							<option value="144">144 pages/approx 79200 words</option>
							<option value="145">145 pages/approx 79750 words</option>
							<option value="146">146 pages/approx 80300 words</option>
							<option value="147">147 pages/approx 80850 words</option>
							<option value="148">148 pages/approx 81400 words</option>
							<option value="149">149 pages/approx 81950 words</option>
							<option value="150">150 pages/approx 82500 words</option>
							<option value="151">151 pages/approx 83050 words</option>
							<option value="152">152 pages/approx 83600 words</option>
							<option value="153">153 pages/approx 84150 words</option>
							<option value="154">154 pages/approx 84700 words</option>
							<option value="155">155 pages/approx 85250 words</option>
							<option value="156">156 pages/approx 85800 words</option>
							<option value="157">157 pages/approx 86350 words</option>
							<option value="158">158 pages/approx 86900 words</option>
							<option value="159">159 pages/approx 87450 words</option>
							<option value="160">160 pages/approx 88000 words</option>
							<option value="161">161 pages/approx 88550 words</option>
							<option value="162">162 pages/approx 89100 words</option>
							<option value="163">163 pages/approx 89650 words</option>
							<option value="164">164 pages/approx 90200 words</option>
							<option value="165">165 pages/approx 90750 words</option>
							<option value="166">166 pages/approx 91300 words</option>
							<option value="167">167 pages/approx 91850 words</option>
							<option value="168">168 pages/approx 92400 words</option>
							<option value="169">169 pages/approx 92950 words</option>
							<option value="170">170 pages/approx 93500 words</option>
							<option value="171">171 pages/approx 94050 words</option>
							<option value="172">172 pages/approx 94600 words</option>
							<option value="173">173 pages/approx 95150 words</option>
							<option value="174">174 pages/approx 95700 words</option>
							<option value="175">175 pages/approx 96250 words</option>
							<option value="176">176 pages/approx 96800 words</option>
							<option value="177">177 pages/approx 97350 words</option>
							<option value="178">178 pages/approx 97900 words</option>
							<option value="179">179 pages/approx 98450 words</option>
							<option value="180">180 pages/approx 99000 words</option>
							<option value="181">181 pages/approx 99550 words</option>
							<option value="182">182 pages/approx 100100 words</option>
							<option value="183">183 pages/approx 100650 words</option>
							<option value="184">184 pages/approx 101200 words</option>
							<option value="185">185 pages/approx 101750 words</option>
							<option value="186">186 pages/approx 102300 words</option>
							<option value="187">187 pages/approx 102850 words</option>
							<option value="188">188 pages/approx 103400 words</option>
							<option value="189">189 pages/approx 103950 words</option>
							<option value="190">190 pages/approx 104500 words</option>
							<option value="191">191 pages/approx 105050 words</option>
							<option value="192">192 pages/approx 105600 words</option>
							<option value="193">193 pages/approx 106150 words</option>
							<option value="194">194 pages/approx 106700 words</option>
							<option value="195">195 pages/approx 107250 words</option>
							<option value="196">196 pages/approx 107800 words</option>
							<option value="197">197 pages/approx 108350 words</option>
							<option value="198">198 pages/approx 108900 words</option>
							<option value="199">199 pages/approx 109450 words</option>
							<option value="200">200 pages/approx 110000 words</option>
							</select>
						</div>
						<div id="num_pg_ord" style="width:auto; float:left; font-size:12px; display:inline;">approx 275 words per page</div> </td>
    </tr>
  <tr>
    <td><label for="spacing">Spacing:</label></td>
    <td><div>
<input  name="o_interval" id="o_interval" value="1" onClick="javascript:doOrderFormCalculation();" type="checkbox">&nbsp;<b>Single spaced</b><br>
<input type="hidden" name="spacing" id="spacing" value="">
					</div></td>
    </tr>
</table>
<table width="95%" align="center" class="td_borders">
<tr>
<td width="18%"><label for="urgency">Urgency:</label></td>
<td width="36%"><div>
<select title="Paper urgency" class="required" name="urgency" id="urgency" onChange="javascript:doOrderFormCalculation();">
<option selected="selected" value="">Please Select...</option>
<option value="6">6 hours</option>
 <option value="12">12 hours</option>
 <option value="24">24 hours</option>
 <option value="36">36 hours</option>
 <option value="48">48 hours</option>
 <option value="3">3 days</option>
 <option value="5">5 days</option>
 <option value="7">7 days</option>
 <option value="9">9 days</option>
 <option value="10">10 days</option>
 <option value="14">14 days</option>
 <option value="21">21 days</option>
 <option value="30">30 days</option>
 <option value="60">2 Months</option>
 </select>
</div></td>

<td width="46%"><div>
	Graph Work &nbsp;	
	<input  id="vas_per_page_0" name="vas_id[]" value="3" onClick="doOrderFormCalculation()" type="checkbox"><b>$7.5/page</b>
    <input type="hidden" name="topwriter" id="topwriter" value="">
	  </div>
    </td>
  </tr>
<tr><td><label for="academiclevel">Academic Level:</label></td>
<td>
<div>
<select title="Academic level" class="required" name="academic_level" id="academic_level" onChange="javascript:doOrderFormCalculation();">
 <option value="">Choose</option>
 <option value="1">High School</option>
 <option value="2">College</option>
 <option value="3">Undergraduate </option>
 <option value="4">Master </option>
 <option value="5">PhD </option>
</select> <font size="1">Choose <strong>Urgency</strong> First</font>
<input type="hidden" name="academic_level_txt"  id="academic_level_txt"  />
</div>
</td>
<td></td>
</tr>  
<tr>
    <td><label for="numberofsources">Number of sources/references:</label></td>
    <td><div>
<select id="numberOfSources" name="numberOfSources" size="1" onChange="javascript:doOrderFormCalculation();">
<option selected="selected" value="">Please Select...</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
<option value="32">32</option>
<option value="33">33</option>
<option value="34">34</option>
<option value="35">35</option>
<option value="36">36</option>
<option value="37">37</option>
<option value="38">38</option>
<option value="39">39</option>
<option value="40">40</option>
<option value="41">41</option>
<option value="42">42</option>
<option value="43">43</option>
<option value="44">44</option>
<option value="45">45</option>
<option value="46">46</option>
<option value="47">47</option>
<option value="48">48</option>
<option value="49">49</option>
<option value="50">50</option>
<option value="51">51</option>
<option value="52">52</option>
<option value="53">53</option>
<option value="54">54</option>
<option value="55">55</option>
<option value="56">56</option>
<option value="57">57</option>
<option value="58">58</option>
<option value="59">59</option>
<option value="60">60</option>
<option value="61">61</option>
<option value="62">62</option>
<option value="63">63</option>
<option value="64">64</option>
<option value="65">65</option>
<option value="66">66</option>
<option value="67">67</option>
<option value="68">68</option>
<option value="69">69</option>
<option value="70">70</option>
<option value="71">71</option>
<option value="72">72</option>
<option value="73">73</option>
<option value="74">74</option>
<option value="75">75</option>
<option value="76">76</option>
<option value="77">77</option>
<option value="78">78</option>
<option value="79">79</option>
<option value="80">80</option>
</select>	
</div></td>
    <td><div>VIP support: 
      <input id="vas_per_order_1" name="vas_id[]" value="6" onClick="doOrderFormCalculation()" type="checkbox"> <b>$9.95</b><br>
	  <input type="hidden" name="vip_support" id="vip_support" value="">
	  </div></td>
  </tr>
  
  <tr>
    <td><label for="style">Style:</label></td>
    <td><div>
<select id="style" name="writing_style" class="required" size="1" onChange="javascript:doOrderFormCalculation();">
	<option selected="selected" value="">Please Select...</option>
    <option value="1">APA</option>
	<option value="2">MLA</option>
	<option value="3">Turabian</option>
	<option value="4">Chicago</option>
	<option value="5">Harvard</option>
	<option value="6">Oxford</option>
	<option value="8">Vancouver</option>
	<option value="9">CBE</option>
	<option value="7">Other</option>
</select>	
</div></td>
  </tr>
    <tr>
    <td><label for="style">Currency:</label></td>
    <td><div>
<select name="curr" id="curr" class="required" size="1" onChange="javascript:doOrderFormCalculation();">
	 	<option value="1">USD</option>
 		<option value="2">GBP</option>
 		<option value="3">CAD</option>
 		<option value="4">AUD</option>
 		<option value="5">EUR</option>
 		</select>
</div></td>
    <td></td>
  </tr>
  <tr>
    <td>
	<div style="padding: 10px; width:auto; float:right; font-size:18px; font-weight:bold; display:none;"> <span id="cost_per_page" class="readonlyinput"><?php echo $basePrice ?></span></div>
    <!--<div style="padding: 10px; width:auto; float:right; font-size:14px; font-weight:bold;">Minimal Cost / Page : <?php echo $curr_symbol. ' '.$basePrice ?></div>-->
	</td>
    <td>
	<div style="padding: 10px 5px; font-size:20px; font-weight:bold; float:right;"> Total </div>
    </td>
<td><div class="order_price_totals"> <!--<?php echo $curr_symbol; ?>-->  <span id="total">0.00</span></div> <div style="font-size:12px; width:60%; margin-left:10px; float:right;"> (Kindly select "<strong>Type of Doc</strong>", "<strong>Urgency</strong>" and "<strong>Academic Level</strong>" accordingly)</div></td>
</tr>
 <tr>
 <td><label for="language">Preferred language style:</label></td>
 <td><div>
<select class="required" name="langstyle" id="langstyle" onChange="javascript:doOrderFormCalculation();">
<option selected="selected" value="">Please Select...</option>
<option value="1">English (U.S.)</option> 
<option value="2">English (U.K.)</option></select>
</div></td>
<td></td>
</tr>
</table>
<table width="95%" align="center">
  <tr>
  <td width="18%"> Track ID</td>
  <td width="82%"><input type="text" name="track_order_id" id="track_order_id" value="" maxlength=10><span style="font-size:11px;">(Optional- so you can track your orders)</span></td>
</tr>		
  <tr>
    <td><label for="details">Order description:<font color="reqStar"><strong>&nbsp;*</strong></font><br><span class="label_comment">(type your instructions here)</span></label></td>
    <td>
	<div>
	<input type="hidden" name="totals" value="0" id="totals" size=12 readonly style="text-align:center; height: 30px; width: 130px; font-size: 26px; padding: 2px; margin: 3px;">
	<br>
<textarea id="details" name="details" class="required" rows="5" style="width:400px; resize:none;"></textarea><div id="err_details"></div>
<br>
<div class="file-up">If you have additional files, you will upload them at 'Manage Orders' section.</div>
	</div></td>
  </tr>
 <tr><td colspan="2"> <hr></td></tr>  
<?php 
$sql_site_d = "select * from orders_discounts where url = '$siteUrl' and status =1";
$rs_results_site_d = mysql_query($sql_site_d) or die(mysql_error());
$total_site_d = mysql_num_rows($rs_results_site_d);
if ($total_site_d > 0){  ?>
<?php $row_site_d = mysql_fetch_array($rs_results_site_d)?> 
<tr> 
<td></td>
<td>
<div class="order_discount_pane"> Get a <strong> <?php echo $row_site_d['percentage']; ?>%  </strong> discount on an order above <strong> $ <?php echo $row_site_d['discount_offer']; ?></strong> now. <br>
Use the following coupon code : <br><span class="dicount_coupon_code"> <?php echo $row_site_d['codex']; ?></span> <font size="1" style="padding-left:20px;"> Copy without space</font></div>
 </td>
</tr>
  <tr>
    <td>
	<div style="padding: 10px 5px;  font-size:18px; font-weight:bold; color:#039;">	Get  Discount <i>!!</i></div>
	</td>
    <td style="border:1px dotted #333; padding:10px;">
<input name="discount_percent_h" id="discount_percent_h" class="discount_percent_h" value="" type="hidden">
<input name="discount_h" value="" type="hidden">						
<input name="lblCustomerSavings" value="" type="hidden"> 
<div style="display: none; font-weight: bold; color: green; line-height:25px; font-size:18px;" id="lblCustomerSavings"></div>
<div style="display: block;" id="lblCustomerSavingstext">
<label><strong>Discount code :</strong></label>
<input class="discount_code" name="discount_code" type="text">
&nbsp;&nbsp;<a title="click to use a discount code" href="javascript:void(0)" onClick="javascript:doDiscount();"><input type="button" id="doVerify" name="doVerify" class="small_button" value="Verify Code"></a>
<div style="padding:10px;"><small><i>Enter the discount code and click 'Verify Code' to verify.</i></small><br><div style="padding: 10px 5px;  font-size:12px;">
Please, be aware that membership discounts are not applied to orders under<strong>  <?php echo $curr_symbol .' '. $row_site_d['discount_offer']; ?></strong></div>
</div>
<div id="discount_check" style="font-weight: 600; color: red; font-size:18px; text-align:center"></div>
     </td>
  </tr>
<?php }else{ ?> 
<tr><td></td>
<td>
<input name="discount_percent_h" id="discount_percent_h" class="discount_percent_h" value="" type="hidden">
<input name="discount_h" value="" type="hidden">						
<input name="lblCustomerSavings" value="" type="hidden"> 
</td>
</tr>
<?php } ?> 
  <tr>
    <td>&nbsp;</td>
    <td><label for="allow_night_calls"><b>NEW!</b> I agree to receive phone calls from you at night in case of emergency</label>
    <input id="allow_night_calls" name="allow_night_calls" value="allow_night_calls" size="1" type="checkbox"></td>
  </tr>
</table>