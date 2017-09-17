
<section id="footer-contact" class="row" data-cta-destination='signup'
	<?php 
        $page = get_page_by_title( 'Home' );
		if(isset($page) && has_post_thumbnail($page->ID)) {
			echo 'style="background-image: url(' . $page->free_meditation_bkg_0 . ');"';
		}
	?>
>
		<div class="tint"></div>
	<div class="col-xs-12" data-tier='0' data-cta-text='Free Meditations'>
		<h4>Get Free Meditations</h4>
		<p>and much more delivered straight to your inbox</p>
		<form>
			<div class="col-xs-12 col-md-10 col-md-offset-1">
				<input type='text' name='firstname' placeholder='first name' required>
				<input type='text' name='lastname' placeholder='last name' required>
				<input type='email' name='email' placeholder='email' required>
			</div>
			<div class="col-xs-12">
				<input type='submit' value='Start Meditating'>
			</div>
		</form>
	</div>

	<div class="col-xs-12"  data-tier='1' data-cta-text='Become A Member'>
		<h4>Become A Member</h4>
		<p>you already know the benefits of meditation</p>
		<form>
			<input type='submit' value='Unlock More'>
		</form>
	</div>

	<div class="col-xs-12"  data-tier='2' data-version='volunteer' data-cta-text='Help Others'>
		<h4>Bodhichitta</h4>
		<p>Help others find what kindness has brought to you by</p>
		<form>
			<select>
				<option>Teaching</option>
				<option>Assisting Before/After Class</option>
				<option>Distributing Publicity</option>
			</select><br/>
			<input type='submit' value='Get Involved'>
		</form>
	</div>

</section>