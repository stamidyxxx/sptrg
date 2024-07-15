<?php
    ini_set("display_startup_errors", 1);
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    include_once "header.php";
    include_once "../controler/artikel.php";
    include_once "../controler/proizvajalec.php";

    if(isset($_POST['dodaj']))
    {
        if(isset($_POST['telefonska_st']) && isset($_POST['drzava']) && 
           isset($_POST['kraj'])&& isset($_POST['postna_st'])&& 
           isset($_POST['naslov'])&& isset($_POST['naziv']))
        {
            $telefonska_st=$_POST['telefonska_st'];
            $drzava=$_POST['drzava'];
            $kraj=$_POST['kraj'];
            $postna_st=$_POST['postna_st'];
            $naslov=$_POST['naslov'];
            $naziv=$_POST['naziv'];

            $proizvajalec = new proizvajalec(-1, $naziv, $naslov, $postna_st, $kraj, $drzava, $telefonska_st);
            $proizvajalec->add_proizvajalec();
        }
    }
?>
    <div class="container">
        <div class="row">
            <div class="col.md-5">
                <h1>Dodajanje proizvajalca</h1>
            </div>
        </div>

        <div class="row">
            <div class="col.md-5">
                <form action="vnos_proizvajalca.php" method="post">
                    <div class="form-group">
                        <label for="naziv">Naziv</label>
                        <input type="text" class="formcontrol" id="naziv" name="naziv" required>
                    </div>
                    <div class="form-group">
                        <label for="naslov">Naslov</label>
                        <input type="text" class="formcontrol" id="naslov" name="naslov" required>
                    </div>
                    <div class="form-group">
                        <label for="postna_st">Postna številka</label>
                        <input type="text" class="formcontrol" id="postna_st" name="postna_st" required>
                    </div>
                    <div class="form-group">
                        <label for="kraj">Kraj</label>
                        <input type="text" class="formcontrol" id="kraj" name="kraj" required>
                    </div>
                    <div class="form-group">
                        <label for="drzava">Država</label>
                        <input type="text" class="formcontrol" id="drzava" name="drzava" required>
                    </div>
                    <div class="form-group">
                        <label for="telefonska_st">Telefonska Številka</label>
                        <input type="text" class="formcontrol" id="telefonska_st" name="telefonska_st" required>
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