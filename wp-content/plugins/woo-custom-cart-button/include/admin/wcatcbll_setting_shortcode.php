<!-- start shortcode setting-->
<div class="modal fade" id="shortcodeModal" tabindex="-1" role="dialog" aria-labelledby="shortcodeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="shortcodeModalLabel" class="modal-title"><?php echo esc_html__(__('Shortcode', 'wcatcbnl')) ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="">
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane" id="catcbll_shortcode_tab" style="display:block">
              <div class="tabpane_inner">
                <div class="ref_lnk">
                  <p><?php echo esc_html__(__('Anywhere you can show product using this shortcode', 'wcatcbnl')) ?></p>
                  <p class="catcbll_stcode">[catcbll pid="" background="" font_size="" font_color="" font_awesome="" border_color="" border_size="" icon_position="" image=""]<p>
                      <p>*pid => product ID</p>
                      <p>*background => #ffffff</p>
                      <p>*font_size => 12</p>
                      <p>*font_color => #ooo</p>
                      <p>*font_awesome => fas fa-adjust</p>
                      <p>*border_color => red</p>
                      <p>*border_size => 2</p>
                      <p>*icon_position => right or left</p>
                      <p>*image => true or false</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>