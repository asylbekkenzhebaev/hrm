$(document).ready(function () {
    $('.table-datatable').DataTable();

    if ($('#department').hasClass('department_event')) {
        let departmentId = $("#department option:selected").val();
        if (departmentId !== 0) {
            let positionId = $('#position').data('position-id');
            departmentAjax(departmentId, positionId);
        }
    }
});


$(document).on('change', '.department_event', function () {
    let departmentId = $(this).find('option:selected').val();
    departmentAjax(departmentId);
});

function departmentAjax(departmentId, positionId = 0) {
    $.ajax({
        url: '/position-list/',
        method: 'GET',
        dataType: 'JSON',
        data: {department_id: departmentId},
        success: function (response) {
            console.log(response);
            if (response.length > 0) {
                var option = '<option value="">Select position</option>';
                for (let i = 0; i < response.length; i++) {
                    var selected = '';
                    if (response[i].id == positionId) {
                        selected = 'selected';
                    }
                    option += '<option value="' + response[i].id + '" ' + selected + '>' + response[i].name + '</option>';
                }
            } else {
                var option = '<option value="" disabled>No position</option>';
            }
            $('#position').html(option);
        }
    });
}
