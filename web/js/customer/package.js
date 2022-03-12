function setPackageEvent() {
    $('.package_name').on('change', function (e) {
        $('#' + e.currentTarget.id.replace('package_id', 'package_price')).val(0);
    });
    $('.package_name').on('select2:select', function (e) {
        $('#' + e.currentTarget.id.replace('package_id', 'package_price')).val(e.params.data.price);
    });    
}

setPackageEvent();

$('.dynamicform_wrapper').on('afterInsert', function(e, item) {
    setPackageEvent();
});

