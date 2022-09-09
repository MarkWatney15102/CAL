$.widget('task.addResourceButtons', {
    _create: function () {
        const taskId = $('#addMaterial').data('taskId');

        this.addButtonNewResource(taskId);
        this.addButtonSave(taskId);
        this.addButtonDelete(taskId);
    },
    addButtonNewResource: function (taskId) {
        const self = this;
        $('#addMaterial').on('click', (e) => {
            const target = $(e.target);
            const addTo = target.closest('.card-body');

            $.ajax(
                {
                    url: '/task/' + taskId + '/new-resource',
                    method: 'POST',
                    dataType: 'json',
                    success: function (result) {
                        if (result.resourceId) {
                            addTo.append(
                                $(
                                    "<div class='row'>" +
                                    "<div class='col-lg-4'><input type='text' class='form-control' name='resourceType[" + result.resourceId + "]' value='---'></div>" +
                                    "<div class='col-lg-4'><input type='number' class='form-control' name='resourceAmount[" + result.resourceId + "]' value='0'></div>" +
                                    "<div class='col-lg-2'>" +
                                    "<button type='button' class='btn btn-outline-info saveResource' name='saveResource' data-task-id='" + taskId + "' data-resource-id='" + result.resourceId + "'>" +
                                    "Speichern" +
                                    "</button>" +
                                    "</div>" +
                                    "<div class='col-lg-2'>" +
                                    "<button type='button' class='btn btn-outline-info deleteResource' name='deleteResource' data-task-id='" + taskId + "' data-resource-id='" + result.resourceId + "'>" +
                                    "Löschen" +
                                    "</button>" +
                                    "</div>" +
                                    "</div><br>"
                                )
                            );
                            self.addButtonSave(taskId);
                            self.addButtonDelete(taskId);
                        }
                    }
                }
            );
        });
    },
    addButtonSave: function (taskId) {
        const self = this;
        $('.saveResource').on('click', (e) => {
            const target = $(e.target);

            const resourceId = target.data('resourceId');

            const name = $('input[name="resourceType[' + resourceId + ']"]').val();
            const amount = $('input[name="resourceAmount[' + resourceId + ']"]').val();

            $.ajax(
                {
                    url: '/task/' + taskId + '/save-resource',
                    type: 'POST',
                    dataType: 'json',
                    data: JSON.stringify({
                        "name": name,
                        "amount": amount,
                        "resourceId": resourceId
                    })
                }
            );
        });
    },
    addButtonDelete: function (taskId) {
        $('.deleteResource').on('click', (e) => {
            const target = $(e.target);
            const resourceId = target.data('resourceId');

            $.ajax(
                {
                    url: "/task/" + taskId + "/delete-resource",
                    type: 'POST',
                    dataType: 'json',
                    data: JSON.stringify({
                        "resourceId": resourceId
                    }),
                    success: function (result) {
                        console.log(result.status);
                        if (result.status === 200) {
                            target.closest('div[class="row"]').remove();
                        }
                    }
                }
            )
        });
    }
});