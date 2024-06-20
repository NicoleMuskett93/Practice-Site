<form role="search" method="get" class="search-form md:z-50 md:relative md:flex-row max-w-full w-full" action="<?php echo home_url( '/' ); ?>">
	<h2 class= "block md:hidden text-white text-[32px] font-outfit font-bold uppercase tracking-[3.2px]"><?php esc_html_e( 'Search', 'trinity' ); ?></h2>
	<div class= "flex items-center gap-4">
		<label class= "block w-full">
       
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
           
        <div class="search-container w-full relative border-2 border-gray-300">
            <input type="search" class="search-field  font-medium h-full w-full placeholder:text-lgrey text-white md:text-black py-3 px-10 bg-primary border-b border-white md:border-none md:bg-transparent"
                value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="search-icon absolute left-2 top-1/2 transform -translate-y-1/2 fill-yellow-500 w-6 h-6">
                <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
            </svg>
        </div>

		</label>
		<button type="submit" class="search-submit bg-yellow-500 py-3 px-3 text-white">Search</button>
        <i id="search-close" class="fa-solid fa-x text-black cursor-pointer"></i>
	</div>
</form>