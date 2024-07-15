<?php
    include_once "header.php";
    include_once "../controler/artikel.php";
    include_once "../controler/proizvajalec.php";

    $proizvajalci = new proizvajalec();

    ini_set("display_startup_errors", 1);
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    if(isset($_POST['dodaj']))
    {
        if(isset($_POST['naziv']) && isset($_POST['cena']) 
        && isset($_POST['motor']) && isset($_POST['poraba']) 
        && isset($_POST['proizvalajec_id']) && isset($_POST['hp'])
        && isset($_POST['zaloga']))
        {
            $slika = $_FILES['slika'];
            $dest = 'slike/' . $slika['name'];
            if(move_uploaded_file($slika['tmp_name'], $dest))
                echo 'slika je naložena';
            else
                echo 'slika ni naložena';

            $naziv=$_POST['naziv'];
            $cena=$_POST['cena'];
            $poraba=$_POST['poraba'];
            $motor=$_POST['motor'];
            $hp=$_POST['hp'];
            $zaloga=$_POST['zaloga'];
            $proizvalajec_id=$_POST['proizvalajec_id'];

            $artikel = new artikel(-1, $naziv, $cena, $poraba, $motor, $hp, $dest, $zaloga, $proizvalajec_id);
            $artikel->add_artikel();
        }
    }
?>
    <div class="container">
        <div class="row">
            <div class="col.md-5">
                <h1>Dodajanje artikla</h1>
            </div>
        </div>

        <div class="row">
            <div class="col.md-5">
                <form action="vnos_artikla.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="naziv">Naziv</label>
                        <input type="text" class="formcontrol" id="naziv" name="naziv" required>
                    </div>
                    <div class="form-group">
                        <label for="cena">Cena</label>
                        <input type="number" class="formcontrol" id="cena" name="cena" required>
                    </div>
                    <div class="form-group">
                        <label for="poraba">Poraba</label>
                        <input type="text" class="formcontrol" id="poraba" name="poraba" required>
                    </div>
                    <div class="form-group">
                        <label for="motor">Motor</label>
                        <input type="text" class="formcontrol" id="motor" name="motor" required>
                    </div>
                    <div class="form-group">
                        <label for="hp">HP</label>
                        <input type="number" class="formcontrol" id="hp" name="hp" required>
                    </div>
                    <div class="form-group">
                        <label for="zaloga">Zaloga</label>
                        <input type="number" class="formcontrol" id="zaloga" name="zaloga" required>
                    </div>
                    <div class="form-group">
                        <label for="proizvalajec_id">Proizvajalec id</label>
                        
                        <select name="proizvalajec_id" id="proizvalajec_id">
                            <?php 
                            $arr = $proizvajalci->get_proizvajalci();
                            foreach ($arr as $row) 
                            {
                                ?>
                                <option value="<?php echo $row['id_proizvajalec']?>"> <?php echo $row['naziv']?> </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="slika">Slika</label>
                        <input type="file" class="formcontrol" id="slika" name="slika" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="dodaj">Dodaj</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<?php
?>