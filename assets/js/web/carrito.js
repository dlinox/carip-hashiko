// Update item quantity
function updateCartItem(obj, rowid) {
    $.get("updateItemQty/", {
        rowid: rowid,
        qty: obj.value
    }, function(resp) {
        if (resp == 'ok') {
            location.reload();
        } else {
            alert('Cart update failed, please try again.');
        }
    });
}