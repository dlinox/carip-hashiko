<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container">

        <h1>ORDER STATUS</h1>
        <?php if (!empty($order)) { ?>
            <div class="col-md-12">
                <div class="alert alert-success">Your order has been placed successfully.</div>
            </div>

            <!-- Order status & shipping info -->
            <div class="row col-lg-12 ord-addr-info">
                <div class="hdr">Order Info</div>
                <p><b>Reference ID:</b> #<?php echo $order['id']; ?></p>
                <p><b>Total:</b> <?php echo '$' . $order['grand_total'] . ' USD'; ?></p>
                <p><b>Placed On:</b> <?php echo $order['created']; ?></p>
                <p><b>Buyer Name:</b> <?php echo $order['name']; ?></p>
                <p><b>Email:</b> <?php echo $order['email']; ?></p>
                <p><b>Phone:</b> <?php echo $order['phone']; ?></p>
            </div>

            <!-- Order items -->
            <div class="row col-lg-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>QTY</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($order['items'])) {
                            foreach ($order['items'] as $item) {
                        ?>
                                <tr>
                                    <td>
                                        <?php $imageURL = !empty($item["image"]) ? base_url('uploads/product_images/' . $item["image"]) : base_url('assets/images/pro-demo-img.jpeg'); ?>
                                        <img src="<?php echo $imageURL; ?>" width="75" />
                                    </td>
                                    <td><?php echo $item["name"]; ?></td>
                                    <td><?php echo '$' . $item["price"] . ' USD'; ?></td>
                                    <td><?php echo $item["quantity"]; ?></td>
                                    <td><?php echo '$' . $item["sub_total"] . ' USD'; ?></td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div class="col-md-12">
                <div class="alert alert-danger">Your order submission failed.</div>
            </div>
        <?php } ?>


    </div>

</body>

</html>