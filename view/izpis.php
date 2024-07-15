<?php

    include_once "../controler/uporabnik.php";
    include_once "../model/db/dbconf.php";
    include_once "../model/model.php";
    try {
        $uporabnik = new uporabnik();
        $data = $uporabnik->get_database_users();
        if (true)
        {
            include_once "header.php";
            try
            {   
            ?>
                <table id="table1">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>ime</th>
                            <th>priimek</th>
                            <th>naslov</th>
                            <th>postna_st</th>
                            <th>kraj</th>
                            <th>datum_rojstva</th>
                            <th>telefonska_st</th>
                            <th>email</th>
                            <th>uporabnisko_ime</th>
                            <th>geslo</th>
                        </tr>
                    </thead>
                <tbody>
            <?php
            foreach ($data as $row) 
            {
                ?>
                <tr>
                    <td><?php echo $row['id_uporabnik']; ?></td>
                    <td><?php echo $row['ime']; ?></td>
                    <td><?php echo $row['priimek']; ?></td>
                    <td><?php echo $row['naslov']; ?></td>
                    <td><?php echo $row['postna_st']; ?></td>
                    <td><?php echo $row['kraj']; ?></td>
                    <td><?php echo $row['datum_rojstva']; ?></td>
                    <td><?php echo $row['telefonska_st']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['uporabnisko_ime']; ?></td>
                    <td><?php echo $row['geslo']; ?></td>
                </tr>
            <?php
            }
            ?>
                </tbody>
                </table>
            <?php

            } 
            catch (PDOException $e) 
            {
                echo $e;
                echo "narobe";
            }
        }
    } catch (PDOException $e1) {
        echo "Connection failed: " . $e1->getMessage();
    }
?>