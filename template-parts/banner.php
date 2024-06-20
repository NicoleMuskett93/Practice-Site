<?php 
// Get the ACF fields from the options page
$date = get_field('date', 'option'); // Ensure the field name is 'date'
$title = get_field('title', 'option'); // Ensure the field name is 'title'

// Convert date to 'YYYY-MM-DD' format if necessary
$formatted_date = date('Y-m-d', strtotime($date));
$banner_display = get_field('banner_active', 'option');
?>



<!-- Banner from options page -->
 <?php if($banner_display){?>
<div class="banner flex flex-col bg-black h-28 p-5">
    <div class="flex flex-row text-white items-center gap-5">
        <h1 id="days" class="bg-white text-black text-5xl border font-extrabold rounded-lg"></h1>
        <div class="flex flex-col">
            <span id="wording" class="text-lg"><?php echo esc_html($title); ?></span>
            <span><?php echo date('d/m/Y', strtotime($date)); ?></span>
        </div>
    </div>
</div>
<?php } ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Use the PHP formatted date string 'YYYY-MM-DD'
    var eventDateStr = '<?php echo $formatted_date; ?>';

    // Parse the formatted date string
    var eventDate = new Date(eventDateStr + 'T00:00:00'); // Adding time to ensure parsing as UTC

    var now = new Date();
   

    // Calculate the difference in time
    var timeDiff = eventDate.getTime() - now.getTime();
    var dayDiff = Math.ceil(timeDiff / (1000 * 60 * 60 * 24)); // Difference in days
    
    // Display the countdown in the HTML
    document.getElementById('days').textContent = dayDiff;
});
</script>
