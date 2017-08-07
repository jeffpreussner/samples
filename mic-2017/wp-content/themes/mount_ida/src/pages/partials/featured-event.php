<?php // Featured Event //

    echo do_shortcode('[events_list limit=1 tag="featured"]

    <section
             id="featured-event"
             class="full-width-promo has-bg mask-top mask-bottom"
             style="background-image: url(#_EVENTIMAGEURL); background-position: center top, center top; background-size: cover;">
       <div class="promo-content">
    	        <div class="container">
    	            <div class="row">
                     <div class="column">
                         <h6>Featured Event</h6>
                         <h2>#_EVENTNAME</h2>
                         <p class="supporting-text">#_ATT{Short Description}</p>
                         <div class="btn-container">
                             <a class="btn secondary m-block solid-white" target="_self" href="#_EVENTURL"><span>Learn More</span></a>
                         </div>
                     </div>
    	            </div>
    	        </div>
    	    </div>
    </section>

[/events_list]'); ?>
