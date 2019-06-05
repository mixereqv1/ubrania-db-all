<?php
    function connect(){
        $conn = mysqli_connect('localhost','root','','ubrania');
        return $conn;
    }
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="main.css">
        <title>Document</title>
    </head>

    <body>

        <main class="main">
            <table>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Nazwa produktu</th>
                <th>Cena</th>
                <th>Data</th>

                <?php
                    $sql = "SELECT * FROM klienci,koszyk,produkty,zamowienia WHERE koszyk.id_zamowienie=zamowienia.id_zamowienie 
                        AND koszyk.id_produkt=produkty.id_produkt AND zamowienia.id_klient=klienci.id_klient";

                    $return = mysqli_query(connect(),$sql);
                    while($row = mysqli_fetch_assoc($return)){
                        echo('<tr>');
                        echo('<td>' .$row['imie']. '</td><td>' .$row['nazwisko']. '</td><td>' .$row['nazwa']. '</td><td>' .$row['koszt']. '</td><td>' .$row['data']. '</td>');
                        echo('</tr>');
                    }
                    $sum = "SELECT round(SUM(koszyk.ilosc*produkty.koszt),2) AS suma FROM produkty,koszyk WHERE produkty.id_produkt=koszyk.id_produkt";
                    $result_suma = mysqli_query(connect(),$sum);
                    while($row = mysqli_fetch_assoc($result_suma)){
                        echo('<tr><th colspan="5"> SUMA: ' .$row['suma']. '</th></tr>');
                    }
                ?>

            </table>
        </main>

    </body>

</html>