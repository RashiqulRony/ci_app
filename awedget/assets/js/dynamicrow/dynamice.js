
var registryNo = 2;
var registry_form_no = 1;
function add_dyamice_row() {
    jQuery.get(webPath + 'DynamicRow/getDynamiceRow/' + registry_form_no + '/' + registryNo, function (data) {
        jQuery('#registryData').append(data);
        registryNo = registryNo + 1;
        registry_form_no = registry_form_no + 1;

    });
}

function rm_registry_form(form_id) {
    jQuery('#registry_no_' + form_id).remove();
    registryNo = registryNo - 1;

}
