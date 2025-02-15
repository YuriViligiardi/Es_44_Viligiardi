<?php
    include("connessione.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scelta Sala</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        $sql = "SELECT * FROM sale";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $sql2 = "DESCRIBE sale";
            $result2 = $conn->query($sql2);
            if ($result2->num_rows > 0) {
                showAllSale($result, $result2);
            }       
        } else {
            showNothing();
        }

        function showAllSale($res, $res2) {
            echo "<div class='divShowData'>";
                echo "<h1 class='correct'>TUTTE LE SALE PRESENTI</h1>";
                echo "<table>";
                    echo "<tr>";
                        while ($row2 = $res2->fetch_assoc()) {
                            echo "<th>" . $row2["Field"] . "</th>";
                        }
                    echo "</tr>";
                    echo "<tr>";
                        while ($row = $res->fetch_assoc()) {
                            echo "<tr>";
                                foreach ($row as $value) {
                                    echo "<td> $value </td>"; 
                                }
                            echo "</tr>";
                        }
                    echo "</tr>";
                echo "</table>";
             echo "</div>";
        }

        function showNothing() {
            echo "<div class='divShowData'>";
                echo "<h1 class='error'>NESSUNA SALA PRESENTE</h1>";
            echo "</div>";
        }
    ?>

    <div class="divShowData">
        <h1>RICERCA SALA</h1>
        <form action="scriptsale.php" method="get">
            <p>Inserisci l'anno di apertura che desideri:</p>
            <input type="number" name="annoApertura" value="2000">
            <p>Scegli se vuoi visualizzare le sale senza la data di apertura:</p>
            <input type="radio" name="sale" value="SI" checked>SI
            <input type="radio" name="sale" value="NO">NO
            <br>
            <br>
            <input class="sendButton" type="submit" value="CERCA">
        </form>
    </div>
</body>
</html>