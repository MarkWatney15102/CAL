window.$ = require('jquery');
require('jquery-ui/dist/jquery-ui');
const dt = require('datatables.net');
window.$.DataTable = dt;

require('bootstrap');

require('./scripts/widgets/resourceButtons');
require('./scripts/widgets/orderNumberRefresh');
require('./scripts/widgets/AccessControl/change-group');
require('./scripts/widgets/AccessControl/change-permission');
require('./scripts/widgets/Storage/bookoutArtikel');
require('./scripts/widgets/Storage/bookinArtikel');

$(function() {
    $('#addMaterial').addResourceButtons();
    $('#refreshOrderId').refreshOrderNumber();
    $('#changeGroup').changeGroup();
    $('#changePermission').changePermission();

    $('#bookout').bookoutAritkel();
    $('#bookIn').bookinAritkel();

    const options = {
        searching: false,
        lengthChange: false
    };

    $('#projectList').DataTable(options);
    $('#jobList').DataTable(options);
});
