import $ from 'jquery';
require('./bootstrap');


$(document).ready(function() {
    $('#statusSelect').change(function() {
        var selectedStatus = $(this).val();
        var taskId = $(this).data('task-id');
        var projectId = $(this).data('project-id');
        // Отправка PATCH-запроса с использованием AJAX
        $.ajax({
            type: 'PATCH',
            url: '/task/' + taskId + '/update/' + projectId,
            data: { status: selectedStatus },
            success: function(response) {
                console.log(response);
                // Дополнительные действия при успешном обновлении
            },
            error: function(error) {
                console.error(error);
                // Дополнительные действия при ошибке
            }
        });
    });
});
