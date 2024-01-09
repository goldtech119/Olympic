<?php
function service_footer_func() {
	ob_start();
?>
	<script type="text/javascript">
		// service form
		jQuery(document).ready(function() {
			console.log("[page loaded!]");
			const form = document.querySelector(".service_form form");

			function setElementDisplay(ele, visible) {
				if (visible) {
					ele.parentElement.style.display = "block";
					ele.parentElement.previousElementSibling.style.display = "block";
				} else {
					ele.parentElement.style.display = "none";
					ele.parentElement.previousElementSibling.style.display = "none";
				}
			}

			if (form) {
				const lists = [{
						visibleCheck: "my_hottub_fixed_chk",
						itemSelector: "my_hottub_fixed_dropdown",
					},
					{
						visibleCheck: "another_brand_chk",
						itemSelector: "another_brand_drop"
					},
					{
						visibleCheck: "schedule_valet_service",
						itemSelector: "schedule_valet_drop",
					},
					{
						visibleCheck: "cover_lifter_chk",
						itemSelector: "cover_lifter_drop"
					},
					{
						visibleCheck: "learn_accessory_chk",
						itemSelector: "learn_accessory_drop",
					},
					{
						visibleCheck: "trading_chk",
						itemSelector: "trading_drop"
					},
				];
				if (lists) {
					for (const item of lists) {
						const {
							visibleCheck,
							itemSelector
						} = item;
						const chkEle = form.querySelector(`[data-name="${visibleCheck}"]`);
						const wrapperEle = form.querySelector(`[data-name="${itemSelector}"]`);
						if (chkEle && wrapperEle) {
							// const classesToAdd = ['chkEle.clist', 'tve_lg_checkbox_wrapper', 'tve-updated-dom', 'tcb-local-vars-root']
							// chkEle.checked = false
							//  classesToAdd.forEach(className => {
							//    chkEle.parentElement.classList.add(className);
							//  });

							setElementDisplay(wrapperEle, false);
							chkEle.addEventListener("click", function() {
								setElementDisplay(wrapperEle, chkEle.checked);
							});
						}
					}
				}
			}
		});
	</script>
<?php
	return ob_get_clean();
}
add_shortcode('service_js_in_footer', 'service_footer_func');
