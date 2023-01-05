$(function() {


    $('.btnAddSubmenu').on('click', function() {
        $('#newSubModalLabel').html('Add Submenu');
    })


    $('.tampilModalEdit').on('click', function() {
        $('#newSubModalLabel').html('Edit Submenu');
        $('.modal-footer button[type=submit]').html('Edit')
        $('.modal-body form').attr('action', 'http://localhost/report-issue/Menu/Edit')


        const id = $(this).data('id');

        $.ajax({
            url     : 'http://localhost/report-issue/Menu/getEdit',
            data    : {id : id},
            method  : 'post',
            dataType: 'json',
            success : function(data) {
                console.log(data);
            }

        });


    });

});