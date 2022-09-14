$.widget('admin.changePermission', {
    _create: function () {
        const groupId = $('#changePermission').data('groupId');

        $('.changePermission').on('click', (e) => {
            const target = $(e.target);
            const status = target.data('status');
            const permissionId = target.data('permissionId');

            $.ajax(
                {
                    url: "/admin/ac/group/permission/change",
                    method: "POST",
                    dataType: "json",
                    data: JSON.stringify({
                        status: status,
                        permissionId: permissionId,
                        groupId: groupId
                    }),
                    'success': function (result) {
                        if (result.success === true) {
                            if (status === 0) {
                                target.removeClass('btn-outline-danger');
                                target.addClass('btn-outline-success');
                                target.data('status', 1);
                            } else {
                                target.removeClass('btn-outline-success');
                                target.addClass('btn-outline-danger');
                                target.data('status', 0);
                            }
                        }
                    }
                }
            )
        });
    }
});