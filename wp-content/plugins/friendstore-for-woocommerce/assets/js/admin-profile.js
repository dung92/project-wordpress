jQuery(document).ready(function($) {
    $(".edit-address").click(function(e) {
        e.preventDefault();

        var index = $(this).data("index");
        $("#address-form-" + index).toggle();
        $(this).toggleClass('active');
    });

    $("tr.address-form .btn-cancel").click(function() {
        var tr_parent = $(this).parents("tr");
        var index = tr_parent.data('index');
        tr_parent.toggle();

        $('a.edit-address[data-index="'+ index +'"]').toggleClass('active');
    });

    $("tr.address-form .btn-save").click(function() {
        var $this = $(this);
        var $tr = $this.parents("tr.address-form");
        var fields = $this.parents("tr").find(":input").serialize();
        var index = $tr.data("index");
        var data = {
            action: 'fsw_edit_user_address',
            user: $("#user_id").val(),
            index: index,
            data: fields
        }

        $this.attr('disabled', 'disabled');
        $this.closest('.submit').find('.spinner').addClass('is-active');

        $.post( ajaxurl, data, function(resp) {
            $("#address-" + index + " div.address").html( resp );
            $tr.toggle();

            $this.removeAttr('disabled');
            $this.closest('.submit').find('.spinner').removeClass('is-active');
            $('a.edit-address[data-index="'+ index +'"]').removeClass('active');
        });
    });
});