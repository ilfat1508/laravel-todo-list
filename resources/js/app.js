import $ from 'jquery';

require('./bootstrap');

$(document).ready(function() {
    $('.task-status-select').change(function () {
        let taskId = $(this).data('task-id');
        let projectId = $(this).data('project-id');
        let selectedStatus = $(this).val();
        let tasksStatus = $('.project-container').data('tasks-status')

        $.ajax({
            type: 'POST',
            url: '/task/' + taskId + '/' + projectId + '/' + tasksStatus,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-HTTP-Method-Override': 'PATCH',
                'Content-Type': 'application/json'
            },
            data: JSON.stringify({ status: selectedStatus }),
            success: function (data) {
                console.log('task updated succesfully');
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    });

    $('.tasks-nav-list .nav-link').click(function () {
            let status = $(this).data('status');
            let projectId = $(this).data('project-id');

        $.ajax({
            type: 'GET',
            url: '/project/show/' + projectId + '/' + status ?? 'all',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json'
            },
            success: function (data) {
                window.location.href = window.location.origin + '/project/show/' + data.projectId + '/' + data.tasksStatus;
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    });
});

