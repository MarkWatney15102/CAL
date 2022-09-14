$.widget('admin.changeGroup', {
    _create: function () {
        const roleId = $('#changeGroup').data('roleId');

        $('.changeGroup').on('click', (e) => {
            const target = $(e.target);
            const status = target.data('status');
            const groupId = target.data('groupId');

            $.ajax(
                {
                    url: "/admin/ac/role/group/change",
                    method: "POST",
                    dataType: "json",
                    data: JSON.stringify({
                        status: status,
                        groupId: groupId,
                        roleId: roleId
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