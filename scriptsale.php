<?php
    include("connessione.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostra Sale</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        $annoApertura = $_GET["annoApertura"];
        $controlShowSale = $_GET["sale"];

        if ($controlShowSale === "SI") {
            $sql = "SELECT * FROM sale WHERE YEAR(DataApertura) = $annoApertura OR DataApertura IS NULL";
        } else {
            $sql = "SELECT * FROM sale WHERE YEAR(DataApertura) = $annoApertura"; 
        }

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $sql2 = "DESCRIBE sale";
            $result2 = $conn->query($sql2);
            if ($result2->num_rows > 0) {
                showData($annoApertura, $controlShowSale, $result, $result2);
            }
        } else {
            showDataErr();
        }
        
        function showData($annApe, $conShowSale, $res, $res2) {
            echo "<div class='divShowData'>";
                echo "<h1 class='correct'>SALE TROVATE</h1>";
                echo "<p><b>Ano apertura desiderata:</b> $annApe</p>";
                if ($conShowSale === "SI") {
                    echo "<p><b>Visualizzazione delle sale con data NULL:</b> TRUE</p>";
                } else {
                    echo "<p><b>Visualizzazione delle sale con data NULL:</b> FALSE</p>";
                }
                
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
                echo "<br>";
                echo "<br>";
                echo "<a class='sendButton' href='sceltasala.php'>HOME</a>";
             echo "</div>";
        }

        function showNothing() {
            echo "<div class='divShowData'>";
                echo "<h1 class='error'>NESSUNA SALA TROVATA</h1>";
                echo "<br>";
                echo "<br>";
                echo "<a class='sendButton' href='sceltasala.php'>HOME</a>";
            echo "</div>";
        }
    ?>
</body>
</html>