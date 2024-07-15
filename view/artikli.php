<?php
session_start();

include_once "header.php";
include_once "../controler/artikel.php";
include_once "../controler/uporabnik.php";

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
if (!isset($_SESSION['role'])) {
    $_SESSION['role'] = "none";
}

$artikel = new artikel();
$artikli = $artikel->get_all_artikli();

if(isset($_POST['delete_article']))
{
    if(isset($_POST['article_id']))
    {
        $id = $_POST['article_id'];
        $artikel->delete_artikel($id);
        $data = $artikel->execute_sql_query("SELECT * FROM sptrg_artikel WHERE id_artikel = :v1", $id);
        
        foreach ($data as $row) 
        {
            unlink($row['path_slika']);
        }
    }
}

if (isset($_POST['add_to_cart'])) 
{
    $product_id = $_POST['product_id'];
    $_SESSION['cart'][] = $product_id;
}

?>

<div class="container-fluid d-flex justify-content-center" id="products-container">
    <div class="row mt-5">
            <?php 
                foreach($artikli as $row) 
                { 
            ?>
        
                <div class="col-sm-3">
                <div class="card">
                    <img src="<?php echo $row['path_slika']; ?>" alt="<?php echo $row['path_slika']; ?>" class="card-img-top" width="100%">
                    <div class="card-body pt-0 px-0">
                        <div class="d-flex flex-row justify-content-between mb-0 px-3">
                            <h5><?php echo $row['naziv']; ?></h>
                            <h6>&euro;<?php echo $row['cena']; ?>&ast;</h6>
                        </div>
                        <hr class="mt-2 mx-3">
                        <div class="d-flex flex-row justify-content-between px-3 pb-4">
                            <div class="d-flex flex-column"><span class="text-muted">Fuel Efficiency</span><small class="text-muted">L/100KM&ast;</small></div>
                            <div class="d-flex flex-column"><h5 class="mb-0"><?php echo $row['poraba']; ?></h5><small class="text-muted text-right">(city/Hwy)</small></div>
                        </div>
                        <div class="d-flex flex-row justify-content-between p-3 mid">
                            <div class="d-flex flex-column"><small class="text-muted mb-1">ENGINE</small><div class="d-flex flex-row"><img src="https://imgur.com/iPtsG7I.png" width="35px" height="25px"><div class="d-flex flex-column ml-1"><small class="ghj"><?php echo $row['motor']; ?></small></div></div></div>
                            <div class="d-flex flex-column"><small class="text-muted mb-2">HORSEPOWER</small><div class="d-flex flex-row"><img src="https://imgur.com/J11mEBq.png"><h6 class="ml-1"><?php echo $row['hp']; ?> hp&ast;</h6></div></div>
                        </div>
                            <form method="post">
                                <input type="hidden" name="product_id" value="<?php echo $row['id_artikel']; ?>">
                                <div class="mx-3 mt-3 mb-2"><button type="submit" name="add_to_cart" class="btn btn-danger btn-block"><small>ADD TO CART</small></button></div>
                            </form>
                            <?php 
                                if($_SESSION['role'] == 'admin')
                                {
                            ?>
                                <form method="post">
                                    <input type="hidden" name="article_id" value="<?php echo $row['id_artikel']; ?>">
                                    <div class="mx-3 mt-3 mb-2"><button type="submit" name="delete_article" class="btn btn-danger btn-block"><small><?php echo 'DELETE - ' . $row['id_artikel'];?></small></button></div>
                                </form>
                            <?php 
                                }
                            ?>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>

<div class="container-fluid d-flex justify-content-center">
  <div class="row mt-5">

  </div>
</div>
</main>

<?php
  include_once "footer.php"
?>

</body>
</html>