<style>
 
.about-section {
    position: relative;
}
.padding {
    padding: 40px 0;
}
.circle:before {
    background-color: #f8b864;
    content: '';
    height: 800px;
    width: 800px;
    position: absolute;
    top: -400px;
    left: -350px;
    border-radius: 100%;
    opacity: 0.2;
    z-index: -1;
}
.shape:after {
    background-color: #f8b864;
    content: '';
    width: 50%;
    height: 580px;
    position: absolute;
    top: 330px;
    right: -150px;
    border-radius: 100%;
    -webkit-transform: skew(3deg,30deg);
    -ms-transform: skew(3deg,30deg);
    transform: skew(5deg,10deg);
    opacity: 0.3;
    z-index: -1;
}

.selectAmount{ position:relative;}
.selectAmount .donateAmount{
	cursor:pointer;
	font-size:1.8em;
	text-align:center;
	width:80px;
	border:1px solid #ccc;
	border-radius:8px;
	display:inline-block;
	padding:10px 5px;
	background:#fff;
}
.selectAmount .donateAmount:hover,
.selectedAmount{
	background:#185EAC!important;
	color:#fff!important;
}
</style>
<main class="clearfix width-100 mt-2">
   
    <div class="section-white shape about-section padding circle">
                    <div class="container">
						<div class="text-center">
                         <h1>Sponsorship Submission Review</h1>
						 
						 </div>
						 
						 <div class="row">
						 
						 <div class="mt-3 mb-3 col-md-8 offset-md-2 paymentWrap">
						 <div class=" text-center mt-3">
							<img style="margin:auto;width:100%" src="/assets/head_sponsor.jpg"/>
						 </div>
					<form action="#" id="sponsor_form" enctype="multipart/form-data" method="post" accept-charset="utf-8"> 
					<div class="row mt-5">
						<div class="col-md-12">
							 
							<div class="row form-group">
					<div class="col-md-4">
						<label>Salutation</label>
					</div>
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-3">
							<select type="text" class="form-control input">
								<option>Mr.</option>
								<option>Ms.</option>
								<option>Miss.</option>
								<option>Mrs.</option>
							</select>
							</div>
							<div class="col-md-3">
							<input type="text" class="form-control input" name="first_name" value="Lavelle"  placeholder="First Name"  />
							</div>
							<div class="col-md-3">
							<input type="text" class="form-control input" name="middle_name" value="Jones"  placeholder="Middle Name"  />
							</div>
							<div class="col-md-3">
							<input type="text" class="form-control input" name="last_name" value="Press"  placeholder="Last Name"  />
							</div>
						</div>
						 
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Company or Organization Name</label>
					</div>
					<div class="col-md-8">
						 <input type="text" class="form-control input" name="company_name"  placeholder="Company"  value="Nor Cal Elite Disable Veterans" required />
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Street Address</label>
					</div>
					<div class="col-md-8">
						 <input type="text" class="form-control input" name="address"  placeholder="Address"  value="1405 Phelps Ave #36" required />
						 <div class="row">
							<div class="col-md-3">
								<label>City</label>
								<input type="text" class="form-control input" name="city"  placeholder="City"  value="San Jose" required />
							</div>
							<div class="col-md-3">
								<label>State</label>
								<input type="text" class="form-control input" name="state"  placeholder="State"  value="California" required />
							</div>
							<div class="col-md-3">
								<label>Zip</label>
								<input type="text" class="form-control input" name="zip"  placeholder="Zip"  value="95117" required />
							</div>
							<div class="col-md-3">
								<label>Country</label>
								<input type="text" class="form-control input" name="country"  placeholder="Country"  value="USA" required />
							</div>
						 </div>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Phone</label>
					</div>
					<div class="col-md-8">
						 408 505-3032
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Email</label>
					</div>
					<div class="col-md-8">
						 Lavelle@ncdeliteveterans.org
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Organization Website</label>
					</div>
					<div class="col-md-8">
						 Ncdeliteveterans.org 
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Are you a non profit</label>
					</div>
					<div class="col-md-8">
						 <div class="row">
							<div class="col-md-5">
							<select class="form-control input">
								<option value="">-------</option>
								<option value="Yes" selected>Yes</option>
								<option value="No">No</option>
							</select></div>
							<div class="col-md-7">501 c 19  tax id 45-0505137</div>
						 </div>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Proposal name</label>
					</div>
					<div class="col-md-8">
						 <input type="text" class="form-control input" name="proposal_name"  placeholder="Proposal"  value="Lavelle Jones" required />
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Email </label>
					</div>
					<div class="col-md-8">
						 Jjsdesigngroup@acninc.net
					</div>
				</div>				
				<div class="row form-group">
					<div class="col-md-4">
						<label>Focus </label>
					</div>
					<div class="col-md-8">
						 <div class="row">
							<div class="col-md-5">
							<select class="form-control input">
								<option value="">-------</option>
								<option>Cause & Philanthropy</option>
								<option>Sports</option>
								<option>Entertainment/Music</option>
								<option>Culture-specific</option>
								<option>Culture-specific</option>
								<option selected>Local Community</option>
								<option>Other</option>
							</select></div>
							<div class="col-md-7">Micro contract</div>
						 </div>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Geographic location of sponsorship </label>
					</div>
					<div class="col-md-5">
						<select class="form-control input">
								<option value="">-------</option>
								<option>Single Market</option>
								<option>Regional</option>
								<option selected>National</option>
							</select>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Please include any additional market information</label>
					</div>
					<div class="col-md-8">
						<textarea rows="8" class="form-control input">https://ncdeliteveterans.org
Increase community involvement and support for disabled veterans Raise awareness of the challenges faced by disabled veterans Provide economic opportunities for disabled veterans in the community
Encourage sponsors to partner with disabled veterans to create mutually beneficial initiatives
Contract 	 
							</textarea>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>What is the term of the proposed sponsorship</label>
					</div>
					<div class="col-md-5">
						<ul><li>Sponsorship/event start date* June 2023</li>
							<li>Sponsorship/event end date* June 2024</li>
						</ul>

					</div>
				</div>
				
				<div class="row form-group">
					<div class="col-md-4">
						<label>Year-Round Partnership</label>
					</div>
					<div class="col-md-8">
						 <div class="row">
							<div class="col-md-5">
							<select class="form-control input">
								<option value="">-------</option>
								<option selected>Yes</option>
								<option>No</option>								 
							</select></div>
							<div class="col-md-7"></div>
						 </div>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Will receive sponsorship though out the year</label>
						<label>Sponsors</label>
					</div>
					<div class="col-md-8">
						 <div class="row">
							<div class="col-md-5">
							<select class="form-control input">
								<option value="">-------</option>
								<option selected>Yes</option>
								<option>No</option>								 
							</select></div>
							<div class="col-md-7"></div>
						 </div>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Sponsor name</label>
					</div>
					<div class="col-md-8">
						 <ul>
						 <li>T-Moble</li>
						 <li>PG&E </li>
						<li>San Jose Water Company</li>
						<li>International Line Builder (ILB)</li>
						<li>4xCommunity Choice Aggregation CCA’s, micro contract</li>
						<li>Comcast</li>
						<li>DGS Department General Service</li>
						<li>Swinerton Construction</li>

						 </ul>
						 
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Does this sponsorship include media advertising units?</label> 
					</div>
					<div class="col-md-8">
						 <div class="row">
							<div class="col-md-5">
							<select class="form-control input">
								<option value="">-------</option>
								<option >Yes</option>
								<option selected>No</option>								 
							</select></div>
							<div class="col-md-7"></div>
						 </div>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Are there any media broadcast partners involved with this opportunity*</label> 
					</div>
					<div class="col-md-8">
						 <div class="row">
							<div class="col-md-5">
							<select class="form-control input">
								<option value="">-------</option>
								<option >Yes</option>
								<option selected>No</option>								 
							</select></div>
							<div class="col-md-7"></div>
						 </div>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Does the sponsorship involve signage*</label> 
					</div>
					<div class="col-md-8">
						 <div class="row">
							<div class="col-md-5">
							<select class="form-control input">
								<option value="">-------</option>
								<option >Yes</option>
								<option selected>No</option>								 
							</select></div>
							<div class="col-md-7"></div>
						 </div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">The Nor-Cal Elite Network is on a mission to provide educational, training, resources, Calv Certifications and outreach to help Disable Veterans in business succeed and Bid Posting</div>
				</div>
				
				<div class="row form-group">
					<div class="col-md-4">
						<label>Sponsor annual asking price</label>
					</div>
					<div class="col-md-8">
						Level Pricing*<br>
						<strong>Platinum</strong><br>
						$25,000~$49,999<br>
						<strong> Silver</strong><br>
						$10,000~$14,999<br>
						<strong>Bronze</strong><br>
						$5,000~$9,999<br>
						<strong>Trailblazer</strong><br>
						$3000<br>

					</div>
				</div>				
				<div class="row form-group">
					<div class="col-md-4">
						<label>Monthly Meeting </label>
					</div>
					<div class="col-md-8">
						 <div class="row">
							<div class="col-md-5">
							<select class="form-control input">
								<option value="">-------</option>
								<option selected>Yes</option>
								<option>No</option>								 
							</select></div>
							<div class="col-md-7">Workshop education training</div>
						 </div>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Yearly Event </label>
					</div>
					<div class="col-md-8">
						 <div class="row">
							<div class="col-md-5">
							<select class="form-control input">
								<option value="">-------</option>
								<option selected>Yes</option>
								<option>No</option>								 
							</select></div>
							<div class="col-md-7">"Elite 5" Micro Mentor Protégé Program</div>
						 </div>
					</div>
				</div>
					<div class="row form-group">
					<div class="col-md-4">
						<label>Event or Opportunity Frequency </label>
					</div>
					<div class="col-md-8">
						 <div class="row">
							<div class="col-md-5">
							<select class="form-control input">
								<option value="">-------</option>
								<option selected>Yes</option>
								<option>No</option>								 
							</select></div>
							<div class="col-md-7"></div>
						 </div>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<label>Total estimated attendance</label>
					</div>
					<div class="col-md-8"> 
						<strong>Disable veterans</strong>: 1,628<br> 
						<strong>Veterans</strong>: 15<br> 
						<strong>Corporate Companies</strong>: 218<br>
						<strong>Website hits</strong>: 40,123<br>
					</div>
				</div>
				
				<div>
					<h3>Our Mission</h3>
					<p>To assist Service-Disabled Veterans by successfully helping Disable Veterans establish their own business and network with our members to procures business contracts with commercial organizations, as well as local, state.</p>
					<h3>Description of opportunity or event</h3>
					<p>
						On Oct 17 2022 Nor Cal Elite hosted a service disabled veteran’s event. At this event, we announced Elite 5" Micro Mentor Protégé Program
						<ul><li>•	Match making D-vet helping D-vet </li></ul>
					</p>
					<p>Nor-Cal Elite’s specific goals are to assist Service-Disabled Veterans by successfully helping them establish their own business and also to network with our partners to procure business contracts along with commercial organizations, as well as local and state government agencies.</p>
					<p>
					Your team will provide a needed service in your role as our sponsor.<br>
 Supplier Diversity Companies such as yours by our side at these upcoming events will insure our success. 

</p>
<p>
The 3 major challenges our Nor-Cal Elite Disabled Veteran face:<br>
Finding new sponsors that can and will help<br>
Finding bid posting <br>
Training and educating members from “Boot to business” <br>

</p>

<p><br>
Over 20 years ago, a group of veterans who had served their country found themselves struggling as individual business owners. The Elite Service Disabled Veteran Owned Business Network was started. <br>
A 501(c)19 non-profit veterans organization, the Elite SDVOB Network is an all-volunteer association comprised of business owners. Our mission is centered on advocacy, education and business opportunities advancement for service disabled veteran owned businesses and their allies.<br>
A national organization, the Elite SDVOB Network hosts events across the country, including a national convention that has been held annually since 2003. We collaborate with business leaders, policy makers, and the general public to provide the means for Service Disabled Veteran Owned Businesses to overcome challenges and prosper in an evolving business environment.<br>
 You might ask who elite is 501©19, Elite is different than other nonprofit. Elite is one of a kind with IRS 501©19, the only 501©19 in State of California. With 501c19 Elite can talk to congress in creating LAWS is for Disable Veterans.<br>
Certication <br>
up load Pdf<br>
up load log<br>

</p>
					
				</div>
				
						</div>
					</div>
					</form>
				</div>
				</div>
                    </div>
     </div>
 
</main>  <!-- #main -->
 