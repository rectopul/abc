<?php
/**
 * Main dashboard template
 */
?><div id="jet-woo-product-gallery-settings-page">
	<div class="jet-woo-product-gallery-settings-page">
		<h1 class="cs-vui-title"><?php _e( 'JetProductGallery Settings', 'jet-woo-product-gallery' ); ?></h1>
		<div class="cx-vui-panel">
			<cx-vui-tabs
				:in-panel="false"
				value="available-widgets"
				layout="vertical">

				<?php do_action( 'jet-woo-product-gallery/settings-page-template/tabs-start' ); ?>

				<cx-vui-tabs-panel
					name="available-widgets"
					label="<?php _e( 'Available Widgets', 'jet-woo-product-gallery' ); ?>"
					key="available-widgets">

					<div class="avaliable-widgets">
						<div class="avaliable-widgets__option-info">
							<div class="avaliable-widgets__option-info-name"><?php _e( 'Global Available Widgets', 'jet-woo-product-gallery' ); ?></div>
							<div class="avaliable-widgets__option-info-desc"><?php _e( 'List of widgets that will be available when editing the page', 'jet-woo-product-gallery' ); ?></div>
						</div>
						<div class="avaliable-widgets__controls">
							<div
								class="avaliable-widgets__control"
								v-for="(option, index) in pageOptions.product_gallery_available_widgets.options">
								<cx-vui-switcher
									:key="index"
									:name="`product-gallery-available-widget-${option.value}`"
									:label="option.label"
									:wrapper-css="[ 'equalwidth' ]"
									return-true="true"
									return-false="false"
									v-model="pageOptions.product_gallery_available_widgets.value[option.value]"
								>
								</cx-vui-switcher>
							</div>
						</div>
					</div>

				</cx-vui-tabs-panel>

				<?php do_action( 'jet-woo-product-gallery/settings-page-template/tabs-end' ); ?>
			</cx-vui-tabs>
		</div>
	</div>
</div>
