<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Factura</title>
    <style>
    *{
        font-family:Verdana, Geneva, Tahoma, sans-serif;
        }

    body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;

    }
    #cabecera {
        gap: 20px;
        justify-content: center;
        
    }
    #company {
    /*    background-color: #f5f5f5; */
        padding: 20px;
        text-align :right;
        font-size: 12px;
        line-height:  4px;
        height: 150px;
        width: 400px;
    }
    #FromTo {
        background-color: white;
        padding: 20px;
        text-align :left;
        font-size: 12px;
        line-height:  4px;

    }
    #pedidoLineas {
        background-color: white;
        padding: 20px;
        text-align :right;
        font-size: 12px;
        width: 598px;
    }
    th,.fondoGris {
        background-color: #f2f2f2;
    }
    </style>
</head>
<body>
<div id = "cabecera">
<table id="pedidoLineas">
<tr>
    <td>
        <div id = "imagen">
            <img  src='../images/150x150.png' alt='' class=''>
        </div>
    </td>
    <td>      
        <div id = "company">
            <h2>Shira Electric Power Company</h2>
            <br>   
            <h4>Company representative name</h4>
            <h4>Company Address</h4>
            <h4>Tax Id</h4>
            <h4>phone</h4>
            <h4>fax</h4>
        </div>
    </td>
</tr>
</table>
</div>

<div id = "FromTo">
    <div>
        <p><strong>From:</strong></p>
        <p><?=$pedido['nomven']?></p>
    </div>
    <div>
        <p><strong>To:</strong></p>
        <p><?=$pedido['nomclie']?></p>
    </div>
   
</div>
<div>
<table id="pedidoLineas">
<thead>
    <tr>
        <th>#</th>
        <th>descripcion</th>
        <th>quantity</th>
        <th>Unit Prize $</th>
        <th>Total $</th>
    </tr>   
</thead>
<tbody>
    <?php

    $preu_subtotal = 0;

    foreach ($lineas as $linea) {
        print_r( $linea);
        $preu_subtotal += $linea['import'];

            echo "<tr class = 'row'>";

            echo "<td>$linea[lin_com]</td>";
            echo "<td>$linea[descr]</td>";
            echo "<td>$linea[quant]</td>";
            echo "<td>$linea[preu]</td>";
            echo "<td>$linea[import]</td>";

            echo "</tr>";
    };
    ?>
</tbody>
<tfoot>
    <tr class = 'row'>
        <td></td>
        <td></td>
        <td></td>
        <td>Subtotal$</td>
        <td text-align="right"><?=$preu_subtotal?></td>
    </tr>
    <tr class = 'row'>
        <td></td>
        <td></td>
        <td></td>
        <td>Tax $</td>
        <td text-align="right"><?=$pedido['importtotal']-$preu_subtotal?></td>
    </tr>
    <tr class = 'row fondoGris'> 
        <td></td>
        <td></td>
        <td></td>
        <td>Total $</td>
        <td text-align="right"><?=$pedido['importtotal']?></td>
    </tr>
  </tfoot>
</table>
</div>
  
</body>
</html>