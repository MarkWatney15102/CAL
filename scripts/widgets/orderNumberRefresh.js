$.widget('task.refreshOrderNumber', {
    _create: function () {
        $('#refreshOrderId').on('click', (e) => {
            const target = $(e.target);
            const taskId = target.data('taskId');

            $.ajax(
                {
                    url: "/order/list/load",
                    method: "POST",
                    dataType: 'json',
                    data: JSON.stringify({
                        taskId: taskId
                    }),
                    success: (result) => {
                        const selectField = $('#orderId');

                        if (result.options) {
                            $('#orderId').find('option').remove();
                            $.each(result.options, function (i, item) {
                                selectField.append($('<option>', {
                                    value: item.value,
                                    text : item.text
                                }));
                            });
                        }
                    }
                }
            )
        });
    }
});