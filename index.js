window.$ = require('jquery');
require('jquery-ui/dist/jquery-ui');
const dt = require('datatables.net');
window.$.DataTable = dt;

require('bootstrap');

require('./scripts/widgets/resourceButtons');
require('./scripts/widgets/orderNumberRefresh');

$(function() {
    $('#addMaterial').addResourceButtons();
    $('#refreshOrderId').refreshOrderNumber();

    const options = {
        searching: false,
        lengthChange: false
    };

    $('#projectList').DataTable(options);
    $('#jobList').DataTable(options);
});
