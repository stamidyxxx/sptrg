<?php
session_start();

include_once "header.php";
include_once "../controler/artikel.php";
include_once "../controler/uporabnik.php";

if (isset($_POST['arr_id']))
{
  array_splice($_SESSION['cart'], $_POST['arr_id'], 1);
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

?>
<link rel="stylesheet" href="https://www2.scptuj.si/~branda.luka/sptrg3a1-24/view/css/style_cart.css">
<div class="container">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-9">
            <div class="ibox">
                <div class="ibox-title">
                    <span class="pull-right">(<strong><?php echo count($_SESSION['cart']); ?></strong>) <?php if (count($_SESSION['cart']) == 1) echo 'item'; else echo 'items'; ?></span>
                    <h5><?php if (count($_SESSION['cart']) == 1) echo 'Item'; else echo 'Items'; ?> in your cart</h5>
                </div>
  <?php
    $total = 0;
    if (empty($_SESSION['cart'])) 
    {
  ?>
        <div class="ibox-content">
        <div class="table-responsive">
            <table class="table shoping-cart-table">
                <p></p>
            </table>
            </div>
        </div>
  <?php
    } 
    else 
    {
        for ($i = 0; $i < count($_SESSION['cart']); $i += 1)
        {
          $product_id = $_SESSION['cart'][$i];
          $artikel = new Artikel();
          $data = $artikel->get_artikel($product_id);
          $cena = $data[0]['cena'];
          $total += $cena;
    ?>
          <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table shoping-cart-table">
                            <tbody>
                            <tr>
                                <td width="90">
                                    <div class="cart-product-imitation">
                                      <img src='<?php echo $data[0]['path_slika']; ?>' >
                                    </div>
                                </td>
                                <td class="desc">
                                    <h3>
                                        <?php echo $data[0]['naziv']; ?>
                                    </h3>
                                    <p class="small">
                                        <?php echo $data[0]['motor'] . " " . $data[0]['hp'] . " " . $data[0]['poraba'];?>
                                    </p>

                                    <div id="form" class="m-t-sm">
                                    <form id="remove-item-form" method='post'>
                                      <input type='hidden' name='arr_id' value='<?php echo $i; ?>' /> 
                                      <a href="#" class="text-muted" onclick="document.getElementById('remove-item-form').submit(); return false;"><i class="fa fa-trash"></i> Remove item</a> 
                                    </form>
                                    </div>
                                </td>
                                <td>
                                    <h4>
                                    <?php echo '€' . $cena; ?>
                                    </h4>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
  <?php
        }
    }
  ?>
                  <div class="ibox-content">
                      <button class="btn btn-white" onclick="location.href='https://www2.scptuj.si/~branda.luka/sptrg3a1-24/view/artikli.php'"><i class="fa fa-arrow-left"></i> Continue shopping</button>
                  </div>
              </div>

          </div>
          <?php if (count($_SESSION['cart']) > 0)
            {
          ?>
            <div class="col-md-3">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Cart Summary</h5>
                    </div>
                    <div class="ibox-content">
                        <span>
                            Total
                        </span>
                        <h2 class="font-bold">
                          <?php echo '€' . $total; ?>
                        </h2>

                        <hr>
                        <div class="m-t-sm">
                            <div class="btn-group">
                                  <a href="#" class="btn btn-primary btn-sm" onclick="location.href='https://www2.scptuj.si/~branda.luka/sptrg3a1-24/view/checkout.php'"><i class="fa fa-shopping-cart"></i> Checkout</a>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
          <?php 
            }  
          ?>   
      </div>
  </div>
</div>

<?php
  include_once "footer.php"
?>

</body>
</html>