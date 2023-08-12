<!-- Include jQuery library -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css" rel="stylesheet" />
</head>

<body>

    <div class="container">





        <h1>Carrito</h1>
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                    <th></th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th class="text-right">Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if ($this->cart->total_items() > 0) {
                    foreach ($cartItems as $item) {    ?>
                        <tr>
                            <td>
                                <?php $imageURL = !empty($item["image"]) ? base_url('assets/img/upload/' . $item["image"]) : base_url('assets/images/pro-demo-img.jpeg'); ?>
                                <img src="<?php echo $imageURL; ?>" width="50" />
                            </td>
                            <td><?php echo $item["name"]; ?></td>
                            <td><?php echo 'S/.' . $item["price"] . ' s'; ?></td>
                            <td><input type="number" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"></td>
                            <td class="text-right"><?php echo 'S/.' . $item["subtotal"] . ' Soles'; ?></td>
                            <td class="text-right"><button class="btn btn-sm btn-danger" onclick="return confirm('Seguro de Eliminar?')?window.location.href='<?php echo base_url('cart/removeItem/' . $item["rowid"]); ?>':false;"> Eliminar </button> </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="6">
                            <p>Carrito Vacio.....</p>
                        </td>
                    <?php } ?>
                    <?php if ($this->cart->total_items() > 0) { ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><strong>Precio Total</strong></td>
                        <td class="text-right"><strong><?php echo 'S/.' . $this->cart->total() . ' Soles'; ?></strong></td>
                        <td></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>

<script>
    // Update item quantity
    function updateCartItem(obj, rowid) {
        $.get("<?php echo base_url('cart/updateItemQty/'); ?>", {
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
</script>

</html>