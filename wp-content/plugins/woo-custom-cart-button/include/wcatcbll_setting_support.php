<div class="catcbll_stng_cntnt"><!-- start support setting-->
	<div class="tab-content">
        <div role="tabpanel" class="tab-pane catcbll_support_tab" id="catcbll_support_tab" style="display:block">
            <div class="tabpane_inner">
                <h2 class="qck_lnk"><?php echo esc_html__(__('Support', 'catcbll')) ?></h2>
                <div class="ref_lnk">
                    <form action="#" id="wcatcbll_sprt_form" method="post" name="wcatcbll_sprt_form">
                        <ul class="catcbll_fdtype">
                            <li>
                                <input type="radio" class="catcbll_fdtypes" id="catcbll_fdtype_1" name="catcbll-fdtypes" value="review" />
                                <a id="catcbll_fdtype_lnk1" href="https://wordpress.org/support/plugin/woo-custom-cart-button/" target="_blank">
                                    <i></i>
                                    <span><?php echo esc_html__(__('I would like to review this plugin', 'catcbll')) ?></span>
                                </a>
                            </li>
                            <li>
                                <input type="radio" class="catcbll_fdtypes" id="catcbll_fdtype_2" name="catcbll-fdtypes" value="suggestions" />
                                <label for="catcbll_fdtype_2">
                                    <i></i>
                                    <span><?php echo esc_html__(__('I have ideas to improve this plugin', 'catcbll')) ?></span>
                                </label>
                            </li>
                            <li>
                                <input type="radio" class="catcbll_fdtypes" id="catcbll_fdtype_3" name="catcbll-fdtypes" value="help-needed" />
                                <label for="catcbll_fdtype_3">
                                    <i></i>
                                    <span><?php echo esc_html__(__('I need help with this plugin', 'catcbll')) ?></span>
                                </label>
                            </li>
                        </ul>
                        <div class="catcbll_fdback_form">
                            <div class="catcbll_field">
                                <input placeholder="<?php echo __('Enter your email address..', 'catcbll'); ?>" type="email" id="catcbll-feedback-email" class="catcbll-feedback-email" />
                            </div>
                            <div class="catcbll_field mb3">
                                <textarea rows="4" id="catcbll-feedback-message" class="catcbll-feedback-message" placeholder="<?php echo __('Leave plugin developers any feedback here..', 'catcbll'); ?>"></textarea>
                            </div>
                            <div class="catcbll_field catcbll_fdb_terms_s">
                                <input type="checkbox" class="catcbll_fdb_terms" id="catcbll_fdb_terms" />
                                <label for="catcbll_fdb_terms"><?php echo esc_html__(__('I agree that by clicking the send button below my email address and comments will be send to a ServMask server', 'catcbll')) ?></label>
                            </div>
                            <div class="catcbll_field">
                                <div class="catcbll_sbmt_buttons">
                                <button class="btn btn-warning text-white" type="submit" id="catcbll-feedback-submit">
                                <i class="fa fa-send"></i> <?php echo __('Send','catcbll');?>
                                <img src="<?php echo WCATCBLL_CART_IMG.'catcbll-sms-loading.gif'?>" height="15px" id="catcbll_sms_loading" style="display:none">
                                </button>
                                <input type="hidden" id="catcbll_form_type" name="catcbll_form_type">
                                <a class="catcbll_fd_cancel btn" id="catcbll_fd_cancel" href="#"><?php echo __('Cancel','catcbll');?></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
