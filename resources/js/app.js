import $ from 'jquery';
require('./bootstrap');

$(document).ready(function() {
    $('.task-status-select').change(function () {
        var taskId = $(this).data('task-id');
        var projectId = $(this).data('project-id');
        var selectedStatus = $(this).val();
debugger
        // Выполните ваш AJAX запрос здесь, используя taskId, projectId и selectedStatus
        $.ajax({
            type: 'PATCH',
            url: '/task/' + taskId + '/' + projectId,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json'
            },
            data: JSON.stringify({ status: selectedStatus }),
            success: function (data) {
                // Обработка ответа сервера, если необходимо
                console.log(data);
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    });
});
